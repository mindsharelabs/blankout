/*
 Blankout Scripts File

 This file should contain any js scripts you want to add to the site.
 Instead of calling it in the header or throwing it inside wp_head()
 this file will be called automatically in the footer so as not to
 slow the page load.

 */

jQuery.noConflict();
jQuery(document).ready(function() {
	init();
});

function init() {

	// bind Bootsrtap's CSS classes to Grvaity Forms 
	jQuery(document).bind('gform_post_render', function(){
		jQuery('.button').addClass('btn');
		jQuery('.button').addClass('btn-primary');
		jQuery('.gform_next_button').addClass('pull-right');
		jQuery('.gform_button').addClass('pull-right');
		jQuery('.gform_button').addClass('btn-success');
		jQuery('.gform_page').addClass('row');
		jQuery('.gform_page_footer').addClass('span8');
		jQuery('.gform_button').addClass('controls');
		jQuery('.gfield_error').addClass('inputWarning');
		jQuery('.validation_error').addClass('alert');
		jQuery('.validation_error').addClass('alert-error');
		jQuery('#input_1_28').addClass('span8');
		jQuery('#input_1_32').addClass('span8');
	});

	//jQuery("#suckerfishnav li:last-child ").css("border-right","none");

	/*jQuery('a[href=#top]').click(function(){
	 jQuery('html, body').animate({scrollTop:0}, 400);
	 return false;
	 });*/

}

