var su_footer_component = Vue.component('su-footer',{
	template: 
	   	'<div class="container-fluid wrap-su-footer">'+
			'<div class="container main-container">'+
				'<div class="row">'+
				
					'<div class="col-1"></div>'+

					'<div class="col-4 wrap-f-contactus">'+
						'<h4 class="su-footer-header" style="display:none;">Contact Us<span></span></h4>'+
						'<h5 class="su-footer-subheader">Student Union Memorial Center</h5>'+
						'<p>1303 E. University Blvd</p>'+
						'<p>Tucson, AZ 85719</p>' +
						'<p>P:520.621.7755</p>'+

						'<h5 class="su-footer-subheader">Global Center</h5>'+
						'<p>615 N Park Ave</p>'+
						'<p>Tucson, AZ 85721</p>' +
						'<p>P:520.621.2338</p>'+

						'<h5 class="su-footer-subheader">Meal Plans</h5>'+
						'<p>Student Union Memorial Center</p>'+
						'<p>Lower Level</p>' +
						'<p>P:520.621.7043</p>'+
					'</div>'+

					'<div class="col-3 wrap-f-quicklink">'+
						'<h4 class="su-footer-header" style="display:none;">Informations<span></span></h4>'+
						'<h5 class="su-footer-subheader">Information</h5>'+
						'<a href="/about/" class="f-quicklink">About Us</a>'+
						'<a href="/dining/" class="f-quicklink">Restaurants</a>'+
						'<a href="/infodesk/maps/" class="f-quicklink">Maps</a>'+
						'<a href="/infodesk/hours/" class="f-quicklink">Hours</a>'+
						'<a href="https://shop.arizona.edu" class="f-quicklink">BookStores</a>'+
						
						'<h5 class="su-footer-subheader">Policy</h5>'+
						'<a href="https://privacy.arizona.edu/privacy-statement" class="f-quicklink" target="_blank">UA Electronic Privacy Policy</a>'+
					'</div>'+

					'<div class="col-3 wrap-f-social">'+
						'<h4 class="su-footer-header" style="display:none;">Follow Us<span></span></h4>'+
						'<h5 class="su-footer-subheader">Follow Us</h5>'+
						'<div>'+
							'<a class="btn-floating btn-lg btn-facebook f-social" href="https://www.facebook.com/uazunions"><i class="fab fa-facebook"><span>Facebook</span></i></a>'+
							'<a class="btn-floating btn-lg btn-instagram f-social" href="https://www.instagram.com/uazunions"><i class="fab fa-instagram"><span>Instagram</span></i></a>'+
							'<a class="btn-floating btn-lg btn-tw f-social" href="https://twitter.com/uazunions"><i class="fab fa-twitter-square"><span>Twitter</span></i></a>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>'
})

var su_footer_instance = {
	el: "#su_footer",
}

var su_footer = new Vue(su_footer_instance);

/* <a class="btn-floating btn-lg btn-snap f-social" href=""><i class="fab fa-snapchat-square"><span>Snapchat</span></i></a> */