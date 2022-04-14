<?php
session_start();

include_once 'template/global.inc';

$page_options['head'] = '';
$page_options['title'] = 'The Arizona Student Unions';
$page_options['has_mobile_version'] = 1;
// $page_options['script_incs']= array('/js/rotate.js');
page_start($page_options);
?>

<div class="container" style="">
    <div class="row">
        <a class="col-md-12 p-2 corona-home-link" style="background-color: #ac051f; color: #fff; text-align: center; font-size: 18px; font-weight: 600;" href="/coronavirus/index.php">News & Update</a>
    </div>
</div>

<div class="container">
	<div id="su_homepage" class="row"></div>
</div>

    <link href="/template/homepage/static/css/2.ecbe249a.chunk.css" rel="stylesheet">
    <link href="/template/homepage/static/css/main.86d3f0e1.chunk.css" rel="stylesheet">
    
    <script>!function(l){function e(e){for(var r,t,n=e[0],o=e[1],u=e[2],f=0,i=[];f<n.length;f++)t=n[f],p[t]&&i.push(p[t][0]),p[t]=0;for(r in o)Object.prototype.hasOwnProperty.call(o,r)&&(l[r]=o[r]);for(s&&s(e);i.length;)i.shift()();return c.push.apply(c,u||[]),a()}function a(){for(var e,r=0;r<c.length;r++){for(var t=c[r],n=!0,o=1;o<t.length;o++){var u=t[o];0!==p[u]&&(n=!1)}n&&(c.splice(r--,1),e=f(f.s=t[0]))}return e}var t={},p={1:0},c=[];function f(e){if(t[e])return t[e].exports;var r=t[e]={i:e,l:!1,exports:{}};return l[e].call(r.exports,r,r.exports,f),r.l=!0,r.exports}f.m=l,f.c=t,f.d=function(e,r,t){f.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:t})},f.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},f.t=function(r,e){if(1&e&&(r=f(r)),8&e)return r;if(4&e&&"object"==typeof r&&r&&r.__esModule)return r;var t=Object.create(null);if(f.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:r}),2&e&&"string"!=typeof r)for(var n in r)f.d(t,n,function(e){return r[e]}.bind(null,n));return t},f.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return f.d(r,"a",r),r},f.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},f.p="/template/homepage/";var r=window.webpackJsonp=window.webpackJsonp||[],n=r.push.bind(r);r.push=e,r=r.slice();for(var o=0;o<r.length;o++)e(r[o]);var s=n;a()}([])</script>

    <script src="/template/homepage/static/js/2.a3b05e32.chunk.js"></script>
    <script src="/template/homepage/static/js/main.939024bb.chunk.js"></script>


<?php
page_finish();
?>
<link href="/template/homepage/home_mobile.css" rel="stylesheet">