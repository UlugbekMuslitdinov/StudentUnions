var slideIndex = 0;
var play = 0;
showSlidesAutomatic();
// showSlides(slideIndex);

function playSlideshow() {
  return;
}

// Next/previous controls
function plusSlides(n) {
  var temp = play + 1;
  play += 1;
  showSlides(slideIndex += n);


  if(play == temp) {
    play = 0;
  }
}




// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  // console.log(slides[2]);
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

function showSlidesAutomatic() {
  if(play == 0) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  currentSlide(slideIndex);
  }
  setTimeout(showSlidesAutomatic, 20000); // Change image every 2 seconds
}