// fgnass.github.com/spin.js#v1.2.7
!function(e, t, n) {
	function o(e, n) {
		var r = t.createElement(e || "div"), i;
		for(i in n) {
			r[i] = n[i];
		}
		return r
	}

	function u(e) {
		for(var t = 1, n = arguments.length; t < n; t++) {
			e.appendChild(arguments[t]);
		}
		return e
	}

	function f(e, t, n, r) {
		var o = [
			"opacity", t, ~~(e * 100), n, r
		].join("-"), u = .01 + n / r * 100, f = Math.max(1 - (1 - e) / t * (100 - u), e), l = s.substring(0, s.indexOf("Animation")).toLowerCase(), c = l && "-" + l + "-" || "";
		return i[o] || (a.insertRule("@" + c + "keyframes " + o + "{" + "0%{opacity:" + f + "}" + u + "%{opacity:" + e + "}" + (u + .01) + "%{opacity:1}" + (u + t) % 100 + "%{opacity:" + e + "}" + "100%{opacity:" + f + "}" + "}", a.cssRules.length), i[o] = 1), o
	}

	function l(e, t) {
		var i = e.style, s, o;
		if(i[t] !== n) {
			return t;
		}
		t = t.charAt(0).toUpperCase() + t.slice(1);
		for(o = 0; o < r.length; o++) {
			s = r[o] + t;
			if(i[s] !== n) {
				return s
			}
		}
	}

	function c(e, t) {
		for(var n in t) {
			e.style[l(e, n) || n] = t[n];
		}
		return e
	}

	function h(e) {
		for(var t = 1; t < arguments.length; t++) {
			var r = arguments[t];
			for(var i in r) {
				e[i] === n && (e[i] = r[i])
			}
		}
		return e
	}

	function p(e) {
		var t = {x: e.offsetLeft, y: e.offsetTop};
		while(e = e.offsetParent) {
			t.x += e.offsetLeft, t.y += e.offsetTop;
		}
		return t
	}

	var r = ["webkit", "Moz", "ms", "O"], i = {}, s, a = function() {
		var e = o("style", {type: "text/css"});
		return u(t.getElementsByTagName("head")[0], e), e.sheet || e.styleSheet
	}(), d = {lines: 12, length: 7, width: 5, radius: 10, rotate: 0, corners: 1, color: "#000", speed: 1, trail: 100, opacity: .25, fps: 20, zIndex: 2e9, className: "spinner", top: "auto", left: "auto", position: "relative"}, v = function m(e) {
		if(!this.spin) {
			return new m(e);
		}
		this.opts = h(e || {}, m.defaults, d)
	};
	v.defaults = {}, h(v.prototype, {spin: function(e) {
		this.stop();
		var t = this, n = t.opts, r = t.el = c(o(0, {className: n.className}), {position: n.position, width: 0, zIndex: n.zIndex}), i = n.radius + n.length + n.width, u, a;
		e && (e.insertBefore(r, e.firstChild || null), a = p(e), u = p(r), c(r, {left: (n.left == "auto" ? a.x - u.x + (e.offsetWidth >> 1) : parseInt(n.left, 10) + i) + "px", top: (n.top == "auto" ? a.y - u.y + (e.offsetHeight >> 1) : parseInt(n.top, 10) + i) + "px"})), r.setAttribute("aria-role", "progressbar"), t.lines(r, t.opts);
		if(!s) {
			var f = 0, l = n.fps, h = l / n.speed, d = (1 - n.opacity) / (h * n.trail / 100), v = h / n.lines;
			(function m() {
				f++;
				for(var e = n.lines; e; e--) {
					var i = Math.max(1 - (f + e * v) % h * d, n.opacity);
					t.opacity(r, n.lines - e, i, n)
				}
				t.timeout = t.el && setTimeout(m, ~~(1e3 / l))
			})()
		}
		return t
	}, stop:                               function() {
		var e = this.el;
		return e && (clearTimeout(this.timeout), e.parentNode && e.parentNode.removeChild(e), this.el = n), this
	}, lines:                              function(e, t) {
		function i(e, r) {
			return c(o(), {position: "absolute", width: t.length + t.width + "px", height: t.width + "px", background: e, boxShadow: r, transformOrigin: "left", transform: "rotate(" + ~~(360 / t.lines * n + t.rotate) + "deg) translate(" + t.radius + "px" + ",0)", borderRadius: (t.corners * t.width >> 1) + "px"})
		}

		var n = 0, r;
		for(; n < t.lines; n++) {
			r = c(o(), {position: "absolute", top: 1 + ~(t.width / 2) + "px", transform: t.hwaccel ? "translate3d(0,0,0)" : "", opacity: t.opacity, animation: s && f(t.opacity, t.trail, n, t.lines) + " " + 1 / t.speed + "s linear infinite"}), t.shadow && u(r, c(i("#000", "0 0 4px #000"), {top: "2px"})), u(e, u(r, i(t.color, "0 0 1px rgba(0,0,0,.1)")));
		}
		return e
	}, opacity:                            function(e, t, n) {
		t < e.childNodes.length && (e.childNodes[t].style.opacity = n)
	}}), function() {
		function e(e, t) {
			return o("<" + e + ' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">', t)
		}

		var t = c(o("group"), {behavior: "url(#default#VML)"});
		!l(t, "transform") && t.adj ? (a.addRule(".spin-vml", "behavior:url(#default#VML)"), v.prototype.lines = function(t, n) {
			function s() {
				return c(e("group", {coordsize: i + " " + i, coordorigin: -r + " " + -r}), {width: i, height: i})
			}

			function l(t, i, o) {
				u(a, u(c(s(), {rotation: 360 / n.lines * t + "deg", left: ~~i}), u(c(e("roundrect", {arcsize: n.corners}), {width: r, height: n.width, left: n.radius, top: -n.width >> 1, filter: o}), e("fill", {color: n.color, opacity: n.opacity}), e("stroke", {opacity: 0}))))
			}

			var r = n.length + n.width, i = 2 * r, o = -(n.width + n.length) * 2 + "px", a = c(s(), {position: "absolute", top: o, left: o}), f;
			if(n.shadow) {
				for(f = 1; f <= n.lines; f++) {
					l(f, -2, "progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");
				}
			}
			for(f = 1; f <= n.lines; f++) {
				l(f);
			}
			return u(t, a)
		}, v.prototype.opacity = function(e, t, n, r) {
			var i = e.firstChild;
			r = r.shadow && r.lines || 0, i && t + r < i.childNodes.length && (i = i.childNodes[t + r], i = i && i.firstChild, i = i && i.firstChild, i && (i.opacity = n))
		}) : s = l(t, "animation")
	}(), typeof define == "function" && define.amd ? define(function() {
		return v
	}) : e.Spinner = v
}(window, document);

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if(!window.getComputedStyle) {
	window.getComputedStyle = function(el, pseudo) {
		this.el = el;
		this.getPropertyValue = function(prop) {
			var re = /(\-([a-z]){1})/g;
			if(prop == 'float') {
				prop = 'styleFloat';
			}
			if(re.test(prop)) {
				prop = prop.replace(re, function() {
					return arguments[2].toUpperCase();
				});
			}
			return el.currentStyle[prop] ? el.currentStyle[prop] : null;
		}
		return this;
	}
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

	/*
	 Responsive jQuery is a tricky thing. There's a bunch of different ways to handle it, so be sure to research and find the one that works for you best.
	 */

	/* getting viewport width */
	var responsive_viewport = $(window).width();

	/* if is below 481px */
	if(responsive_viewport < 481) {

	}
	/* end smallest screen */

	/* if is larger than 481px */
	if(responsive_viewport > 481) {

	}
	/* end larger than 481px */

	/* if is above or equal to 768px */
	if(responsive_viewport >= 768) {

		/* load gravatars */
		$('.comment img[data-gravatar]').each(function() {
			$(this).attr('src', $(this).attr('data-gravatar'));
		});

	}

	/* off the bat large screen actions */
	if(responsive_viewport > 1030) {

	}

	// add all your scripts here

	var opts = {
		lines:     13, // The number of lines to draw
		length:    4, // The length of each line
		width:     2, // The line thickness
		radius:    6, // The radius of the inner circle
		corners:   1, // Corner roundness (0..1)
		rotate:    0, // The rotation offset
		color:     '#000', // #rgb or #rrggbb
		speed:     1, // Rounds per second
		trail:     60, // Afterglow percentage
		shadow:    false, // Whether to render a shadow
		hwaccel:   true, // Whether to use hardware acceleration
		className: 'spinner', // The CSS class to assign to the spinner
		zIndex:    0, // The z-index (defaults to 2000000000)
		top:       'auto', // Top position relative to parent in px
		left:      'auto' // Left position relative to parent in px
	};
	var target = document.getElementById('carousel');
	var spinner = new Spinner(opts).spin(target);

	$('.carousel').carousel()

});
/* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
 */
