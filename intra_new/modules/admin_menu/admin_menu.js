/* $Id: admin_menu.js,v 1.1.4.1 2007/09/28 16:34:58 sun Exp $ */
/**
 * Suckerfish Dropdowns, www.htmldog.com
 *
 * IE fix.
 */
sfHover = function() {
	sfEls = document.getElementById("admin_menu").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
