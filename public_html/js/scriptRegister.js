function validateForm() {
    // Получаем элементы формы
    const name = document.getElementById('name');
    const surname = document.getElementById('surname');
    const patronymic = document.getElementById('patronymic');
    const login = document.getElementById('login');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const passwordRepeat = document.getElementById('password_repeat');
    const rules = document.getElementById('rules');

   
    const nameSurnamePattern = /^[А-Яа-яЁё\s-]+$/; // кириллица пробелы и тире
    const loginPattern = /^[A-Za-z0-9-]+$/; // латиница цифры и тире
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // проверка email
    const passwordPattern = /^.{6,}$/; // минимум 6 символов

  
    resetErrors();

    let isValid = true;

    if (!name.value.match(nameSurnamePattern)) {
        showError(name, 'Имя может содержать только кириллицу, пробелы и тире.');
        isValid = false;
    } else {
        showSuccess(name);
    }

    if (!surname.value.match(nameSurnamePattern)) {
        showError(surname, 'Фамилия может содержать только кириллицу, пробелы и тире.');
        isValid = false;
    } else {
        showSuccess(surname);
    }


    if (!login.value.match(loginPattern)) {
        showError(login, 'Логин может содержать только латиницу, цифры и тире.');
        isValid = false;
    } else {
        showSuccess(login);
    }


    if (!email.value.match(emailPattern)) {
        showError(email, 'Введите корректный email.');
        isValid = false;
    } else {
        showSuccess(email);
    }

    if (!password.value.match(passwordPattern)) {
        showError(password, 'Пароль должен содержать минимум 6 символов.');
        isValid = false;
    } else {
        showSuccess(password);
    }

    if (password.value !== passwordRepeat.value) {
        showError(passwordRepeat, 'Пароли не совпадают.');
        isValid = false;
    } else {
        showSuccess(passwordRepeat);
    }

    if (!rules.checked) {
        alert('Вы должны согласиться с правилами регистрации.');
        isValid = false;
    }

    return isValid;
}

function showError(input, message) {
    const errorMessage = document.getElementById(input.id + 'Error');
    errorMessage.textContent = message;
    input.classList.add('error');
    input.classList.remove('success');
}

function showSuccess(input) {
    const errorMessage = document.getElementById(input.id + 'Error');
    errorMessage.textContent = '';
    input.classList.add('success');
    input.classList.remove('error');
}

function resetErrors() {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.classList.remove('error', 'success');
        const errorMessage = document.getElementById(input.id + 'Error');
        if (errorMessage) {
            errorMessage.textContent = '';
        }
    });
}

   const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating-anti');

    // Инициализация состояния звезд при загрузке
    let currentRating = parseInt(ratingInput.value) || 1;
    updateStars(currentRating);

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = parseInt(star.dataset.value);
            ratingInput.value = rating;
            currentRating = rating;
            updateStars(rating);
        });

        star.addEventListener('mouseover', () => {
            const hoverRating = parseInt(star.dataset.value);
            updateStars(hoverRating);
        });

        star.addEventListener('mouseout', () => {
            updateStars(currentRating);
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            star.classList.remove('selected');
            star.classList.remove('hover');

            const starValue = parseInt(star.dataset.value);

            if (starValue <= rating) {
                star.classList.add('selected');
            }
        });
    }