/*! /*! ARTAŞ KUTU - v1.0.0 - 2021
 * Copyright (c) 2021 - designerAgency: Diverseffect.com;
 */
$(function () {
    $.app = {
        PageLoad: function () {
            $.app.MobileMenu();
            $.app.fancybox();

            if ($(".homeSlider").length) {
                $.app.promoSlider();
            };

            if ($(".accardion").length) {
                $.app.accardionMenu();
            };

            //if ($(".productSlider").length) {
            //    $.app.productSlider();
            //};

            if ($(".sliderSlogan").length) {
                $.app.sloganSlider();
            };

            if ($(".logoSlider").length) {
                $.app.logoSlider();
            };



            $(".dropbtn").on("click", function (event) {
                event.preventDefault();
                var datafor = $(this).attr("data-for");
                $('.'+datafor+'').toggleClass("show");
                return false;
            });

            window.onclick = function (event) {
                if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }

            $(".search a").click(function (event) {
                event.preventDefault();
                $(".SearchBar").slideToggle(200, function () {
                    if ($(this).is(':visible')) {
                        $(this).find("input[type=text]").focus();
                    } else {
                        $(this).find("input[type=text]").blur();
                        $(this).find("input[type=text]").val("");
                    }
                });
                $(this).toggleClass("Active");
            });
        },
        //Ana Sayfa Slider
        promoSlider: function () {
            $('.homeSlider').slick({
                dots: true,
                autoplay: true,
                autoplaySpeed: 4000,
                mobileFirst: true,
                easing: "linear",
                edgeFriction: .35,
                lazyLoad: "ondemand",
                infinite: false,
                speed: 500,
                slidesToShow: 1,
                adaptiveHeight: true,
                touchThreshold: 5,
                prevArrow: $(".promoPrev"),
                nextArrow: $(".promoNext"),
                appendDots: $(".slickDots"),
                responsive: [
                    {
                        breakpoint: 600,
                        settings: {
                            dots: true,
                            arrows: false
                        }
                    },
                ],
            })
        },
        productSlider: function () {
            $('.productSlider').slick({
                arrows: true,
                autoplay: true,
                dots: false,
                infinite: true,
                autoplaySpeed: 4000,
                easing: "linear",
                edgeFriction: .35,
                speed: 1000,
                focusOnSelect: true,
                slidesToShow: 2,
                slidesToScroll: 2,
                responsive: [
                    {
                        breakpoint: 1330,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        },
        sloganSlider: function () {
            $('.sliderSlogan').slick({
                dots: false,
                autoplay: true,
                autoplaySpeed: 4000,
                mobileFirst: true,
                easing: "linear",
                edgeFriction: .35,
                lazyLoad: "ondemand",
                infinite: false,
                speed: 500,
                slidesToShow: 1,
                adaptiveHeight: true,
                touchThreshold: 5,
                prevArrow: $(".sloganPrev"),
                nextArrow: $(".sloganNext"),
            })
        },
        logoSlider: function () {
            $('.logoSlider').slick({
                arrows: true,
                autoplay: true,
                dots: false,
                infinite: true,
                autoplaySpeed: 2000,
                easing: "linear",
                edgeFriction: .35,
                speed: 500,
                focusOnSelect: true,
                slidesToShow: 6,
                slidesToScroll: 6,
                prevArrow: $(".portfolioPrev"),
                nextArrow: $(".portfolioNext"),
                responsive: [
                    {
                        breakpoint: 1330,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    }
                ]
            });
        },
        accardionMenu : function() {
            $('.accardion li .Button').on('click', function(e) {
                e.preventDefault();
                var replyElement = $(this).closest('li').find(".Capsule");
                if((replyElement.is(':visible'))){
                    replyElement.slideUp(400, function() {
                        $(this).css('display', 'none');
                    });
                    $(this).closest('li').removeClass("push");
                }else{
                    $(".accardion li .Capsule").slideUp(400, function() {
                        $(this).css('display', 'none');
                    });
                    $(".accardion li").removeClass("push");
                    replyElement.slideDown(200, function() {
                        $(this).css('display', 'inline-block');
                    });
                    $(this).closest('li').addClass("push");
                }
            });
        },

        //fancybox
        fancybox: function () {
            $("[data-fancybox]").fancybox({
                margin: [0, 0]
            });
            $.fancybox.defaults.hash = false;
        },
        //MobileMenu
        MobileMenu: function () {
            //Mobile SubMenu Olusturma
            var SubPageTopMenu = $('.header .topRow .topMenu').html();
            var SubPageMenu = $('.header ul.menu').html();
            var Social = $('.header .topRow .social').html();
            $(".MobilMenu").append('<div class="container-fluid WhiteRow"><div class="container-fluid container"><ul class="navMenu">' + SubPageMenu + '</ul></div></div><div class="container-fluid greyRow"><div class="container-fluid container submenu">' + SubPageTopMenu + '</div><div class="container-fluid container social">' + Social + '</div></div>');
            $(".MobileBt").on("click", function (event) {
                event.preventDefault();
                $(this).toggleClass("push");
                $(".MobilMenu").toggleClass("OpenMenu");
                $("body").toggleClass("release");
                $("html").toggleClass("htmlrelease");
                return false;
            });
            $(".SubPageMenu").on("click", function (event) {
                event.preventDefault();
                $(".SubPageMenu").toggleClass("push");
                var subSticky = $(this).closest(".leftMenu").find("ul:first");
                if ((subSticky.is(':visible'))) {
                    subSticky.slideUp(300);
                    subSticky.removeClass("subSticky");
                } else {
                    subSticky.slideDown(300);
                    subSticky.addClass("subSticky");
                }
                return false;
            });
        },
        boxStretch: function () {
            var device = $(window).innerWidth() > 768 ? "desktop" : "mobile";
            $(".homeSlider .slide").each(function () {
                if (device == "mobile") {
                    $(this).find(".cropcontainer").attr("style", "background-image: url(" + $(this).data(device) + ")");
                } else {
                    $(this).find(".cropcontainer").attr("style", "background-image: url(" + $(this).data(device) + ")");
                }
            });
        }
    }
});

$(document).ready(function ($) {
    $.app.PageLoad();
    $.app.boxStretch();

    $(window).on("scroll", function () {
        if ($(window).scrollTop() >= 2) {
            $('body').addClass("sticky");
        } else {
            $('body').removeClass("sticky");
        }

    });

    $(window).resize(function () {
        $.app.boxStretch();
    });

});
