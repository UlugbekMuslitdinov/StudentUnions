const su_nav_component = Vue.component('su-navigation',{
    template: 
        '<div class="wrap-nav">'+
            '<div class="wrap-sumain-menu">'+
                '<ul class="nav sumain-menu">'+
                    '<slot></slot>'+
                '</ul>'+
            '</div>'+
        '</div>'
    
})

const megaDropDown_Component = Vue.component('su-mega-dropdown',{
    props: ['id', 'name', 'url', 'list'],
    methods: {
        mouseOver: function(event, id){
            if (id != ''){
                // event.target.classList.add('mega-menu-hover');
                document.getElementById('su_main_nav_'+id).classList.add('drop-menu-list-hover');
            }
        },
        mouseOut: function(event, id){
            if (id != ''){
                // event.target.classList.remove('mega-menu-hover');
                document.getElementById('su_main_nav_'+id).classList.remove('drop-menu-list-hover');
            }
        }
    },
    template: 
        '<li class="mega-drop-down">'+
            '<a v-bind:id="\'su_main_nav_\'+ id" v-bind:href="url">'+
                '{{name}}'+
                '<i class="fa fa-chevron-down"></i>'+
            '</a>'+
            '<div '+
                'class="animated fadeIn mega-menu"'+
                'v-bind:id="\'mainmenu_\'+ id"'+
                '@mouseenter.self="mouseOver(event, id)"'+
                '@mouseleave.self="mouseOut(event, id)"'+
                '>'+
                '<div class="mega-menu-wrap">'+
                    '<div class="row">'+
                        '<slot></slot>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</li>'
    
})

const megaDropDownLi_Component = Vue.component('su-mega-dropdown-li',{
    props: ['data', 'key'],
    methods : {
        printTitle: function(title) {
            return '<i class="fas fa-angle-right"></i>' + title;
        },
        mouseOver: function(event, id){
            if (id != ''){
                // event.target.classList.add('mega-menu-hover');
                document.getElementById('su_mainnav_'+id).classList.add('child-menu-active');
            }
        },
        mouseOut: function(event, id){
            if (id != ''){
                // event.target.classList.remove('mega-menu-hover');
                document.getElementById('su_mainnav_'+id).classList.remove('child-menu-active');
            }
        }
    },
    template: 
        '<ul class="stander">'+
            '<li>'+

                '<template v-if="data.url !== \'\'">'+
                    '<a v-bind:href="data.url" v-bind:style="[data.title === \'\' ? {\'marginBottom\': \'23px\'} : null]" :target="hrefTarget(data.target)" v-html="data.title"></a>'+
                '</template>'+
                '<template v-else>'+
                    '<a v-bind:style="[data.title === \'\' ? {\'marginBottom\': \'23px\'} : null]" v-html="data.title" ></a>'+
                '</template>'+

                '<ul class="submenu">'+
                    '<li v-for="(list, index) in data.list" >'+
                        '<template v-if="list.child_id === \'\'">'+
                            '<a v-bind:href="list.url" :target="hrefTarget(list.target)" v-html="printTitle(list.title)"></a>'+
                        '</template>'+
                        '<template v-else>'+
                            '<div class="wrap-su-mainnav-child" v-bind:id="\'su_mainnav_\' + list.child_id" @mouseenter.self="mouseOver(event, list.child_id)" @mouseleave.self="mouseOut(event, list.child_id)">'+
                                '<a v-bind:href="list.url" :target="hrefTarget(list.target)" v-html="printTitle(list.title)" ></a>'+
                                '<ul class="child-menu">'+
                                    '<li v-for="(clist, cindex) in list.child" >'+
                                        '<a v-bind:href="clist.url" :target="hrefTarget(clist.target)" v-html="printTitle(clist.title)"></a>'+
                                    '</li>'+
                                '</ul>'+
                            '</div>'+
                        '</template>'+
                    '</li>'+
                '</ul>'+
            '</li>'+
        '</ul>'
    
})