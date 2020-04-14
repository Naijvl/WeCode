!(function ($) {

	$(window).scroll(function () {
		var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;

		if (scrollTop != 0) {
			$("#wpadminbar").addClass("heavy-shadow");
		} else {
			$("#wpadminbar").removeClass("heavy-shadow");
		}
	});

})(jQuery);
