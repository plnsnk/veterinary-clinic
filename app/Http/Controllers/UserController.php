<?php

namespace App\Http\Controllers;

use App\Models\Animal;

use App\Models\Animal_customer;
use App\Models\animalType;

use App\Models\Application;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Diseas;
use App\Models\Order;
use App\Models\Product;
use App\Models\Question;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        $service = Service::get();
        $branches = Branch::get();

        $questions = Question::where('status_id', 2)->get();
        $reviews = Review::where('status_id', 2)->orderBy('created_at', 'desc')->limit(10)->get();
        return view('index', [
            'service' => $service,
            'branches' => $branches,
            'questions' => $questions,
            'reviews' => $reviews,
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|min:3|max:15|unique:users,login',
            'password' => 'required|min:6|max:15|confirmed', // Увеличил мин. длину пароля до 6 для безопасности
            'email' => 'required|email|unique:users,email',
            'name' => 'nullable|string|min:2|max:255',
            'phone' => 'nullable|string|min:10|max:20',
            'rules' => 'accepted', // Обязательно требовать согласие с правилами
        ], [
            'login.required' => 'Поле "Логин" обязательно для заполнения.',
            'login.min' => 'Логин должен содержать не менее 3 символов.',
            'login.max' => 'Логин должен содержать не более 15 символов.',
            'login.unique' => 'Пользователь с таким логином уже зарегистрирован.',
            
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать не менее 6 символов.',
            'password.max' => 'Пароль должен содержать не более 15 символов.',
            'password.confirmed' => 'Введённые пароли не совпадают.',
            
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.unique' => 'Пользователь с таким Email уже зарегистрирован.',
            
            'name.min' => 'Имя должно содержать не менее 2 символов.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            
            'phone.min' => 'Номер телефона должен содержать не менее 10 символов.',
            'phone.max' => 'Номер телефона не должен превышать 20 символов.',
            
            'rules.accepted' => 'Необходимо дать согласие на обработку персональных данных.',
        ]);

        if (User::where('login', $request->login)->exists()) {
            echo "Логин уже занят";
            exit;
        }
        $user = User::create([
            'login' => $request->login,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rules' => $request->has('rules') ? 1 : 0,
        ]);
        Auth::login($user);
        return redirect('/');
    }
    public function registerForm()
    {
        return view('register');
    }
    public function auth(Request $request)
    {
        $request->validate(
            [
                'login' => 'required|min:3|max:15', 
                'password' => 'required|min:6|max:15'
            ],
            [
                'login.required' => 'Поле "Логин" обязательно для заполнения.',
                'login.min' => 'Логин должен содержать не менее 3 символов.',
                'login.max' => 'Логин должен содержать не более 15 символов.',
                
                'password.required' => 'Поле "Пароль" обязательно для заполнения.',
                'password.min' => 'Пароль должен содержать не менее 6 символов.',
                'password.max' => 'Пароль должен содержать не более 15 символов.'
            ]
        );
        $userExists = User::where('login', $request->login)->exists();

        if (!$userExists) {
            return back()->withErrors([
                'login' => 'Пользователь с таким логином не найден'
            ]);
        }
        $successful = Auth::attempt(['login' => $request->login, 'password' => $request->password], $request->remember);
        if (!$successful) {
            return back()->withErrors(['login' => 'Неправильно введен логин или пароль']);
        }
        return redirect('/');

    }
    public function authForm()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function show(Category $category)
    {
        return view('show', ['category' => $category]);
    }

    public function cabinet()
    {
        if (Auth::user()->admin) {

            $reviews = Review::orderByDesc('created_at')->get();
            return view('admin_feedback', ['reviews' => $reviews,]);
        } else {
            $user = Auth::user()->load('animals.type');
            return view('personal_account', [
                'user' => $user,
            ]);
        }
    }
    public function animals()
    {
        $user = Auth::user()->load('animals.type');

        return view('personal_animal', [
            'user' => $user,
        ]);
    }
    public function formAnimal()
    {
        $types = animalType::get();
        $diseases = Diseas::get();

        return view('form_animal', [
            'types' => $types,
            'diseases' => $diseases,
        ]);
    }
    public function animal(Request $request)
    {

        $request->validate([
            'type_id' => 'required|exists:animal_types,id',
            'name' => 'required|string|min:2|max:50',
            'age' => 'nullable|integer|min:0|max:50', // ДОБАВЛЕНО: валидация возраста
            'weight' => 'required|numeric|min:0.1|max:200',
            'disease_id' => 'nullable|exists:diseases,id',
        ], [
            'type_id.required' => 'Необходимо выбрать вид животного.',
            'type_id.exists' => 'Выбранный вид животного не найден в системе.',
            
            'name.required' => 'Поле "Имя питомца" обязательно для заполнения.',
            'name.min' => 'Имя питомца должно содержать не менее 2 символов.',
            'name.max' => 'Имя питомца не должно превышать 50 символов.',
            
            'age.integer' => 'Возраст должен быть целым числом.',
            'age.min' => 'Возраст не может быть отрицательным.',
            'age.max' => 'Максимальный возраст не может превышать 50 лет.',
            
            'weight.required' => 'Поле "Вес" обязательно для заполнения.',
            'weight.numeric' => 'Вес должен быть числом.',
            'weight.min' => 'Вес должен быть больше 0.1 кг.',
            'weight.max' => 'Вес не может превышать 200 кг.',
            
            'disease_id.exists' => 'Выбранное заболевание не найдено в системе.',
        ]);


        Animal::create([
            'user_id' => Auth::id(),
            'animal_type_id' => $request->type_id,
            'name' => $request->name,
            'age' => $request->age,
            'weight' => $request->weight,
            'diseas_id' => $request->disease_id ?: null,
        ]);
        return redirect('/animal');
    }
    public function formReview()
    {
        return view('form_feedback');
    }


    public function review(Request $request)
    {
         $request->validate([
            'estimation' => 'required|integer|min:1|max:5',
            'text' => 'required|string|min:10|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'estimation.required' => 'Необходимо поставить оценку.',
            'estimation.integer' => 'Оценка должна быть числом.',
            'estimation.min' => 'Минимальная оценка: 1.',
            'estimation.max' => 'Максимальная оценка: 5.',
            
            'text.required' => 'Поле "Текст отзыва" обязательно для заполнения.',
            'text.min' => 'Текст отзыва должен содержать не менее 10 символов.',
            'text.max' => 'Текст отзыва не должен превышать 1000 символов.',
            
            'photo.image' => 'Загружаемый файл должен быть изображением.',
            'photo.mimes' => 'Изображение должно быть в формате: jpeg, png, jpg или webp.',
            'photo.max' => 'Размер изображения не должен превышать 2 МБ.',
        ]);
        $photoPath = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file = $request->file('photo');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/public/reviews';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);
            $photoPath = 'storage/app/public/reviews/' . $filename;
        }

        \App\Models\Review::create([
            'user_id' => Auth::id(),
            'estimation' => $request->estimation,
            'text' => $request->text,
            'status_id' => 4,
            'photo_path' => $photoPath,
        ]);
        return redirect('/reviews')->with('success', 'Отзыв отправлен на модерацию!');
    }
    public function formAsk()
    {
        return view('form_ask');
    }
    public function ask(Request $request)
    {
         $request->validate([
            'question' => 'required|string|min:10|max:1000',
        ], [
            'question.required' => 'Поле "Вопрос" обязательно для заполнения.',
            'question.min' => 'Вопрос должен содержать не менее 10 символов.',
            'question.max' => 'Вопрос не должен превышать 1000 символов.',
        ]);
        $status_id = 4;
        $user_id = Auth::id();
        $ask = Question::create([
            'question' => $request->question,
            'status_id' => $status_id,
            'user_id' => $user_id,
        ]);
        return redirect('/asks');
    }

    public function reviews()
    {
        $reviews = Review::where('user_id', Auth::id())->get();
        return view('reviews', ['reviews' => $reviews]);
    }
    public function asks()
    {
        $asks = Question::where('user_id', Auth::id())->get();
        return view('ask_account', [
            'asks' => $asks
        ]);
    }
    public function status(Request $request)
    {
        $application = Application::find($request->id);
        if ($application) {
            $application->status_id = $request->status_id;
            $application->save();
        }
        return redirect('/admin');
    }

    public function updatePhoto(Request $request)
    {
         $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'delete_photo' => 'nullable|boolean',
        ], [
            'photo.image' => 'Загружаемый файл должен быть изображением.',
            'photo.mimes' => 'Изображение должно быть в формате: jpeg, png, jpg или webp.',
            'photo.max' => 'Размер изображения не должен превышать 2 МБ.',
        ]);
        $user = Auth::user();

        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'delete_photo' => 'nullable|boolean',
        ]);

        if ($request->delete_photo && $user->photo_path) {
            $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($user->photo_path, '/');
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            $user->update(['photo_path' => null]);
            return back()->with('success', 'Фото удалено');
        }


        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

            if ($user->photo_path) {
                $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($user->photo_path, '/');
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/app/public/user_photos';

            if (!file_exists($uploadPath)) {
                if (!mkdir($uploadPath, 0755, true)) {
                    return back()->with('error', 'Не удалось создать папку');
                }
            }


            if ($file->move($uploadPath, $filename)) {

                $user->update(['photo_path' => 'storage/app/public/user_photos/' . $filename]);
                return back()->with('success', 'Фото загружено!');
            } else {
                return back()->with('error', 'Ошибка при сохранении');
            }
        }

        return back()->with('success', 'Фото обновлено');
    }
    public function view()
    {

        $data['views'] = Auth::user()->cart;

        return view('view', $data);
    }
    public function store(Request $request)
    {
         $request->validate([
            'estimation' => 'required|integer|min:1|max:5',
            'text' => 'required|string|min:3|max:150'
        ], [
            'estimation.required' => 'Необходимо поставить оценку.',
            'estimation.min' => 'Минимальная оценка: 1.',
            'estimation.max' => 'Максимальная оценка: 5.',
            
            'text.required' => 'Поле "Текст" обязательно для заполнения.',
            'text.min' => 'Текст должен содержать не менее 3 символов.',
            'text.max' => 'Текст не должен превышать 150 символов.',
        ]);
        $request->validate([
            'estimation' => 'required',
            'text' => 'min:3|max:150|required'
        ]);
        Auth::user()->reviews()->create($request->all());
        return back();
    }
    public function order()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Для оформления заказа необходимо войти в аккаунт.');
        }

        $cartItems = Auth::user()->cart()->withPivot('quantity')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('warning', 'Ваша корзина пуста. Добавьте товары перед оформлением.');
        }
        return view('order', [
            'views' => $cartItems,
        ]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:10|max:20',
            'address' => 'required|string|min:10|max:500',
            'comment' => 'nullable|string|max:1000',
            'sum' => 'required|numeric|min:0',
        ], [
            'name.required' => 'Поле "Имя получателя" обязательно для заполнения.',
            'name.min' => 'Имя должно содержать не менее 2 символов.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.min' => 'Номер телефона должен содержать не менее 10 символов.',
            'phone.max' => 'Номер телефона не должен превышать 20 символов.',
            
            'address.required' => 'Поле "Адрес доставки" обязательно для заполнения.',
            'address.min' => 'Адрес должен содержать не менее 10 символов.',
            'address.max' => 'Адрес не должен превышать 500 символов.',
            
            'comment.max' => 'Комментарий к заказу не должен превышать 1000 символов.',
            
            'sum.required' => 'Сумма заказа не определена.',
            'sum.numeric' => 'Сумма заказа должна быть числом.',
            'sum.min' => 'Сумма заказа не может быть отрицательной.',
        ]);
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:10',
            'address' => 'required|string|min:5|max:500',
            'comment' => 'nullable|string|max:1000',
        ]);
        $order = new Order();
        $order->name = $request->name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->status_id = 4;
        $order->comment = $request->comment;
        $order->sum = $request->sum;
        $order['user_id'] = Auth::id();
        $order->save();
        $cart = Auth::user()->cart;
        foreach ($cart as $item) {
            $order->products()->attach($item, ['quantity' => $item->pivot->quantity, 'price' => $item->price,]);
        }
        return redirect('/gratitude');
    }
    public function gratitude()
    {
        return view('gratitude');
    }

    public function orders()
    {
        $orders = \App\Models\Order::with('products')
            ->where('user_id', Auth::id()) 
            ->orderBy('created_at', 'desc') 
            ->paginate(10);                 

        return view('orders', compact('orders'));
    }


}