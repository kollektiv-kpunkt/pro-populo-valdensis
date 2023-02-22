class HeroineSlider {
    constructor() {
        this.slider = document.querySelector(".ppv-heroine-blog-slider");
        this.slides = this.slider.querySelectorAll(".ppv-blog-slide");
        this.numSlides = this.slides.length;
        this.current = 0;
        this.currentSlide = this.slides[this.current];
        this.nextTimeout = null;
        this.setTimeout();
        this.slideButtons = this.slider.querySelectorAll(".ppv-heroine-blog-slider-pagination-item");
        this.currentSlideButton = this.slideButtons[this.current];

        this.slideButtons.forEach((button, index) => {
            button.addEventListener("click", () => {
                this.switchSlide(button.dataset.slideId);
            });
        });
    }

    switchSlide(slide) {
        clearTimeout(this.nextTimeout);
        this.currentSlide.classList.remove("active");
        this.currentSlideButton.classList.remove("active");

        this.slides[slide].classList.add("active");
        this.slideButtons[slide].classList.add("active");

        this.current = slide;
        this.currentSlide = this.slides[this.current];
        this.currentSlideButton = this.slideButtons[this.current];
        this.setTimeout();
    }

    setTimeout() {
        this.nextTimeout = setTimeout(() => {
            this.switchSlide((this.current + 1) % this.numSlides);
        }, 5000);
    }

}

if (document.querySelector(".ppv-heroine-blog-slider")) {
    let slider = new HeroineSlider();
}