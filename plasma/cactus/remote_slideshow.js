/**
 * Begins a slide show in the selected div(s) with
 * resources from the specified URL
 * url: The URL of the slides
 * selector: The div(s) in which to place the slides
 * debug: (Optional) Div(s) to display debug info
 */
function start(url, selector, debug)
{
	var slideshow = new Slideshow(url, selector, debug);
	slideshow.begin();
}

/*
 * The main "class" for this program. All functions
 * are called on Slideshows. A slideshow implements
 * a queue of slide lists and ensures that incoming
 * slides are displayed at the correct time.
 */
function Slideshow(url, selector, debug)
{
	// The site we query for our slides
	this.fetchUrl = url;
	// The divs we put the slides in
	this.holderSelector = selector;
	// The div for debug info
	this.debug = debug;
	
	// Implements a circularly linked list with a pointer
	// to the currently displayed menu. Each menu can
	// have its own unique display interval.
	this.previousSlideList; // The previous slideshow can be removed from the DOM
	this.currentSlideList = new Array();
	this.nextSlideList = new Array();
	this.currentSlideIndex = 0;
}

/**
 * Creates a new slide Object. Slides have a unique id and a duration.
 * The ID can be used to find the div with that ID. The duration is the
 * number of milliseconds the div is visible
 */
function Slide(id, resource, viewingTime)
{
	this.id = id;
	this.resource = resource;
	this.viewingTime = viewingTime;
}

/*
 * Rotates in the most recently fetched slide list
 * and implicitly marks the old one for deletion
 */
Slideshow.prototype.rotateLists = function()
{
	this.previousSlideList = this.currentSlideList;
	this.currentSlideList = this.nextSlideList;
	this.nextSlideList = null;				
}

/*
 * Returns a pointer to the current slide
 * May return a null slide
 */
Slideshow.prototype.getCurrentSlide = function()
{
	return this.currentSlideList[this.currentSlideIndex];
}

/*
 * Computes and returns a pointer to the next slide
 * May return a null slide
 */
Slideshow.prototype.getNextSlide = function()
{
	if(this.currentSlideList.length <= 0)
	{
		if(this.nextSlideList != null)
			this.rotateLists();
		this.currentSlideIndex = 0;
		return this.currentSlideList[0];
	}
	else
	{
		this.currentSlideIndex = (this.currentSlideIndex + 1) % this.currentSlideList.length;
		if(this.currentSlideIndex == 0 && this.nextSlideList != null)
			this.rotateLists();
		return this.currentSlideList[this.currentSlideIndex];
	}
}

/*
 * Removes from the DOM all slides in the previous slide list
 */
Slideshow.prototype.cleanupDocument = function()
{
	if(this.previousSlideList != null)
	{
		// Remove old slides from document
		for(var i = 0; i < this.previousSlideList.length; i++)
			$('#' + this.previousSlideList[i].id).remove();
		this.previousSlideList = null;
	}
}

/*
 * Starts the slideshow. Starts showing debug info
 * if requested
 */
Slideshow.prototype.begin = function()
{
	this.fetch();
	this.switchImages();
	var that = this;
	if(this.debug != '')
		setInterval(function(){that.updateDebugInfo();}, 500);
}

/**
 * Gets the next set of slides. May be equivalent to current set.
 * Slide swapping handles this.
 */
Slideshow.prototype.fetch = function()
{
	var that = this;
	var slideshowDuration = 0;
	$.ajax({url: this.fetchUrl, dataType: "json"}).done(
		function (data)
		{
			that.nextSlideList = new Array();
			for(var index in data)
			{
				var slideData = data[index];
				slideshowDuration += slideData['viewing_time'];
				that.nextSlideList.push(new Slide(slideData['id'], slideData['resource'], slideData['viewing_time'] * 1000));
				$(that.holderSelector).append(slideData['div']);
			}
		});
	// We ensure that we don't fetch data faster than we can rotate through
	// the slides once. This way, the DOM doesn't get cluttered
	setTimeout(function(){that.fetch()}, Math.max(slideshowDuration, 60000));
}

/**
 * This function uses JQuery to fade the menu divs containing images
 * in and out. It also updates what the current with a duration equal
 * to the listed duration for the new image, implementing a slideshow
 */
Slideshow.prototype.switchImages = function()
{
	var that = this;
	
	var currentSlide = this.getCurrentSlide();
	var nextSlide = this.getNextSlide();
	
	// jQuery animations use a duration. If we are "transitioning" to
	// the same slide, we set the duration to 0.
	var duration = 'slow';
	if(currentSlide != null && nextSlide != null && currentSlide.resource == nextSlide.resource)
		duration = 0;
	
	// nextSlide will either be a new (non-null) slide
	// or the current slide. Either way, it is ok to
	// hide and show independently.
	if(currentSlide != null)
		$('#' + currentSlide.id).fadeOut(duration);
		
	if(nextSlide != null)
		$('#' + nextSlide.id).fadeIn(duration, function()
		{
			that.cleanupDocument();
			setTimeout(function(){that.switchImages();}, nextSlide.viewingTime);
		});
	else
		setTimeout(function(){that.switchImages();}, 1000);
}

/**
 * Shows the list of current and immediately future slides in the
 * rotation.
 */
Slideshow.prototype.updateDebugInfo = function(debug)
{
	var text = 'Slides<br/>';
	for(var i = 0; i < this.currentSlideList.length; i++)
	{
		var value = this.currentSlideList[i].id + ' (' + this.currentSlideList[i].resource + '): ' + this.currentSlideList[i].viewingTime  / 1000
		if(i == this.currentSlideIndex)
			text += '<span style="color: green">[' + value + 's, current]</span><br/>';
		else
			text += '[' + value + 's, current]<br/>';
	}
	if(this.nextSlideList != null)
	{
		for(var i = 0; i < this.nextSlideList.length; i++)
		{
			var value = this.nextSlideList[i].id + ' (' + this.nextSlideList[i].resource + '): ' + this.nextSlideList[i].viewingTime  / 1000
			text += '[' + value + 's, next]<br/>';
		}
	}
	$(this.debug).html(text);
}