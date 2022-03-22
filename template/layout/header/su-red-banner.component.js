const su_redBanner_component = Vue.component('su-red-banner',{
	template: 
				'<div class="container-fluid su-red-banner">'+
					'<div class="container">'+
						'<div class="row">'+
							'<div class="col-12">'+
								'<div :style="{float:\'right\'}">'+
                                    '<a href="/about/"><span>About Us</span></a>'+
                                    '<a href="/infodesk/hours/"><span>Hours</span></a>'+
									'<a href="/mealplans/"><span>Meal Plans</span></a>'+
									'<a href="/about/tellus/"><span>Feedback</span></a>'+
                                '</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'
				
})


// const su_redBanner_component = Vue.component('su-red-banner',{
// 	template: `
// 				<div class="container-fluid su-red-banner">
// 					<div class="container">
// 						<div class="row">
// 							<div class="col-12">
// 								<div :style="{float:'right'}">
//                                     <a href="/aboutus/"><span>About Us</span></a>
//                                     <a href="/aboutus/"><span>Hours</span></a>
//                                     <a href="/aboutus/"><span>Other Links</span></a>
//                                     // <div :style="{display: 'inline-table'}">
//                                     //     <div class="md-form active-white active-white-2 mt-0 mb-0">
//                                     //     	<input type="text" class="form-control red-search-input" placeholder="Search" value="">
//                                     //     </div>
//                                     // </div>
//                                 </div>
// 							</div>
// 						</div>
// 					</div>
// 				</div>
// 				`
// })
