const su_mobile_nav_component = Vue.component('su-mobile-navigation',{
    methods: {
        mobileMenuToggle: function(event){
            const element = document.getElementsByClassName('sumob-menu')[0];
            if (element.classList.contains('open')){
                element.classList.remove('open');
                document.getElementsByClassName('mobile-nav-menu-icon')[0].classList.remove('open');
            }
            else {
                element.classList.add('open');
                document.getElementsByClassName('mobile-nav-menu-icon')[0].classList.add('open');
            }
        }
    },
    template: 
        '<div class="wrap-mobile-nav">'+
            '<div class="wrap-sumob-menu">'+
                '<div class="mobile-nav-menu-icon" @mousedown="mobileMenuToggle(event)">'+
                    '<span></span>'+
                    '<span></span>'+
                    '<span></span>'+
                '</div>'+
                '<ul class="sumob-menu animated fadeIn">'+
                    '<slot></slot>'+
                '</ul>'+
            '</div>'+
        '</div>'
    
});

const su_mobile_nav_li_component = Vue.component('su-mobile-nav-li',{
    props: ['title', 'data', 'id', 'selected'],
    methods: {
        printTitle: function(title) {
            return '<i class="fas fa-angle-right"></i>' + title;
        },
        toggleChild: function(id) {       
            const selected_ele = document.getElementById(id);

            if (selected_ele.classList.contains('open')){
                selected_ele.classList.remove('open');
            }
            else {
                selected_ele.classList.add('open');
            }

            // check previously selected item
            if (id !== this.selected){
                if (this.selected !== 'none'){
                    // document.getElementById(this.selected).classList.remove('open');
                }
                this.selected = id;
            }
        }
    },
    template: 
        '<li>'+
            '<div class="" @mousedown="toggleChild(\'sumob_\'+id)">'+
                '{{title}}'+
                '<i class="fas fa-caret-down"></i>'+
            '</div>'+
            '<ul class="su-mob-child" v-bind:id="\'sumob_\'+id">'+
                '<li v-for="(row, index) in data" >'+
                    '<template v-if="row.title !== \'\'">'+
                        '<div @mousedown="toggleChild(\'sumob_\'+id+\'_\'+index)">'+
                            '{{row.title}}'+
                            '<i class="fas fa-caret-down"></i>'+
                        '</div>'+
                        '<template v-if="row.list !== undefined">'+
                            '<ul class="su-mob-child" v-bind:id="\'sumob_\'+id+\'_\'+index">'+
                                '<li v-for="(li, li_index) in row.list" >'+
                                    '<a v-bind:href="li.url" :target="hrefTarget(li.target)" v-html="printTitle(li.title)"></a>'+
                                '</li>'+
                            '</ul>'+
                        '</template>'+
                    '</template>'+
                '</li>'+
            '</ul>'+
        '</li>'
    
});