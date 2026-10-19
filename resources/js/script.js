//корзина
async function addToCart(master_classId) {
    try {
        const response = await fetch('/view/add/'+master_classId);
        const json = await response.json();

        if (json.success) {
            alert('Товар добавлен в корзину');
            document.querySelector('.cart-count').textContent = json.cartCount;
            // console.log(document.getElementById('cart-item-' + master_classId));
            document.getElementById('cart-item-' + master_classId).textContent = json.count;
            document.querySelector('.cart-sum').textContent = json.cartSum;
            let cartSum = document.querySelector('.cartSum');
            if(cartSum != null) {
                cartSum.textContent= json.cartSum;
            }
            if(count != null) {
                count.textContent= json.count;
            }
        } else {
            alert('Ошибка: ' + json.message);
        }
    } catch (error) {
        alert('Произошла ошибка при добавлении в корзину');
    }
}
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('add-to-cart-btn')) {
        console.log(e.target.dataset.productId);
        let id = e.target.dataset.productId;
        addToCart(id);
        e.preventDefault();
    }
})
async function minusToCart(master_classId) {
    try {
        const response = await fetch('/cart/minus/{id}'+master_classId);
        const json = await response.json();

        if (json.success) {
            alert('Товар добавлен в корзину');
            document.querySelector('.cart-count').textContent = json.cartCount;
            // console.log(document.getElementById('cart-item-' + master_classId));
            document.getElementById('cart-item-' + master_classId).textContent = json.count;
            document.querySelector('.cart-sum').textContent = json.cartSum;
            let cartSum = document.querySelector('.cartSum');
            if(cartSum != null) {
                cartSum.textContent= json.cartSum;
            }
            if(count != null) {
                count.textContent= json.count;
            }
        } else {
            alert('Ошибка: ' + json.message);
        }
    } catch (error) {
        alert('Произошла ошибка при добавлении в корзину');
    }
}
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('add-to-cart-btn')) {
        console.log(e.target.dataset.productId);
        let id = e.target.dataset.productId;
        addToCart(id);
        e.preventDefault();
    }
})


document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const answer = button.nextElementSibling;
        answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
    });
});
 //слайдер

const slider = document.querySelector('.slider');
const cardContainer = document.querySelector('.card-container');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');
const cards = document.querySelectorAll('.card');
let currentIndex = 0;
function showCard(index) {
  const translateXValue = -index * cards[0].offsetWidth;
  cardContainer.style.transform = `translateX(${translateXValue}px)`;
}
function updateButtons() {
  prevBtn.disabled = false;
  nextBtn.disabled = false;
}
prevBtn.addEventListener('click', () => {
  currentIndex--;
  if (currentIndex < 0) {
    currentIndex = cards.length - 1;
  }
  showCard(currentIndex);
  updateButtons();
});
nextBtn.addEventListener('click', () => {
  currentIndex++;
  if (currentIndex >= cards.length) {
    currentIndex = 0;
  }
  showCard(currentIndex);
  updateButtons();
});
showCard(currentIndex);
updateButtons();


