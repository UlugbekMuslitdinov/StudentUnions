// Global variables
var timerStart = Date.now();
var img_index = 1;
var slide_div_height = 0;
var num_imgs = 0;
var wait_before_next_slide = 3500; // Set time before next slide

// Need to wait until image is fully loaded on page
window.onload = function () { 

	var wrap_img_div = document.getElementById('all_rest'); // div that wraps all elements
	slide_div_height = wrap_img_div.getElementsByTagName('img')[0].height; // Get image height
	wrap_img_div.style.height = slide_div_height + 10 + "px"; // Set wrapper height
	wrap_img_div.style.overflow = "hidden"; // Set wrapper overflow
	num_imgs = wrap_img_div.getElementsByTagName('img').length; // get number of images

	var link_div = wrap_img_div.getElementsByTagName('a');
	// Set margin top for all images
	for (var i = 1; i < num_imgs; i++) {
		wrap_img_div.getElementsByTagName('a')[i].style.marginTop = slide_div_height + "px";
	}

	setTimeout(function(){
		animateTop(link_div,slide_div_height,0);
	},wait_before_next_slide-(Date.now()-timerStart)); // Subtrac page loading time 

}

function animateTop(obj, from, to){
   var box = obj[img_index];
   // if it reachs 'to', then start next image.
   // Otherwise keep moving the image
   if(from <= to){ 
   		// Increment index and if it reaches last img then reset to 0
        img_index++;
        (img_index >= num_imgs) && (img_index = 0);	
        // Start next img
        setTimeout(function(){
        	// Hide previous image after 1500
       		setTimeout(function(){
       			box.style.visibility = "hidden";
       		},wait_before_next_slide);
       		box.style.zIndex = '0'; // Set previous image index to place under next image
            animateTop(obj,slide_div_height,to); // Start next image
        }, wait_before_next_slide); 
   }
   else {
       	(box.style.visibility != "visible") && (box.style.visibility = "visible"); // Set current image visible
       	(box.style.zIndex!='1') && (box.style.zIndex = '1'); // Set zindex to 1
       	box.style.marginTop = from + "px"; // Set new margin top
       	move_pixel = 1; // Decide how much pixel it will move each time
       	time_to_animateTop = 0; // Time to move 1 pixel
       	setTimeout(function(){
            animateTop(obj, from - move_pixel, to);
       	}, time_to_animateTop) 
   }
}