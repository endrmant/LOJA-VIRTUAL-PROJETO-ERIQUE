let slideAtual = 0;

function proximoSlide() {
    const slides = document.querySelectorAll('.slide');
    slides[slideAtual].classList.remove('active');
    
    slideAtual = (slideAtual + 1) % slides.length;
    slides[slideAtual].classList.add('active');
}

function voltarSlide() {
    const slides = document.querySelectorAll('.slide');
    slides[slideAtual].classList.remove('active');
    
    slideAtual = (slideAtual - 1 + slides.length) % slides.length;
    slides[slideAtual].classList.add('active');
}