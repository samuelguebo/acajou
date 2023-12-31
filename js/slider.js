////////////////////
// Simple carousel slider
// Credits: Adapted from Stephen Fray's work (https://codepen.io/stepfray/pen/rLMBKB)
// License: MIT (https://blog.codepen.io/documentation/licensing/)
const slideshow = (
    sliderSelector = "#slider",
    nextSelector = ".next",
    prevSelector = ".prev",
    autoChangeTime = 3000,
    pauseOnHover = false
) => {


    ////////////////////
    const _sliderAutoChangeTime = autoChangeTime;
    const _slider = document.querySelector(sliderSelector);
    const _slides = _slider.querySelectorAll(".carousel-item");
    const _sliderCount = _slides.length;
    const _nextButton = document.querySelector(nextSelector);
    const _previousButton = document.querySelector(prevSelector);


    ////////////////////
    // Previous Arrow 'click' event
    ////////////////////
    _previousButton.addEventListener("click", function (e) {
        e.preventDefault();
        let currentIndex = currentLiveIndex(),
            previousIndex = currentIndex - 1 < 0 ? _sliderCount - 1 : currentIndex - 1;
        setActiveSliderIndex(previousIndex);
    });

    ////////////////////
    // Next Arrow 'click' event
    ////////////////////
    _nextButton.addEventListener("click", function (e) {
        e.preventDefault();
        MoveToNextSlider();
    });

    ////////////////////
    // Move to Next Slider
    ////////////////////
    let MoveToNextSlider = () => {
        let currentIndex = currentLiveIndex(),
            nextIndex = currentIndex + 1 > _sliderCount - 1 ? 0 : currentIndex + 1;
        setActiveSliderIndex(nextIndex);
    };

    ////////////////////
    // Current Live Slide Index
    ////////////////////
    let currentLiveIndex = () => {
        let response;
        _slides.forEach(function (div, index) {
            if (div.classList.contains("active")) response = index;
        });
        return response;
    };

    ////////////////////
    // Set Slider and Dot Nav Active
    ////////////////////
    let setActiveSliderIndex = (activeSliderIndex) => {
        // Changes Slider
        _slider.querySelector("div.active").classList.remove("active");
        _slides[activeSliderIndex].classList.add("active");
        // Reset Timer
        restartInterval();
    };

    ////////////////////
    // Timer
    ////////////////////
    let timer = setInterval(MoveToNextSlider, _sliderAutoChangeTime);

    ////////////////////
    // Reset time between sliders
    ////////////////////
    let restartInterval = () => {
        clearInterval(timer);
        timer = setInterval(MoveToNextSlider, _sliderAutoChangeTime);
    };

    ////////////////////
    // Pause on hover
    ////////////////////
    if(pauseOnHover) {
        _slider.addEventListener("mouseover", function () {
            clearInterval(timer);
        });
        _slider.addEventListener("mouseout", function () {
            restartInterval();
        });
    }
}