const slider = document.querySelector('.slider');
const boxWidth = document.querySelector('.box').offsetWidth + 20; // width of box + margin
let isAnimating = false;

function nextSlide() {
  if (isAnimating) return; // Prevent multiple clicks during animation
  isAnimating = true;

  // Move the slider left
  slider.style.transition = 'transform 0.5s ease-in-out';
  slider.style.transform = `translateX(-${boxWidth}px)`;

  setTimeout(() => {
    // Move the first box to the end after the transition
    const firstBox = slider.firstElementChild;
    slider.appendChild(firstBox);

    // Reset the slider position without animation
    slider.style.transition = 'none';
    slider.style.transform = 'translateX(0)';
    
    isAnimating = false;
  }, 500); // Match this duration with CSS transition time (0.5s)
}

function prevSlide() {
  if (isAnimating) return; // Prevent multiple clicks during animation
  isAnimating = true;

  // Move the last box to the beginning
  const lastBox = slider.lastElementChild;
  slider.insertBefore(lastBox, slider.firstElementChild);

  // Set the slider position immediately without animation
  slider.style.transition = 'none';
  slider.style.transform = `translateX(-${boxWidth}px)`;

  // Slide the boxes into place with animation
  setTimeout(() => {
    slider.style.transition = 'transform 0.5s ease-in-out';
    slider.style.transform = 'translateX(0)';

    isAnimating = false;
  }, 50); // Short timeout to allow for immediate reflow
}



function toggleAudio(slideNumber) {
    var audio = document.getElementById('audioFile' + slideNumber);
    var button = document.getElementById('audioControl' + slideNumber);
  
    if (audio.paused) {
      // Pause any currently playing audio
      pauseAllAudios();
  
      // Play the selected audio
      audio.play();
      button.innerHTML = '&#10074;&#10074;'; // Pause icon
    } else {
      // Pause the current audio
      audio.pause();
      button.innerHTML = '&#9658;'; // Play icon
    }
  }
  
  function pauseAllAudios() {
    var audios = document.querySelectorAll('audio');
    var buttons = document.querySelectorAll('.play-button');
  
    audios.forEach(function (audio) {
      audio.pause(); // Pause all audios
    });
  
    buttons.forEach(function (button) {
      button.innerHTML = '&#9658;'; // Reset all buttons to play icon
    });
  }
  