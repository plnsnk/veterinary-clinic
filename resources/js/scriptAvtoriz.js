function validateLoginForm() {
    // Получаем элементы формы
    const login = document.getElementById('login');
    const password = document.getElementById('password');
    const rules = document.getElementById('rules');

    const loginPattern = /^[A-Za-z0-9-]+$/; // латиница, цифры и тире
    const passwordPattern = /^.{5,}$/; // минимум 6 символов

    resetErrors();

    let isValid = true;

    // Проверка логина
    if (!login.value.match(loginPattern)) {
        showError(login, 'Логин может содержать только латиницу, цифры и тире.');
        isValid = false;
    } else {
        showSuccess(login);
    }

    // Проверка пароля
    if (!password.value.match(passwordPattern)) {
        showError(password, 'Пароль должен содержать минимум 6 символов.');
        isValid = false;
    } else {
        showSuccess(password);
    }

    // Проверка согласия с правилами
    if (!rules.checked) {
        alert('Вы должны согласиться с правилами авторизации.');
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
    // Сброс всех ошибок в форме
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.classList.remove('error', 'success');
        const errorMessage = document.getElementById(input.id + 'Error');
        if (errorMessage) {
            errorMessage.textContent = '';
        }
    });
}
