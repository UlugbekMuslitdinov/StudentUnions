// Note: all the code which is not included
//       in a function gets executed right away.

// global variables
var imageID = 'image_2';
var inter;
var current = 'image_1';
var connPage="connection.php";
var attempts = 0;
var defaultSlideTime = 15000;
var transitionSpeed = 2000;

// whichever page calls this
// routine, its URL will be
// placed in this variable.
var currPage = location.href;

// switch images every 15 seconds.
//setInterval(switch_images, 15000);

// every 5 minutes, check the connection and reload
// if possible. Otherwise, stay with the two we have.
setInterval(check_connection_and_reload, 300000);


// changes the opacity of the images, by gradually
// decreasing the opacity of the visible image and
// increasing the opacity of the invisible image.
function switch_images()
{
  // we get the two divs containing the images,
  var image_1 = document.getElementById('image_1');
  var image_2 = document.getElementById('image_2');
  
  // there is an opacity switching routine for each
  // image, depending on which one is the one currently
  // being displayed.
  if(current=='image_1')
  {
    $('#image_1').fadeOut(transitionSpeed);
	$('#image_2').fadeIn(transitionSpeed, function() {
        // Animation complete
        // since image_2 is the one that
	    // is now visible, we tag it as
	    // the current image.
	    current = 'image_2';
	    
	    // the image that is invisible
	    // is the one we are going to update.
	    imageID = 'image_1';
	    
	    updateBlock();
	    setTimeout(switch_images, defaultSlideTime);
    });
  }
  else if(current=='image_2') 
  {
    $('#image_2').fadeOut(transitionSpeed);
	$('#image_1').fadeIn(transitionSpeed, function() {
        // Animation complete
        // since image_1 is the one that
	    // is now visible, we tag it as
	    // the current image.
	    current = 'image_1';
	    
	    // the image that is invisible
	    // is the one we are going to update.
	    imageID = 'image_2';
	    
	    updateBlock();
	    setTimeout(switch_images, defaultSlideTime);
    });
  }
}
function firstLoad(){
  firstRun = true;
  updateBlock();
  setTimeout(switch_images, defaultSlideTime);
}

function updateBlock(){
  var ajaxRequest;  // The variable that makes Ajax possible!
  
  try{
    // Opera 8.0+, Firefox, Safari
    ajaxRequest = new XMLHttpRequest();
  } catch (e){
    // Internet Explorer Browsers
    try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try{
        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e){
        // Something went wrong
        alert("Your browser broke!");
        return false;
      }
    }
  }
  // Create a function that will receive data sent from the server
  ajaxRequest.onreadystatechange = function(){
    if(ajaxRequest.readyState == 4){
      // Take the new image and put it in place
      if (firstRun==true)
      {
        curImage = document.getElementById("image_1").innerHTML;
        prevImage = document.getElementById("image_2").innerHTML;
      }
      else
      {
        curImage = document.getElementById(current).innerHTML;
        prevImage = document.getElementById(imageID).innerHTML;
      }
      
      if (curImage.substring(curImage.length - 3)!=" />")
      {
        curImage = curImage.substring(0,curImage.length - 1);
        curImage = curImage+" />";
      }
      if (prevImage.substring(prevImage.length - 3)!=" />")
      {
        prevImage = prevImage.substring(0,prevImage.length - 1);
        prevImage = prevImage+" />";
      }
      newImage = ajaxRequest.responseText;
      if (newImage.substring(newImage.length - 3)!=" />")
      {
        newImage = newImage.substring(0,newImage.length - 1);
        newImage = newImage+" />";
      }
      maxAttempts = 10;
      if (curImage!=newImage&&prevImage!=newImage||attempts>=maxAttempts)
      {
        if (!(curImage!=newImage&&prevImage==newImage||attempts>=maxAttempts))
        {
          //alert("cur: \""+curImage+"\"\n\nnew: \""+newImage+"\"\n\nisnew: "+(curImage!=newImage));
          document.getElementById(imageID).innerHTML = newImage;
        }
        firstRun = false;
        attempts = 0;
      }
      else
      {
        attempts++;
        updateBlock();
      }
    }
  }
  ajaxRequest.open("POST", './'+delivPage, true);
  ajaxRequest.send(null); 
}

function check_connection_and_reload()
{
  
  var xmlHttp;
  
  // we go down the list of compatible browsers,
  // through a series of try/catch blocks.
  // if we don't find one, we give and error message.
  try
  {
      // Firefox, Opera 8.0+, Safari
      xmlHttp=new XMLHttpRequest();
  }
  catch (e)
  {
      // Internet Explorer
      try
      {
        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch (e)
      {
        try
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e)
        {
            alert("Your browser does not support AJAX!");
            return false;
        }
      }
  }
  
  xmlHttp.onreadystatechange = function() 
  {
    if(xmlHttp.readyState==4) 
    {
      if(xmlHttp.responseText=='success') 
      {
        window.location.reload();
      }
    }
  };
  
  xmlHttp.open("POST", './'+connPage, true);
  xmlHttp.send('');

}

function switch_onreload(curmenu){
  
  document.getElementById('image_1').style.opacity =0;
  document.getElementById('image_2').style.opacity =0;
  
  if(curmenu == 'image_1' ) 
  {
    curmenu = 'image_2';
  } 
  else if(curmenu == 'image_2') 
  {
    curmenu = 'image_1';
  } 
  
  document.getElementById(curmenu).style.opacity =1;
  current=curmenu;
  
}