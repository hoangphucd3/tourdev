/* -------------------------------
 * All Funtions Start
 ------------------------------- */


(function ($) {
    'use strict';
    $(document).on('click', '#btn-search', function () {
        if (jQuery('.cs-main-nav').hasClass("cs-main-nav-top")) {
            jQuery('.cs-main-nav').removeClass('cs-main-nav-top');
        } else {
            jQuery('.cs-main-nav').addClass('cs-main-nav-top');
        }

    });
    jQuery(window).scroll(function () {
        //Search Toogle Hide on Scroll Start
        if (jQuery('label.collapse').length != '') {
            jQuery("label.collapse").collapse('hide');
        }
        jQuery('.cs-main-nav').removeClass('cs-main-nav-top');
        //Search Toogle Hide on Scroll End
    });
    /* -------------------------------
     * Document Rready Funtion Start
     ------------------------------- */
    jQuery(document).ready(function ($) {
        if (jQuery('.chosen-select, .chosen-select-deselect, .chosen-select-no-single, .chosen-select-no-results, .chosen-select-width').length != '') {
            var config = {
                '.chosen-select': {width: "100%"},
                '.chosen-select-deselect': {allow_single_deselect: true},
                '.chosen-select-no-single': {disable_search_threshold: 10, width: "100%"},
                '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                '.chosen-select-width': {width: "95%"}
            }
            for (var selector in config) {
                jQuery(selector).chosen(config[selector]);
            }
        }
        /*
         * Date Picker
         */
        if (jQuery('.cs-calendar-combo input').length != '') {
            //jQuery('.cs-calendar-combo input').datepicker();
        }

        /*
         * Team Slider Start
         */
        if (jQuery('.cs-recent-gallery').length != '') {
            jQuery('.cs-recent-gallery').slick({
                dots: false,
                infinite: true,
                speed: 500,
                fade: false,
                cssEase: 'linear'
            });
        }

        /*
         * Related Slider Slider Start
         */

        if (jQuery('.related-slider').length != '') {
            $('.related-slider').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        }


        /*
         * Slick Slider 
         */
        if (jQuery('.cs-gallery-slider').length != '') {
            jQuery('.cs-gallery-slider').slick({
                dots: false,
                infinite: true,
                autoplay: true,
                speed: 300,
                arrows: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        }
        /*
         * cs-clients-slider
         */
        if (jQuery('.cs-our-clients-slider').length != '') {
            jQuery('.cs-our-clients-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                speed: 1500,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
        if (jQuery('.cs-clients-slider').length != '') {
            jQuery('.cs-clients-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                speed: 1500,
                arrows: false,
            });
        }


        /*
         * Appointment page Calendar
         */
        if (jQuery('.date-picker').length != '') {
            jQuery(".date-picker").datepicker();
        }

        if (jQuery('.date-picker').length != '') {
            jQuery(".date-picker").on("change", function () {
                var id = jQuery(this).attr("id");
                var val = jQuery("label[for='" + id + "']").text();
                jQuery("#msg").text(val + " changed");
            });
        }

        /*
         * CS Product Slides
         */
        if (jQuery('.cs-product-slides').length != '') {
            jQuery('.cs-product-slides').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                asNavFor: '.cs-product-slides-thumb'
            });
        }
        /*
         * CS Product Slides Thumb
         */
        if (jQuery('.cs-product-slides-thumb').length != '') {
            jQuery('.cs-product-slides-thumb').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.cs-product-slides',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                arrows: false,
            });
        }


        /*
         * Price Filter
         */
        if (jQuery('#ex2').length != '') {
            jQuery("#ex2").slider({});
        }


        /*
         * Pretty Photos
         */
        jQuery(function () {
            if (jQuery('.myphotos').length != '') {
                jQuery('.myphotos').glisse({speed: 300, changeSpeed: 300, effect: 'fade', fullscreen: false});
            }
        });

        /*
         * Gallery Loader 
         */
        if (jQuery('#cs-masonry-gallery').length != '') {
            new AnimOnScroll(document.getElementById('cs-masonry-gallery'), {
                minDuration: 0.4,
                maxDuration: 0.6,
                viewportFactor: 0.2
            });
        }





    });
    /* -------------------------------
     * Document Rready Funtion End
     ------------------------------- */


    /* -------------------------------
     * window Scroll Funtion Start
     ------------------------------- */
    jQuery(window).scroll(function () {

        /*
         * Header Add Class Start
         */

        var scroll = jQuery(window).scrollTop();
        if (scroll >= 200) {
            jQuery(".pinned").addClass("unpinned");
        } else {
            jQuery(".pinned").removeClass("unpinned");
        }


        if (jQuery(".cs-tourdetial-search").length != '') {
            var fixmeTop = $(".cs-tourdetial-search").offset().top;
            var unfixmeTop = $("#itinerary").offset().top - 740;
            $(window).scroll(function () {
                var $window = $(this);
                if ($window.width() > 310) {
                    var currentScroll = $(window).scrollTop();
                    //console.log(unfixmeTop + ' :: ' + currentScroll);
                    var header = $('.cs-tourdetial-search');
                    var headerHeight = header.outerHeight();
                    var body = $('body .wrapper');
                    if (currentScroll >= unfixmeTop) {
                        header.addClass('cs-tourdetial-search-bottom').removeClass('cs-tourdetial-search-fixed');
                        jQuery(".cs-list-short").removeClass("cs-list-short-fixed");
                    } else if (currentScroll >= fixmeTop) {
                        header.addClass('cs-tourdetial-search-fixed').removeClass('cs-tourdetial-search-bottom');
                        jQuery(".cs-list-short").addClass("cs-list-short-fixed");
                    } else if (currentScroll <= fixmeTop) {
                        header.removeClass('cs-tourdetial-search-fixed').removeClass('cs-tourdetial-search-bottom');
                        jQuery(".cs-list-short").removeClass("cs-list-short-fixed");
                    } else {
                        header.removeClass('cs-tourdetial-search-fixed').removeClass('cs-tourdetial-search-bottom');
                    }
                }
            });
        }


    });





//   
//        $('#main, .cs-sub-header ,#header , #short_list ').mouseover(function(){
//            $('#filtration_sidebar').css('z-index' , '1');
//         //   $('#filtration_sidebar').show();
//            
//        })
//        
//        $('#main, .cs-sub-header ,#header , #short_list').mouseout(function(){
//            $('#filtration_sidebar').css('z-index' , '-1');
//           // $('#filtration_sidebar').hide();
//        })


    /* -------------------------------
     * window Scroll Funtion End
     ------------------------------- */



    /* -------------------------------
     * Window Load Funtion End
     ------------------------------- */


//    jQuery(function (jQuery) {
//
//     
//            if (jQuery(this).length != '') {
//                var stylistrand = jQuery(this).data('rand');
//                jQueryportfolio = jQuery(this).parent('div').parent('div').next('.project-stylist-' + stylistrand).find('> .row');
//                if (jQueryportfolio.length == '') {
//                    if (jQuery(this).parent('div').next('.project-stylist-' + stylistrand).find('> .row > ul').length != '') {
//                        jQueryportfolio = jQuery(this).parent('div').next('.project-stylist-' + stylistrand).find('> .row > ul');
//                        alert(jQueryportfolio.html());
//                    } else {
//                        jQueryportfolio = jQuery(this).parent('div').next('.project-stylist-' + stylistrand).find('> .row');
//                    }
//                }
//                jQueryportfolio.isotope({
//                    itemSelector: '.cs-barber-project'+stylistrand,
//                    layoutMode: 'fitRows'
//                });
//                jQueryportfolio_selectors = jQuery(this).find('> li >a');
//                jQueryportfolio_selectors.on('click', function () {
//                    jQueryportfolio_selectors.removeClass('active');
//                    jQuery(this).addClass('active');
//                    var selector = jQuery(this).attr('data-filter');
//                    jQueryportfolio.isotope({filter: selector});
//                    return false;
//                });
//            }
//        });



    /* -------------------------------
     * Window Load Funtion End
     ------------------------------- */



    /* -------------------------------
     * Click Funtion Start
     ------------------------------- */


//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
    jQuery('.btn-number').click(function (e) {
        e.preventDefault();

        var fieldName = jQuery(this).attr('data-field');
        var type = jQuery(this).attr('data-type');
        var input = jQuery("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    jQuery(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    jQuery(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    jQuery('.input-number').focusin(function () {
        jQuery(this).data('oldValue', jQuery(this).val());
    });
    jQuery('.input-number').change(function () {

        var minValue = parseInt(jQuery(this).attr('min'));
        var maxValue = parseInt(jQuery(this).attr('max'));
        var valueCurrent = parseInt(jQuery(this).val());

        var name = jQuery(this).attr('name');
        if (valueCurrent >= minValue) {
            jQuery(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            jQuery(this).val(jQuery(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            jQuery(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            jQuery(this).val(jQuery(this).data('oldValue'));
        }


    });
    if (jQuery('.input-number').length != '') {
        jQuery(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                            (e.keyCode == 65 && e.ctrlKey === true) ||
                            // Allow: home, end, left, right
                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
    }

    "use strict";
    $('#employerid_contactus').click(function (event) {

        traveladvisor_data_loader_load('#cs-profile-contact-detail #main-cs-loader');
//        var default_message = jQuery("#traveladvisor_employer_contactus").data('validationmsg');
//        event.preventDefault();
        var ajaxurl = jQuery(".cs-profile-contact-detail").data('adminurl');

        var captcha_id = jQuery(".cs-profile-contact-detail").data('cap');

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            dataType: "html",
            data: $('#ajaxcontactemployer').serialize() + "&action=ajaxcontact_send_mail",
            success: function (response) {
                //alert(response);
                jQuery("#user_email").removeClass('has_error');
                jQuery("#user_name").removeClass('has_error');
                jQuery("#booking_date").removeClass('has_error');

                var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
                var response_data = response.split("|");
                if (jQuery("#user_name").val() == '') {
                    jQuery("#user_name").addClass('has_error');
                } else
                if (jQuery("#booking_date").val() == '') {
                    jQuery("#booking_date").addClass('has_error');
                } else
                if (!pattern.test(jQuery("#user_email").val())) {
                    jQuery("#user_email").addClass('has_error');

                }
                var error_container = '';
                if (response_data[1] == 1) {
                    error_container = '<div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" type="button" class="close">×</button><p><i class="icon-warning4"></i>' + response_data[0] + '</p></div>';
                    jQuery("#ajaxcontact-response").html(error_container);
                } else {
                    error_container = '<div class="alert success"><button aria-hidden="true" data-dismiss="alert" type="button" class="close">×</button><p><i class="icon-warning4"></i>' + response_data[0] + '</p></div>';
                    jQuery("#ajaxcontact-response").html(error_container);

                    captcha_reload(ajaxurl, captcha_id);
                }

                jQuery('#cs-profile-contact-detail #main-cs-loader').html('');
            }
        });
        return false;
    });
    function traveladvisor_data_loader_load(loader_element) {
        jQuery(loader_element).html('<div class="main-thecube"><div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div></div>');
    }
    function captcha_reload(admin_url, captcha_id) {
        "use strict";
        var dataString = '&action=captcha_reload&captcha_id=' + captcha_id;
        jQuery.ajax({
            type: "POST",
            url: admin_url,
            data: dataString,
            dataType: 'html',
            success: function (data) {
                jQuery("#" + captcha_id + "_div").html(data);

            }
        });
    }
    /* -------------------------------
     * Click Funtion End
     ------------------------------- */
})(jQuery);
/*
 jQuery(document).on('click', '.cs-inv-grid-view', function () {
 
 var traveladvisor_counter = jQuery(this).parents('.cs-inventories-main-box').data('counter');
 
 jQuery(".cs-inventories-listing-loader").html('<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>');
 jQuery('.cs-inventories-listing-loader').show();
 var search_side = jQuery(this).data('search');
 var grid_class = 'col-md-3 col-lg-3';
 if (search_side == 'on') {
 grid_class = 'col-md-4 col-lg-4';
 }
 
 window.setTimeout(function () {
 if (!jQuery('.cs-list').hasClass('grid')) {
 if (jQuery('.cs-list').parent('div').hasClass('col-md-12')) {
 jQuery('.cs-list').parent('div').removeClass('col-md-12');
 jQuery('.cs-list').parent('div').removeClass('col-lg-12');
 jQuery('.cs-list').parent('div').addClass(grid_class);
 }
 
 }
 jQuery(".cs-inventories-listing-loader").html('');
 jQuery('.cs-inventories-listing-loader').hide();
 jQuery('.cs-inv-classic-view').removeClass('active');
 jQuery('.cs-inv-grid-view').addClass('cs-inv-grid-view active');
 
 }, 1000);
 
 var traveladvisor_ajaxurl = jQuery('.cs-inventories-main-box').data('ajaxurl');
 var dataString = 'traveladvisor_inventory_view=grid&traveladvisor_counter=' + traveladvisor_counter + '&action=traveladvisor_set_inventory_view';
 jQuery.ajax({
 type: "POST",
 url: traveladvisor_ajaxurl,
 data: dataString,
 dataType: 'json',
 success: function (response) {
 
 }
 });
 });
 
 jQuery(document).on('click', '.cs-inv-classic-view', function () {
 
 var traveladvisor_counter = jQuery(this).parents('.cs-inventories-main-box').data('counter');
 
 jQuery(".cs-inventories-listing-loader").html('<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>');
 jQuery('.cs-inventories-listing-loader').show();
 var search_side = jQuery(this).data('search');
 var grid_class_one = 'col-md-3';
 var grid_class = 'col-md-3 col-lg-3';
 if (search_side == 'on') {
 grid_class = 'col-md-4 col-lg-4';
 grid_class_one = 'col-md-4';
 }
 
 window.setTimeout(function () {
 
 if (jQuery('.cs-list').hasClass('classic')) {
 if (jQuery('.cs-list').parent('div').hasClass(grid_class_one)) {
 jQuery('.cs-list').parent('div').removeClass(grid_class);
 jQuery('.cs-list').parent('div').addClass('col-md-12 col-lg-12');
 }
 jQuery('.cs-list').removeClass('classic');
 
 }
 jQuery(".cs-inventories-listing-loader").html('');
 jQuery('.cs-inventories-listing-loader').hide();
 jQuery('.cs-inv-grid-view').removeClass('active');
 jQuery('.cs-inv-classic-view').addClass('cs-inv-classic-view active');
 }, 1000);
 
 var traveladvisor_ajaxurl = jQuery('.cs-inventories-main-box').data('ajaxurl');
 alert(traveladvisor_ajaxurl);
 var dataString = 'traveladvisor_inventory_view=classic&traveladvisor_counter=' + traveladvisor_counter + '&action=traveladvisor_set_inventory_view';
 jQuery.ajax({
 type: "POST",
 url: traveladvisor_ajaxurl,
 data: dataString,
 dataType: 'json',
 success: function (response) {
 
 }
 });
 });
 */
jQuery(document).on('click', '.cs-inv-grid-view', function () {

    var traveladvisor_counter = jQuery(this).parents('.cs-inventories-main-box').data('counter');
    jQuery(".main-ajax-loader").html('<div class="main-thecube"><div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div></div>');
    jQuery('.main-ajax-loader').show();

    var search_side = jQuery(this).data('search');
    var grid_class = 'col-md-3 col-lg-3';
    if (search_side == 'on') {
        grid_class = 'col-md-4 col-lg-4';
    }

    window.setTimeout(function () {
        if (!jQuery('.cs-list').hasClass('grid')) {
            if (jQuery('.cs-list').parent('div').hasClass('col-md-12')) {
                jQuery('.cs-list').parent('div').removeClass('col-md-12');
                jQuery('.cs-list').parent('div').removeClass('col-lg-12');
                jQuery('.cs-list').parent('div').addClass(grid_class);
            }
            jQuery('.cs-list').addClass('grid');
            jQuery('.cs-list').removeClass('classic');

        }
        jQuery(".main-ajax-loader").html('');
        jQuery('.main-ajax-loader').hide();
        jQuery('.cs-inv-classic-view').removeClass('active');
        jQuery('.cs-inv-grid-view').addClass('cs-inv-grid-view active');
        
    }, 1000);
   
    var traveladvisore_ajaxurl = jQuery('.cs-inventories-main-box').data('ajaxurl');

    var dataString = 'traveladvisore_inventory_view=grid&traveladvisore_counter=' + traveladvisor_counter + '&action=traveladvisore_set_inventory_view';
    jQuery.ajax({
        type: "POST",
        url: traveladvisore_ajaxurl,
        data: dataString,
        dataType: 'json',
        success: function (response) {
        }

    });


});

jQuery(document).on('click', '.cs-inv-classic-view', function () {

    var traveladvisor_counter = jQuery(this).parents('.cs-inventories-main-box').data('counter');

    jQuery(".main-ajax-loader").html('<div class="main-thecube"><div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div></div>');
    jQuery('.main-ajax-loader').show();
    var search_side = jQuery(this).data('search');
    var grid_class_one = 'col-md-3';
    var grid_class = 'col-md-3 col-lg-3';
    if (search_side == 'on') {
        grid_class = 'col-md-4 col-lg-4';
        grid_class_one = 'col-md-4';
    }
    window.setTimeout(function () {

        if (jQuery('.cs-list').hasClass('grid')) {
            if (jQuery('.cs-list').parent('div').hasClass(grid_class_one)) {
                jQuery('.cs-list').parent('div').removeClass(grid_class);
                jQuery('.cs-list').parent('div').addClass('col-md-12 col-lg-12');
            }
            jQuery('.cs-list').addClass('classic');
            jQuery('.cs-list').removeClass('grid');

        }
        jQuery(".main-ajax-loader").html('');
        jQuery('.main-ajax-loader').hide();
        jQuery('.cs-inv-grid-view').removeClass('active');
        jQuery('.cs-inv-classic-view').addClass('cs-inv-classic-view active');
        $(window).trigger('resize');
    }, 1000);
    
    var traveladvisore_ajaxurl = jQuery('.cs-inventories-main-box').data('ajaxurl');
    var dataString = 'traveladvisore_inventory_view=classic&traveladvisore_counter=' + traveladvisor_counter + '&action=traveladvisore_set_inventory_view';
    jQuery.ajax({
        type: "POST",
        url: traveladvisore_ajaxurl,
        data: dataString,
        dataType: 'json',
        success: function (response) {



        }

    });


});


jQuery(".maps").css("pointer-events", "none");
jQuery(".cs-map").css("pointer-events", "none");

var onMapMouseleaveHandler = function (event) {
    var that = jQuery(this);

    that.on('click', onMapClickHandler);
    that.off('mouseleave', onMapMouseleaveHandler);
    jQuery(".maps").css("pointer-events", "none");
    jQuery(".cs-map").css("pointer-events", "none");
}

var onMapClickHandler = function (event) {
    var that = jQuery(this);
    // Disable the click handler until the user leaves the map area
    that.off('click', onMapClickHandler);

    // Enable scrolling zoom
    that.find('.maps').css("pointer-events", "auto");
    that.find('.cs-map').css("pointer-events", "auto");

    // Handle the mouse leave event
    that.on('mouseleave', onMapMouseleaveHandler);
}
jQuery(document).on('click', '.page-section', onMapClickHandler);
jQuery(document).on('click', '.cs-map-section', onMapClickHandler);


jQuery(document).ready(function () {
    jQuery("area[rel^='prettyPhoto']").prettyPhoto();
    jQuery(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'fast', slideshow: 10000, hideflash: true});
    jQuery(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'fast', slideshow: 10000, hideflash: true});
    jQuery("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
        custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
        changepicturecallback: function () {
            initialize();
        }
    });
    jQuery("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
        custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
        changepicturecallback: function () {
            _bsap.exec();
        }
    });
});
    
/* -------------------------------
 * All Funtions End
 ------------------------------- */
