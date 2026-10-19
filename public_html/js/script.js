document.addEventListener('DOMContentLoaded', function() {

    // ========================================
    // БУРГЕР-МЕНЮ
    // ========================================
    const burger = document.getElementById('burgerToggle');
    const nav = document.getElementById('headerNav');

    if (burger && nav) {
        burger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            burger.classList.toggle('active');
            nav.classList.toggle('active');
            document.body.style.overflow = nav.classList.contains('active') ? 'hidden' : '';
        });

        // Закрыть меню при клике на ссылку
        nav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                burger.classList.remove('active');
                nav.classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        // Закрыть меню при клике вне хедера
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.site-header') && nav.classList.contains('active')) {
                burger.classList.remove('active');
                nav.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

   
    // ========================================
    //  СЛАЙДЕР ОТЗЫВОВ
    // ========================================
    const slider = document.querySelector('.slider');
    const container = document.querySelector('.card-container');
    const cards = document.querySelectorAll('.card');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    if (slider && cards.length > 0) {
        let currentIndex = 0;
        let cardWidth = 0;
        let autoplayInterval;

        function init() {
            updateCardWidth();
            createDots();
            showCard(0);
            addEvents();
            startAutoplay();
        }

        function updateCardWidth() {
            cardWidth = slider.offsetWidth;
        }

        function createDots() {
            let dotsContainer = document.querySelector('.slider-dots');
            if (!dotsContainer) {
                dotsContainer = document.createElement('div');
                dotsContainer.className = 'slider-dots';
                slider.parentNode.appendChild(dotsContainer);
            }
            dotsContainer.innerHTML = '';
            cards.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.className = `slider-dot ${i === 0 ? 'active' : ''}`;
                dot.setAttribute('aria-label', `Перейти к отзыву ${i + 1}`);
                dot.addEventListener('click', (e) => {
                    e.preventDefault();
                    showCard(i);
                });
                dotsContainer.appendChild(dot);
            });
        }

        function showCard(index) {
            if (index < 0) index = cards.length - 1;
            if (index >= cards.length) index = 0;
            currentIndex = index;
            if (container) {
                container.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
            }
            updateDots();
            resetAutoplay();
        }

        function updateDots() {
            document.querySelectorAll('.slider-dot').forEach((dot, i) => {
                dot.classList.toggle('active', i === currentIndex);
            });
        }

        function addEvents() {
            // if (prevBtn) {
            //     prevBtn.addEventListener('click', (e) => {
            //         e.preventDefault();
            //         showCard(currentIndex - 1);
            //     });
            // }
            // if (nextBtn) {
            //     nextBtn.addEventListener('click', (e) => {
            //         e.preventDefault();
            //         showCard(currentIndex + 1);
            //     });
            // }

            // Свайпы для мобильных
            let touchStartX = 0;
            slider.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
                stopAutoplay();
            }, {passive: true});

            slider.addEventListener('touchend', e => {
                const diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) {
                    diff > 0 ? showCard(currentIndex + 1) : showCard(currentIndex - 1);
                }
                startAutoplay();
            }, {passive: true});

            // Пауза при наведении
            slider.addEventListener('mouseenter', stopAutoplay);
            slider.addEventListener('mouseleave', startAutoplay);

            // Пересчёт при изменении размера окна
            window.addEventListener('resize', () => {
                updateCardWidth();
                showCard(currentIndex);
            });
        }

        function startAutoplay() {
            stopAutoplay();
            if (cards.length > 1) {
                autoplayInterval = setInterval(() => showCard(currentIndex + 1), 5000);
            }
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        function resetAutoplay() {
            if (cards.length > 1) startAutoplay();
        }

        // Запуск
        init();
    }
});


  document.addEventListener('DOMContentLoaded', function() {
    const questions = document.querySelectorAll('.faq-question');

    questions.forEach(question => {
        const toggleAnswer = (e) => {
            e?.preventDefault?.();
            
            const answer = question.nextElementSibling;
            const isActive = question.classList.contains('active');
            
          
            questions.forEach(otherQuestion => {
                const otherAnswer = otherQuestion.nextElementSibling;
                otherQuestion.classList.remove('active');
                otherAnswer.style.maxHeight = null;
                otherAnswer.style.padding = "0 20px";
            });
            
            // 🔹 2. Если кликнули по закрытому — открываем его
            if (!isActive) {
                question.classList.add('active');
                // Небольшая задержка для корректного расчёта высоты
                setTimeout(() => {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                    answer.style.padding = "15px 20px";
                }, 10);
            }
        };

        // Слушаем и клик, и тач (для мобильных)
        question.addEventListener('click', toggleAnswer);
        question.addEventListener('touchend', (e) => {
            e.preventDefault();
            toggleAnswer(e);
        }, {passive: true});
        
        // Важно для мобильных: предотвращаем зум и задержки
        question.style.touchAction = 'manipulation';
        question.style.webkitTapHighlightColor = 'transparent';
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('recordModal');
    const openBtn = document.getElementById('openRecordModal');
    const closeBtn = document.getElementById('closeRecordModal');
    
    // Открытие модального окна
    if (openBtn) {
        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.hidden = false;
            document.body.style.overflow = 'hidden'; // Блокировка прокрутки фона
        });
    }
    
    // Закрытие по кнопке ×
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }
    
    // Закрытие по клику вне окна
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }
    
    // Закрытие по клавише Esc
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.hidden) {
            closeModal();
        }
    });
    
    // Функция закрытия
    function closeModal() {
        modal.hidden = true;
        document.body.style.overflow = '';
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('[data-comparison]');

    sliders.forEach(slider => {
        const handle = slider.querySelector('.comparison-handle');
        let isDragging = false;

        function setSliderPosition(clientX) {
            const rect = slider.getBoundingClientRect();
            let percent = ((clientX - rect.left) / rect.width) * 100;
            percent = Math.max(0, Math.min(100, percent));
            
            // Обновляем CSS-переменную, а не width
            slider.style.setProperty('--pos', percent + '%');
            handle.style.left = percent + '%';
        }

        // Мышь
        handle.addEventListener('mousedown', (e) => { isDragging = true; e.preventDefault(); });
        document.addEventListener('mouseup', () => isDragging = false);
        document.addEventListener('mousemove', (e) => { if (!isDragging) return; setSliderPosition(e.clientX); });
        slider.addEventListener('click', (e) => { if (e.target.closest('.handle-circle')) return; setSliderPosition(e.clientX); });

        // Тач
        handle.addEventListener('touchstart', () => isDragging = true, {passive: true});
        document.addEventListener('touchend', () => isDragging = false);
        document.addEventListener('touchmove', (e) => { if (!isDragging) return; setSliderPosition(e.touches[0].clientX); }, {passive: true});

        // Клавиатура
        handle.setAttribute('tabindex', '0');
        handle.setAttribute('role', 'slider');
        handle.setAttribute('aria-label', 'Слайдер сравнения до и после');
        handle.setAttribute('aria-valuenow', '50');
        
        handle.addEventListener('keydown', (e) => {
            let current = parseFloat(slider.style.getPropertyValue('--pos')) || 50;
            if (e.key === 'ArrowLeft') current = Math.max(0, current - 3);
            if (e.key === 'ArrowRight') current = Math.min(100, current + 3);
            slider.style.setProperty('--pos', current + '%');
            handle.style.left = current + '%';
            handle.setAttribute('aria-valuenow', Math.round(current));
        });
    });
});
// ================= УВЕДОМЛЕНИЕ О COOKIE =================
document.addEventListener('DOMContentLoaded', function() {
    const cookieBanner = document.getElementById('cookie-banner');
    const cookieAccept = document.getElementById('cookie-accept');
    const COOKIE_KEY = 'cookie_consent_v1'; // Версия для будущего обновления

    // Проверяем, давал ли пользователь согласие ранее
    if (!localStorage.getItem(COOKIE_KEY)) {
        // Показываем баннер с небольшой задержкой (после загрузки страницы)
        setTimeout(() => {
            cookieBanner.hidden = false;
            document.body.style.paddingBottom = '80px'; // Чтобы баннер не перекрывал контент
        }, 1500);
    }

    // Обработчик кнопки "Принять"
    if (cookieAccept) {
        cookieAccept.addEventListener('click', function() {
            // Сохраняем согласие в localStorage
            localStorage.setItem(COOKIE_KEY, 'accepted');
            
            // Плавно скрываем баннер
            cookieBanner.style.animation = 'slideUp 0.3s ease reverse';
            setTimeout(() => {
                cookieBanner.hidden = true;
                document.body.style.paddingBottom = '';
            }, 300);
        });
    }
});