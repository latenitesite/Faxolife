jQuery(document).ready(function () {
	c9Page.init();
});

var c9Page = (function ($) {
	var c9PageInit = {};

	c9PageInit.init = function () {
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////// Sidebars on some templates //////////////////////////////////////////////////

		jQuery(window).scroll(function () {
			//scroll position variable
			var scroll = jQuery(window).scrollTop();

			if (scroll >= 633) {
				jQuery("#left-sidebar").addClass("fixed-sidebar");
				jQuery("#right-sidebar").addClass("fixed-sidebar");
			}
			if (scroll <= 632) {
				jQuery("#left-sidebar").removeClass("fixed-sidebar");
				jQuery("#right-sidebar").removeClass("fixed-sidebar");
			}
		});

		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////// Mobile and desktop navigation classes //////////////////////////////////////////////////
		if ($(window).width() <= 667) {
			//use small nav for mobile
			$(".navbar").addClass("navbar-small");
			$("body").addClass("navbar-small");

			$(window).scroll(function () {
				//scroll position variable
				var scroll = $(window).scrollTop();

				if (scroll >= 288) {
					$(".navbar").addClass("opacity0");
				}
				if (scroll <= 287) {
					$(".navbar").removeClass("opacity0");
				}

				if (scroll >= 338) {
					$(".navbar").addClass("fixed-top opacity100");
					$(".header-navbar").addClass("jumpfix"); //accounts for position-fixed CSS change
				}
				if (scroll <= 337) {
					$(".navbar").removeClass("fixed-top opacity100");
					$(".header-navbar").removeClass("jumpfix"); //remove extra classes and put navs back at top
				}
			});
		} else {
			//end small screens so desktop next

			//var logoHeight = $(".c9-custom-logo").height();

			$(window).scroll(function () {
				//scroll position variable
				var scroll = $(window).scrollTop();

				if (scroll >= 168) {
					$(".navbar").addClass("opacity0");
				}
				if (scroll <= 167) {
					$(".navbar").removeClass("opacity0");
				}

				if (scroll >= 218) {
					$(".navbar").addClass("navbar-small fixed-top opacity100"); //shrink nav and fix it to top
					$(".header-navbar").addClass("jumpfix");
					//$(".header-navbar.jumpfix").css("height", "108px");
				}
				if (scroll <= 217) {
					$(".navbar").removeClass(
						"navbar-small fixed-top opacity100"
					); //expand nav and remove fixed
					$(".header-navbar").removeClass("jumpfix");
				}
			});
		} //end regular
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		///////////////////////// for putting WordPress galleries linked to images/videos in lightbox ////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$(
			".cortex-popup-video,a.wp-block-button__link[href*='youtube.com'],a.wp-block-button__link[href*='vimeo.com'],a.wp-block-button__link[href*='maps.google.com']"
		).magnificPopup({
			disableOn: 700,
			type: "iframe",
			mainClass: "mfp-zoom-in",
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});

		$(
			'.wp-block-gallery a[href$=".jpg"], .wp-block-gallery a[href$=".jpeg"], .wp-block-gallery a[href$=".png"], .wp-block-gallery a[href$=".gif, "], .cortex-popup, .gallery-item a'
		).click(function (e) {
			e.preventDefault();

			var items = [];
			var firstItem = $(this).attr("href");
			var firstCaption = $(this).attr("title");

			items.push({
				src: firstItem,
				title: firstCaption
			});

			//items after
			$(this)
				.parent()
				.parent()
				.nextAll()
				.children()
				.find("a")
				.each(function () {
					var imageLink = $(this).attr("href");
					var imageCaption = $(this).attr("title");
					items.push({
						src: imageLink,
						title: imageCaption
					});
				});

			//items before
			$(this)
				.parent()
				.parent()
				.prevAll()
				.children()
				.find("a")
				.each(function () {
					var imageLink = $(this).attr("href");
					var imageCaption = $(this).attr("title");
					items.push({
						src: imageLink,
						title: imageCaption
					});
				});

			$.magnificPopup.open({
				items: items,
				type: "image",
				gallery: {
					enabled: true
				},
				mainClass: "mfp-zoom-in",
				callbacks: {
					open: function () {
						//overwrite default prev + next function. Add timeout for css3 crossfade animation
						$.magnificPopup.instance.next = function () {
							var self = this;
							self.wrap.removeClass("mfp-image-loaded");
							setTimeout(function () {
								$.magnificPopup.proto.next.call(self);
							}, 120);
						};
						$.magnificPopup.instance.prev = function () {
							var self = this;
							self.wrap.removeClass("mfp-image-loaded");
							setTimeout(function () {
								$.magnificPopup.proto.prev.call(self);
							}, 120);
						};
					},
					imageLoadComplete: function () {
						var self = this;
						setTimeout(function () {
							self.wrap.addClass("mfp-image-loaded");
						}, 16);
					}
				}
			});
		});

		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		//////////////////////////////////////       full screen search        ///////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$(".btn-nav-search").on("click", function (e) {
			e.preventDefault();
			$("#fullscreensearch").addClass("open");
			$('#fullscreensearch > form > div > input[type="search"]').focus();
		});

		$(
			"#fullscreensearch, #fullscreensearch .search-close, #fullscreensearch .search-close .fa-close"
		).on("click keyup", function (e) {
			if (
				e.target == this ||
				e.target.className == "search-close" ||
				e.keyCode == 27
			) {
				$(this).removeClass("open");
				$(this)
					.parent()
					.removeClass("open");
				$(this)
					.parent()
					.parent()
					.removeClass("open");
			}
		});
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	};
	return c9PageInit;
})(jQuery);