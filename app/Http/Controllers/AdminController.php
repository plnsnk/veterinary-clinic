<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Review;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Http\Request;

class AdminController extends Controller
{

       public function toggleQuestionStatus($id)
    {
        $question = Question::findOrFail($id);

        $newStatus = ($question->status_id == 2) ? 3 : 2;

        $question->update(['status_id' => $newStatus]);

        $statusNames = [
            2 => 'Одобрен',
            3 => 'На модерации',
            5 => 'Отвечен'
        ];

        return response()->json([
            'success' => true,
            'new_status' => $newStatus,
            'status_name' => $statusNames[$newStatus] ?? 'Неизвестно',
            'is_approved' => $newStatus == 2
        ]);
    }
     public function admin_feedback()
     {
         $reviews = Review::get();
         return view('admin_feedback', [
             'reviews' => $reviews,
         ]);
     }

    public function approveReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status_id' => 2]);

        return response()->json(['success' => true, 'message' => 'Отзыв опубликован']);
    }

    public function toggleReviewStatus($id)
    {
        $review = Review::findOrFail($id);

        $newStatus = ($review->status_id == 2) ? 1 : 2;

        $review->update(['status_id' => $newStatus]);

        $statusNames = [
            1 => 'На модерации',
            2 => 'Опубликован'
        ];

        return response()->json([
            'success' => true,
            'new_status' => $newStatus,
            'status_name' => $statusNames[$newStatus] ?? 'Неизвестно'
        ]);
    }
     public function review(Request $request)
     {

     }
     public function admin_ask()
     {
         $questions = Question::orderByDesc('created_at')->get();
         return view('admin_ask', [
             'questions'=>$questions
         ]);
     }
     public function ask_account(Request $request)
     {

     }
    public function showAnswerForm($id)
    {
        $question = Question::findOrFail($id);
        return view('form_ask_admin', [
            'question' => $question,
        ]);
    }


    public function saveAnswer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string|min:3|max:1000',
        ], [
            'answer.required' => 'Напишите ответ',
            'answer.min' => 'Ответ должен быть не менее 3 символов',
        ]);

        $question = Question::findOrFail($id);

        $question->update([
            'answer' => $request->answer,
            'status_id' => 5,
        ]);

        return redirect('/admin/ask')->with('success', 'Ответ сохранён!');
    }
    public function orders()
{
    $orders = \App\Models\Order::with('status')->orderBy('created_at', 'desc')->get();
    $statuses = \App\Models\status::all(); 
    
    return view('admin.orders', compact('orders', 'statuses'));
}

public function updateStatus(Request $request, $id)
{
   $request->validate([
        'status_id' => 'required|integer|in:4,6'
    ]);

    $order = \App\Models\Order::findOrFail($id);
    $order->update(['status_id' => $request->status_id]);

    return back()->with('success', 'Статус заказа обновлён');
}

}