(function(w) {
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if(!( /iPhone|iPad|iPod/.test(navigator.platform) && navigator.userAgent.indexOf("AppleWebKit") > -1 )) {
		return;
	}
	var doc = w.document;
	if(!doc.querySelector) {
		return;
	}
	var meta = doc.querySelector("meta[name=viewport]"), initialContent = meta && meta.getAttribute("content"), disabledZoom = initialContent + ",maximum-scale=1", enabledZoom = initialContent + ",maximum-scale=10", enabled = true, x, y, z, aig;
	if(!meta) {
		return;
	}
	function restoreZoom() {
		meta.setAttribute("content", enabledZoom);
		enabled = true;
	}

	function disableZoom() {
		meta.setAttribute("content", disabledZoom);
		enabled = false;
	}

	function checkTilt(e) {
		aig = e.accelerationIncludingGravity;
		x = Math.abs(aig.x);
		y = Math.abs(aig.y);
		z = Math.abs(aig.z);
		// If portrait orientation and in one of the danger zones
		if(!w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) )) {
			if(enabled) {
				disableZoom();
			}
		} else if(!enabled) {
			restoreZoom();
		}
	}

	w.addEventListener("orientationchange", restoreZoom, false);
	w.addEventListener("devicemotion", checkTilt, false);
})(this);
