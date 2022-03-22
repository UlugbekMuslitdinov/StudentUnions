const su_sidenav_component = Vue.component('su-sidenav',{
	template: `
                <div className="col wrap-left-col">
                    <div id="left-col" className="wrap-left-col-menu">
                    </div>
				</div>
	`
})

const su_sidenav_instance = {
	el: "#su_sidenav"
}

const su_sidenav = new Vue(su_sidenav_instance);