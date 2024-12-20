let list = document.querySelector('.slider .list');
let items = document.querySelectorAll(".slider .list .item");
let dots = document.querySelectorAll(".slider .dots li");

let prev = document.querySelector('.prev');
let next = document.querySelector('.next');

let active = 0;
let lengthItems = items.length - 1;
let autoplayInterval;

const startAutoplay = () => {
    autoplayInterval = setInterval(() => {
        active = (active + 1) > lengthItems ? 0 : active + 1;
        reloadSlider();
    }, 3000); 
};

next.onclick = function () {
    active = (active + 1) > lengthItems ? 0 : active + 1;
    reloadSlider();
    resetAutoplay(); 
};

prev.onclick = function () {
    active = (active - 1 < 0) ? lengthItems : active - 1;
    reloadSlider();
    resetAutoplay(); 
};

// dots clickable
dots.forEach((dot, index) => {
    dot.onclick = () => {
        active = index;
        reloadSlider();
        resetAutoplay(); 
    };
});

const reloadSlider = () => {
    let checkLeft = items[active].offsetLeft;
    list.style.left = -checkLeft + 'px';
    
    // Update dots
    dots.forEach(dot => dot.classList.remove('active'));
    dots[active].classList.add('active');
};

const resetAutoplay = () => {
    clearInterval(autoplayInterval);
    startAutoplay(); 
};


startAutoplay();
