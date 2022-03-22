(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{42:function(e,t,a){e.exports=a(63)},47:function(e,t,a){},48:function(e,t,a){},63:function(e,t,a){"use strict";a.r(t);var n=a(0),r=a.n(n),c=a(12),o=a.n(c),l=(a(47),a(15)),i=a(16),s=a(20),u=a(17),m=a(19),d=(a(48),a(10)),f=a(64),p=a(72),b=a(65),h=a(66),E=a(67),v=a(68),O=a(69),g=a(40),j=a(18),y="FETCH_LIST",x="FETCH_LIST_SUCCESS",k="FETCH_LIST_FAILED";function C(){return function(e){e({type:y}),fetch("/feedback/api/get_locations.php").then(function(e){return e.json()}).then(function(t){return e({type:x,locations:t})}).catch(function(t){return e(function(e){return{type:k,err:e}}(t))})}}var T="UPDATE_LOCATIONS";var w="ADD_FEEDBACK";var L="UPDATE_TEXT";var _="FORM_SUBMIT",S="FORM_SUBMIT_SUCCESS",F="FORM_SUBMIT_FAILED";function N(){return function(e,t){e({type:_});var a=t(),n={name:a.name,email:a.email,feedback:a.feedback};fetch("/feedback/api/insert_feedback.php",{body:JSON.stringify(n),method:"POST"}).then(function(e){if(e.ok)return e.json();throw new Error("An error occurred.")}).then(function(t){return e(function(e){return{type:S,res:e}}(t))}).catch(function(t){e(function(e){return{type:F,err:e}}(t))})}}var I=function(e){function t(e){var a;return Object(l.a)(this,t),(a=Object(s.a)(this,Object(u.a)(t).call(this,e))).state={options:[],selectedOption:null},a.handleChange=a.handleChange.bind(Object(d.a)(Object(d.a)(a))),a}return Object(m.a)(t,e),Object(i.a)(t,[{key:"componentDidMount",value:function(){this.props.fetchList()}},{key:"handleChange",value:function(e){this.props.updateLocations(e)}},{key:"render",value:function(){var e=this,t=this.props.state,a=t.selectedLocations,n=t.locations;return r.a.createElement(g.a,{isMulti:!0,name:"colors",onChange:function(t){return e.handleChange(t)},options:n,value:a,className:"basic-multi-select",classNamePrefix:"select"})}}]),t}(n.Component),A=Object(j.b)(function(e){return{state:e}},function(e){return{fetchList:function(){return e(C())},updateLocations:function(t){return e(function(e){return{type:T,locations:e}}(t))}}})(I);var M=function(e){function t(e){var a;return Object(l.a)(this,t),(a=Object(s.a)(this,Object(u.a)(t).call(this,e))).handleText=a.handleText.bind(Object(d.a)(Object(d.a)(a))),a}return Object(m.a)(t,e),Object(i.a)(t,[{key:"handleText",value:function(e){var t=e.target,a=t.value,n=t.name;this.props.updateText(n,a)}},{key:"render",value:function(){var e=this,t=this.props.state,a=t.selectedLocations,n=t.errors,c=t.submitted;return r.a.createElement("div",null,r.a.createElement("h2",{className:"display-4",style:{color:"#003366"}},"Student Union Feedback box"),r.a.createElement("p",{style:{marginLeft:"10px"}},"Comments, questions or requests go in our cool feedback box."),r.a.createElement("hr",null),r.a.createElement(f.a,{style:{paddingLeft:"10px"}},n.length>0?r.a.createElement(p.a,{color:"danger",className:"col-md-10"},"An error occurred."):null,0===n.length&&c?r.a.createElement(p.a,{color:"success"},"Form submitted successfully!"):null,r.a.createElement(b.a,{row:!0},r.a.createElement(h.a,{for:"name",sm:12},"Name"),r.a.createElement(E.a,{sm:10},r.a.createElement(v.a,{onChange:this.handleText,type:"text",name:"name",id:"name",placeholder:"Name",style:{width:"400px"}}))),r.a.createElement(b.a,{row:!0},r.a.createElement(h.a,{for:"email",sm:12},"Email"),r.a.createElement(E.a,{sm:10},r.a.createElement(v.a,{onChange:this.handleText,type:"email",name:"email",id:"email",placeholder:"example@email.arizona.edu",style:{width:"400px"}}))),r.a.createElement(b.a,{row:!0},r.a.createElement(h.a,{for:"exampleSelectMulti",sm:12},"Select Locations",r.a.createElement("sup",{className:"text-danger"},"*")),r.a.createElement(E.a,{sm:10},r.a.createElement(A,{required:!0}))),a.map(function(t,a){return r.a.createElement(b.a,{key:a,row:!0},r.a.createElement(h.a,{style:{color:"#CC0033"},for:"exampleText",sm:12},t.value,r.a.createElement("sup",{className:"text-danger"},"*")),r.a.createElement(E.a,{sm:10},r.a.createElement(v.a,{type:"textarea",onChange:function(a){return e.props.feedback(t.value,a.target.value)},name:t.value+"_feedback",id:"feedback_box"})))}),r.a.createElement(b.a,{check:!0,row:!0,style:{marginTop:"40px",paddingLeft:"16px"}},r.a.createElement(E.a,{sm:{size:10},style:{paddingLeft:"0px"}},r.a.createElement(O.a,{color:"",className:"su-btn btn-lg btn-block",onClick:this.props.submitForm},"Submit")))))}}]),t}(r.a.Component),U=Object(j.b)(function(e){return{state:e}},function(e){return{feedback:function(t,a){return e(function(e,t){return{type:w,location:e,text:t}}(t,a))},submitForm:function(){return e(N())},updateText:function(t,a){return e(function(e,t){return{type:L,field:e,text:t}}(t,a))}}})(M),D=a(70),B=a(71),P=function(e){function t(){return Object(l.a)(this,t),Object(s.a)(this,Object(u.a)(t).apply(this,arguments))}return Object(m.a)(t,e),Object(i.a)(t,[{key:"render",value:function(){return r.a.createElement("div",null,r.a.createElement(D.a,null,r.a.createElement(B.a,null,r.a.createElement(U,null))))}}]),t}(n.Component);Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));a(62);var q=a(13),z=a(23),H=a(9),J={errors:[],list:[],loading:!1,locations:[],feedback:{},name:"",email:"",selectedLocations:[],submitted:!1};var R=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:J,t=arguments.length>1?arguments[1]:void 0;switch(t.type){case y:return Object(H.a)({},e,{loading:!0});case x:for(var a=t.locations,n=0;n<a.length;n++){var r=a[n];"Uncategorized"===r.location_name&&(a[n]=a[0],a[0]=r)}return a.map(function(e){e.value=e.location_name,e.label=e.location_name}),Object(H.a)({},e,{loading:!1,locations:a});case k:var c=e.errors;return c.push(t.err),Object(H.a)({},e,{errors:c,loading:!1});case T:return Object(H.a)({},e,{selectedLocations:t.locations});case w:var o=e.feedback;return o[t.location]=t.text,Object(H.a)({},e,{feedback:o});case L:var l=t.field,i=t.text;return Object(H.a)({},e,Object(z.a)({},l,i));case _:return Object(H.a)({},e,{loading:!0});case S:return Object(H.a)({},e,{submitted:!0,loading:!1,errors:[],feedback:{},selectedLocations:[]});case F:var s=e.errors;return s.push(t.err),Object(H.a)({},e,{submitted:!0,loading:!1,errors:s});default:return e}},W=a(37),K=a(38),X=a.n(K),$=Object(q.d)(R,Object(q.c)(Object(q.a)(W.a),Object(q.a)(X.a)));o.a.render(r.a.createElement(j.a,{store:$},r.a.createElement(P,null)),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then(function(e){e.unregister()})}},[[42,1,2]]]);
//# sourceMappingURL=main.e4ec3708.chunk.js.map