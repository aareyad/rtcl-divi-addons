<?php

namespace RtclDiviAddons\Hooks;

class ActionHooks {

	/**
	 * @return void
	 */
	public static function init(): void {
		add_action( 'wp_footer', [ __CLASS__, 'init_slider_frontend_builder' ] );
	}

	public static function init_slider_frontend_builder() {
		?>
        <script>
            /*(function ($) {
                $(document).ready(function () {
                    var waitForElements = setInterval(function () {
                        var $elements = $('.rtcl-carousel-slider');
                        if ($elements.length) {
                            clearInterval(waitForElements);
                            //$elements.rtcl_slider();
                            /!*$elements.each(function () {
                                $(this).rtcl_slider();
                            });*!/
                        }
                    }, 500);
                });
            }(jQuery));*/
            // adding navigation html
            /*(function ($) {
                $(document).ready(function () {
                    var waitForElements = setInterval(function () {
                        let sliders = document.querySelectorAll('.rtcl-listings-slider-container');
                        console.log(sliders);
                        console.log('load');
                        if (sliders.length) {
                            clearInterval(waitForElements);
                            console.log('loaded elemets');
                            sliders.forEach(function (slider) {
                                swiper_init(slider)
                            })
                        }
                    }, 2000);
                });

                function swiper_init(slider) {
                    // configuration
                    if (slider === null) return;
                    // extra controls
                    let extraControls = '';
                    // If we need pagination
                    extraControls += '<div class="swiper-pagination"></div>';
                    // If we need navigation buttons
                    extraControls += '<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>';
                    slider.innerHTML = '<div class="swiper-container" style="overflow:hidden">' + slider.innerHTML + '</div>' + extraControls;

                    // Wait for Swiper
                    var waitForSwiper = setInterval(function () {
                        if (typeof Swiper != "undefined") {
                            clearInterval(waitForSwiper);
                            let carousel_container = slider.querySelector('.swiper-container');
                            const swiper = new Swiper(carousel_container, {
                                slidesPerView: 1, // mobile value
                                loop: true,
                                spaceBetween: 0, // mobile value
                                autoplay: {
                                    delay: 3000,
                                },
                                speed: 600,
                                // If we need pagination
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true,
                                    dynamicBullets: true
                                },
                                // Navigation arrows
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },
                                breakpoints: {
                                    768: { // Tablet
                                        slidesPerView: 2,
                                        spaceBetween: 20,
                                    },
                                    981: { // Desktop
                                        slidesPerView: 3,
                                        spaceBetween: 30,
                                    }
                                }
                            });
                        }
                    }, 20);
                }
            }(jQuery));*/
        </script>
		<?php
	}

}