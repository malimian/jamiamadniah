// let currentVideoIndex = 0;
// const videos = document.querySelectorAll('#videoList source');

// function changeSlide(direction) {
//     currentVideoIndex += direction;

//     // Loop around if out of bounds
//     if (currentVideoIndex < 0) {
//         currentVideoIndex = videos.length - 1;
//     } else if (currentVideoIndex >= videos.length) {
//         currentVideoIndex = 0;
//     }

//     // Update the video source
//     const videoContainer = document.getElementById('videoContainer');
//     videoContainer.innerHTML = `
//         <video width="640" height="360" controls>
//             <source src="${videos[currentVideoIndex].src}" type="video/mp4">
//         </video>
//     `;
// }




// Array of video sources
const videoSources = [
    './videos/VID-20241016-WA0009.mp4',
    './videos/VID-20241017-WA0009.mp4', // Add additional video paths here
];

// Current video index
let currentVideoIndex = 0;

// Function to change the video
function changeSlide(direction) {
    // Update the current video index based on direction
    currentVideoIndex += direction;

    // Check bounds
    if (currentVideoIndex < 0) {
        currentVideoIndex = 0; // Prevent going to a negative index
    } else if (currentVideoIndex >= videoSources.length) {
        currentVideoIndex = videoSources.length - 1; // Prevent going beyond the last video
    }

    // Get video element and update the source
    const videoElement = document.querySelector('#videoContainer video');
    videoElement.src = videoSources[currentVideoIndex];
    
    // Load and play the new video
    videoElement.load();
    videoElement.play();
}

// Initialize the video slider with the first video
document.addEventListener('DOMContentLoaded', () => {
    const videoElement = document.querySelector('#videoContainer video');
    videoElement.src = videoSources[currentVideoIndex];
});
