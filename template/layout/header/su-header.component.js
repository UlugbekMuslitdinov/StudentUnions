const su_header_component = Vue.component('su-header',{
	template: 
				'<div class="container main-container">'+
					'<div class="row">'+
						'<div class="col su-logo-column">'+
							'<a href="/" class="su-logo-link">'+
								'<img src="/template/layout/header/img/su_logo.png" alt="Student Union Logo" />'+
							'</a>'+
						'</div>'+
						'<div class="col" style="padding: 0px;">'+
							'<slot></slot>'+
						'</div>'+
					'</div>'+
				'</div>'
	
})

const su_header_instance = {
	el: "#su_header"
}

const su_header = new Vue(su_header_instance);