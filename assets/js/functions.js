

(function ($) {
    "use strict";
    // catagory-container swiper slider init
    var catagoryContainer = new Swiper('.catagory-container', {
        slidesPerView: 6,
        loop: true,
        navigation: {
            nextEl: '.catagory-slider-next',
            prevEl: '.catagory-slider-prev',
          },
        spaceBetween: 30,
        breakpoints: {
            990: {
                slidesPerView: 4
            },
            768: {
                slidesPerView: 2
            },
            540: {
                slidesPerView: 2
            },
            400: {
                slidesPerView: 2
            }
        }
    });


    // trending-product-container swiper slider init
    var trendingContainer = new Swiper('.trending-product-container', {
        slidesPerView: 4,
        loop: true,
        navigation: {
            nextEl: '.trending-slider-next',
            prevEl: '.trending-slider-prev',
          },
        spaceBetween: 30,
        breakpoints: {
            1200: {
                slidesPerView: 3
            },
            990: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            540: {
                slidesPerView: 1
            },
            400: {
                slidesPerView: 1
            }
        }
    });

    // trending-product-container swiper slider init
    var recommendContainer = new Swiper('.recommend-product-container', {
        slidesPerView: 4,
        loop: true,
        navigation: {
            nextEl: '.trending-slider-next',
            prevEl: '.trending-slider-prev',
          },
        spaceBetween: 30,
        breakpoints: {
            1200: {
                slidesPerView: 3
            },
            990: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            540: {
                slidesPerView: 1
            },
            400: {
                slidesPerView: 1
            }
        }
    });

    // brand-feature-product-container swiper slider init
    var recommendContainer = new Swiper('.feature-brand-container', {
        slidesPerView: 5,
        loop: true,
        navigation: {
            nextEl: '.brand-feature-slider-next',
            prevEl: '.brand-feature-slider-prev',
          },
        spaceBetween: 30,
        breakpoints: {
            1200: {
                slidesPerView: 4
            },
            990: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2
            },
            540: {
                slidesPerView: 1
            },
            400: {
                slidesPerView: 1
            }
        }
    });

    // trending-product-container swiper slider init
    var testimonialContainer = new Swiper('.testimonial-container', {
        slidesPerView: 1,
        loop: true,
        navigation: {
            nextEl: '.testimonial-slider-next',
            prevEl: '.testimonial-slider-prev',
          },
        spaceBetween: 30,
    });

    // banner-slider-container swiper slider init
    var banneSliderConainer = new Swiper('.banner-slider-container', {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 0,
        speed: 900,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
          }
    });

    // infoBoxContainer swiper slider init
    var infoBoxContainer = new Swiper('.info-box-container', {
        slidesPerView: 3,
        loop: true,
        centeredSlides: true,
        initialSlide: 2,
        spaceBetween: 30,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
          },
        breakpoints: {
            990: {
                slidesPerView: 2
            },
            767: {
                slidesPerView: 1
            }
        }
    });


    $('.info-hover-effect-parent').on('mouseover', '.info-hover-effect-child', function() {
        $('.info-hover-effect-child.active').removeClass('active');
        $(this).addClass('active');
    });

    $('.product-slick').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        vertical: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        centerMode: true,
        asNavFor: '.product-slick',
        arrows: true,
        dots: false,
        focusOnSelect: true
    });


    
    $('.add-product img').elevateZoom({
        zoomType: "inner",
        scrollZoom : true
    });

    // $('.cart-btn-toggle').on('click', function(){
    //     $(this).closest('.cart-btn-toggle').find('.cart-btn').hide()
    //     $(this).closest('.cart-btn-toggle').find('.price-btn').show()
    // })
   // $('.cart-btn').on('click', function(){
      //  $(this).parent('.cart-btn-toggle').find('.cart-btn').hide()
      //  $(this).parent('.cart-btn-toggle').find('.price-btn').show()
   // })
    $('.price-increase-decrese-group .quantity-right-plus').on('click', function() {
        var $qty = $(this).closest('.price-increase-decrese-group').find('.input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
    $('.price-increase-decrese-group .quantity-left-minus').on('click', function() {
        var ths = $(this);
        var $qty = $(this).closest('.price-increase-decrese-group').find('.input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal) && currentVal > 0) {
            $qty.val(currentVal - 1);
        }
        if(currentVal === 1){
            console.log(ths);
            // ths.parents('.price-increase-decrese-group').css('background-color','red');
            ths.parents('.price-btn').hide();
            ths.parents('.price-btn').siblings('.cart-btn').show();
        }
    });

    
    var $qty = $(this).closest('.price-increase-decrese-group').find('.input-number');
    var currentVal = $qty.val();
    if(currentVal === 0){
        // $(this).closest('.cart-btn-toggle').find('.cart-btn').show()
        $(this).closest('.cart-btn-toggle').find('.price-btn').hide()
    }

    $(".wish-link").on("click",function(e){
     //   e.preventDefault();
        $(this).toggleClass("focus");
        // $("p").toggleClass("main");
    });

    // $(".all-catagory-option > a").on("click",function(e){
    //     $('.page-layout').toggleClass('open-side-menu')
    //     $('body').toggleClass('open-side-menu')
    // });
    var contentwidth = jQuery(window).width();
    if ((contentwidth) > '1200') {
        $('.home-layout').addClass('open-side-menu')
    }
    if ((contentwidth) > '1200') {
        $('.sticky-sidebar-home').addClass('open-side-menu')
    }
    if ((contentwidth) < '991') {
        $('.widget .widget-wrapper').addClass('collapse')
    }

    if ((contentwidth) < '991') {
        $('.cart-btn-toggle').removeAttr('onclick');
    }


    $('.cart-product-item>.close-item').on('click',function(){
        $(this).parent('.cart-product-item').remove();
    })

    $('.wishlist-item>.close-item').on('click',function(){
        $(this).parent('.wishlist-item').remove();
    })
    

     // fixed menu app home page
     $(window).on("scroll",function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $(".header-bottom,.mobile-header,.catagory-sidebar-area").addClass("fixed-totop animated slideInDown");
        } else {
            $(".header-bottom,.mobile-header,.catagory-sidebar-area").removeClass("fixed-totop  animated slideInDown");
        }
    });


     // fixed bottom to top
    $(window).on("scroll",function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 500) {
            $(".to-top").addClass("fixed-totopmbb");
        } else {
            $(".to-top").removeClass("fixed-totopmbb");
        }
    });


  /*  //popup
    $('.popup-close,.popup-overlay').on("click", function(){
        $('#popup').hide();
    });*/
    $(document).ready(function()  {
        if(!localStorage.getItem("cookieBannerDisplayed"))
        {
        $("#popup").delay(2000).fadeIn();
        }
    });

    if($(window).width() > 990) {
        $(document).ready(function() {
            $('.sidebar')
                .theiaStickySidebar({
                    additionalMarginTop: 110
                });
        });
    }

    $(document).on('click',".cookie-btn ",function(){
        $('#popup').hide();
        localStorage.setItem("cookieBannerDisplayed","true");
    });

    $(document).on('click',".cookie-exit ",function(){
        deleteAllCookies();
        $('#popup').hide();
    });

    function deleteAllCookies() {
        var cookies = document.cookie.split(";");
    
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            var eqPos = cookie.indexOf("=");
            var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        }
    }

    $(function () {
        setNavigation();
    });
    
    function setNavigation() {
        var pathArray = window.location.pathname.split('/');
        var lastItem = pathArray.pop();
        $(".menu a").each(function () {
            var href = $(this).attr('href');
            if (lastItem.substring(0, href.length) === href) {
                var myLi = $(this).closest('li');
                myLi.addClass('active');
                myLi.parent().parent().addClass('active');
            }
        });
    }

        


    
    
})(jQuery);	



function cartopen() {
    //alert("Hi")
    document.getElementById("sitebar-cart").classList.add('open-cart');
    document.getElementById("sitebar-drawar").classList.add('hide-drawer');
}

function cartclose() {
    document.getElementById("sitebar-cart").classList.remove('open-cart');
    document.getElementById("sitebar-drawar").classList.remove('hide-drawer');
}

// open modal
function openModal() {
    document.getElementById("product-details-popup").classList.add('open-side');
}

$(document).on('click','.modalOpen',function(){
    var el = $(this);
    var id = el.attr("id");
    
   // $('#hidden_id').text()
    
  //  $('#hidden_unit').text()
   // $('#hidden_discount').text()
    $('#modal-product-name').text($(`#hidden_name${id}`).val());
    $('#modal-product-category').text($(`#itemCategory${id}`).text());
    $('#modal-product-price').text($(`#hidden_price${id}`).val());
    $('#modal-product-image').append('<img src="images/products/'+$(`#hidden_image${id}`).val()+' alt="product"></img>');
});

function closeModal() {
    document.getElementById("product-details-popup").classList.remove('open-side');
}

// open signup form
function OpenSignUpForm() {
    document.getElementById("login-area").classList.add('open-form');
}

function CloseSignUpForm() {
    document.getElementById("login-area").classList.remove('open-form');
}



// jQuery(function($){
//     $(document).ajaxSend(function() {
//         $("#overlay").fadeIn(300);???
//     });
        
//     $('#edit').click(function(){
//         $.ajax({
//             type: 'GET',
//             success: function(){
//                 $("#load-data").load("components/edit-profile.html", function(responseTxt, statusTxt, xhr){
//                     if(statusTxt == "success")
//                       alert("External content loaded successfully!");
//                     if(statusTxt == "error")
//                       alert("Error: " + xhr.status + ": " + xhr.statusText);
//                   });
//             }
//         }).done(function() {
//             setTimeout(function(){
//                 $("#overlay").fadeOut(300);
//             },500);
//         });
//     });	
// });


$(document).ready(function(){

$("input[type='radio']").click(function(){
    var sim = $("input[type='radio']:checked").val();
    //alert(sim);
    if (sim<3) { $('.myratings').css('color','red'); $(".myratings").text(sim); }
    else{ $('.myratings').css('color','green'); $(".myratings").text(sim); } 
    }); 
});


$(document).on('click','.userSubscription',function(){
    var email = $('.userSubscription').val();
    var token = $('.newsletter_token').val();
    var where = 'newsletter'
    $.post("add.php",{email:email,token:token,where:where},
    function(result){
        if (result == 'success') {
            alert('Thank you. Your newsletter subsription was successful!');
            location.reload(true);
           }
            else if (result == 'exists') {
            alert('You are already subscribed for our newsletter.');
           }
           else if (result == 'error') {
            alert('Something went wrong. Please try again later.');
           }
            else{
            alert("Something went wrong. Please try again later.");
           }
    });        
});

$(document).on('click','.anonymousSubscription',function(){
    var email = $('#anonymousEmail').val();
    var token = $('.newsletter_token').val();
    var where = 'newsletter'
    $.post("add.php",{email:email,token:token,where:where},
    function(result){
        if (result == 'success') {
            alert('Thank you. Your newsletter subsription was successful!');
            location.reload(true);
           }
            else if (result == 'exists') {
            alert('You are already subscribed for our newsletter.');
           }
            else{
            alert("Something went wrong. Please try again later.");
           }
    }); 
  });

  /*$(document).on('click','.cart-btn',function(){
    var id = $(this).attr("id");
    $.post("cart.php",{hidden_id:id,hidden_name:$(`#hidden_name${id}`).val(),hidden_unit:$(`#hidden_unit${id}`).val(),hidden_discount:$(`#hidden_discount${id}`).val(),hidden_price:$(`#hidden_price${id}`).val(),hidden_image:$(`#hidden_image${id}`).val(),'cart_button':'cart_button'},
    function(result){
        alert(result);
            $('#actionAlert').html(result);
            var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            var item_qty = data[3];
            $(`#cart_subtotal${id}`).html(subtotal);
            $('#total_value').html(total);
            $('#navbar_cart_hidden').val(total_hidden);
            $('#navbar_cart_total').html(total);
            $(`#productlist_qty${id}`).val(item_qty);
            $('#cart_total').val(total_hidden);
            $(`#featured_qty${id}`).val(item_qty);
            $(`#recommended_qty${id}`).val(item_qty);
            $(`#cart_unit_qty${id}`).html(item_qty);
            $('#mobile_cart_total').html(total);   
    }); 
  });*/

  $(document).on('click','.cart_increase',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#cart_qty${id}`).val();
    var total = $('#cart_total').val();
    var where = 'cart_increase'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        if (result == 'max') {
            alert('Quantity Unavailable');
           }
        else{
            var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            var item_qty = data[3];
            $(`#cart_subtotal${id}`).html(subtotal);
            $('#total_value').html(total);
            $('#navbar_cart_hidden').val(total_hidden);
            $('#navbar_cart_total').html(total);
            $(`#productlist_qty${id}`).val(item_qty);
            $('#cart_total').val(total_hidden);
            $(`#featured_qty${id}`).val(item_qty);
            $(`#recommended_qty${id}`).val(item_qty);
            $(`#cart_unit_qty${id}`).html(item_qty);
            $('#mobile_cart_total').html(total);
        }   
    }); 
  });

  $(document).on('click','.cart_decrease',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#cart_qty${id}`).val();
    var total = $('#cart_total').val();
    var where = 'cart_decrease'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        var data = $.parseJSON(result);
        var subtotal = data[0];
        var total = data[1];
        var total_hidden = data[2];
        var item_qty = data[3];
        $(`#cart_subtotal${id}`).html(subtotal);
        $('#total_value').html(total);
        $('#navbar_cart_hidden').val(total_hidden);
        $('#navbar_cart_total').html(total);
        $(`#productlist_qty${id}`).val(item_qty);
        $('#cart_total').val(total_hidden);
        $(`#featured_qty${id}`).val(item_qty);
        $(`#recommended_qty${id}`).val(item_qty);
        $(`#cart_unit_qty${id}`).html(item_qty);
        $('#mobile_cart_total').html(total);
    }); 
  });

  $(document).on('click','.checkout_cart_increase',function(){
    var el = $(this);
    var id = el.attr("id");
    if ($(`#hiddenAvailableQty${id}`).val() != null){
        $(`#checkout_cart_qty${id}`).val($(`#hiddenAvailableQty${id}`).val());     
        const item = document.querySelector(`#item${id}`);
        if (item.classList.contains("stock-out")) {
        item.classList.remove("stock-out");
        }
    }
    var qty = $(`#checkout_cart_qty${id}`).val();
    var total = $('#checkout_total').val();
    var where = 'cart_increase';

    $.post("cart.php",{id:id,qty:qty,total:total,where:where},
    function(result){
        if (result == 'max') {
            alert('Quantity Unavailable');    
           }
           else{
            var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            var item_qty = data[3];
            $(`#checkout_subtotal${id}`).html(subtotal);
            $('#checkout_total_value').html(total);
            $('#checkout_total').val(total_hidden);
            $('#navbar_cart_hidden').val(total_hidden);
            $('#navbar_cart_total').html(total);
            $(`#checkout_unit_qty${id}`).html(item_qty);
            $('#mobile_cart_total').html(total); 
        }  
    }); 
  });

  $(document).on('click','.checkout_cart_decrease',function(){
    var el = $(this);
    var id = el.attr("id");
    if ($(`#hiddenAvailableQty${id}`).val() != null){
        $(`#checkout_cart_qty${id}`).val($(`#hiddenAvailableQty${id}`).val());
        const item = document.querySelector(`#item${id}`);
        if (item.classList.contains("stock-out")) {
        item.classList.remove("stock-out");
        }
    }
    var qty = $(`#checkout_cart_qty${id}`).val();
    var total = $('#checkout_total').val();
    var where = 'cart_decrease';
    $.post("cart.php",{id:id,qty:qty,total:total,where:where},
    function(result){
        var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            var item_qty = data[3];
            $(`#checkout_subtotal${id}`).html(subtotal);
            $('#checkout_total_value').html(total);
            $('#checkout_total').val(total_hidden);
            $('#navbar_cart_hidden').val(total_hidden);
            $('#navbar_cart_total').html(total);
            $(`#checkout_unit_qty${id}`).html(item_qty);
            $(`#checkout_cart_qty${id}`).val(item_qty);
            $('#mobile_cart_total').html(total);
    }); 
  });

  $(document).on('click','.productlist_increase',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#productlist_qty${id}`).val();
    var total = $('#navbar_cart_hidden').val();
    var where = 'cart_increase'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        if (result == 'max') {
            alert('Quantity Unavailable');
           }
        else{
            var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            var item_qty = data[3];
            $(`#cart_subtotal${id}`).html(subtotal);
            $('#total_value').html(total);
            $('#cart_total').val(total_hidden);
            $('#navbar_cart_hidden').val(total_hidden);
            $('#navbar_cart_total').html(total);
            $(`#cart_qty${id}`).val(item_qty);
            $(`#productlist_qty${id}`).val(item_qty);
            $(`#cart_unit_qty${id}`).html(item_qty);
            $('#mobile_cart_total').html(total);
        }   
    }); 
  });

  $(document).on('click','.productlist_decrease',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#productlist_qty${id}`).val();
    var total = $('#navbar_cart_hidden').val();
    var where = 'cart_decrease'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        var data = $.parseJSON(result);
        var subtotal = data[0];
        var total = data[1];
        var total_hidden = data[2];
        var item_qty = data[3];
        $(`#cart_subtotal${id}`).html(subtotal);
        $('#total_value').html(total);
        $('#cart_total').val(total_hidden);
        $('#navbar_cart_hidden').val(total_hidden);
        $('#navbar_cart_total').html(total);
        $(`#cart_qty${id}`).val(item_qty);
        $(`#productlist_qty${id}`).val(item_qty);
        $(`#cart_unit_qty${id}`).html(item_qty);
        $('#mobile_cart_total').html(total);
    }); 
  });

  $(document).on('click','.featured_increase',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#featured_qty${id}`).val();
    var total = $('#navbar_cart_hidden').val();
    var where = 'cart_increase'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        if (result == 'max') {
            alert('Quantity Unavailable');
           }
        else{
            var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            var item_qty = data[3];
            $(`#cart_subtotal${id}`).html(subtotal);
            $('#total_value').html(total);
            $('#cart_total').val(total_hidden);
            $(`#recommended_qty${id}`).val(item_qty);
            $('#navbar_cart_hidden').val(total_hidden);
            $(`#cart_qty${id}`).val(item_qty);
            $('#navbar_cart_total').html(total);
            $(`#cart_unit_qty${id}`).html(item_qty);
            $('#mobile_cart_total').html(total);
        }   
    }); 
  });

  $(document).on('click','.featured_decrease',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#featured_qty${id}`).val();
    var total = $('#navbar_cart_hidden').val();
    var where = 'cart_decrease'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        var data = $.parseJSON(result);
        var subtotal = data[0];
        var total = data[1];
        var total_hidden = data[2];
        var item_qty = data[3];
        $(`#cart_subtotal${id}`).html(subtotal);
        $('#total_value').html(total);
        $('#cart_total').val(total_hidden);
        $(`#recommended_qty${id}`).val(item_qty);
        $('#navbar_cart_hidden').val(total_hidden);
        $('#navbar_cart_total').html(total);
        $(`#cart_qty${id}`).val(item_qty);
        $(`#cart_unit_qty${id}`).html(item_qty);
        $('#mobile_cart_total').html(total);
    }); 
  });

  $(document).on('click','.recommended_increase',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#recommended_qty${id}`).val();
    var total = $('#navbar_cart_hidden').val();
    var where = 'cart_increase'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        if (result == 'max') {
            alert('Quantity Unavailable');
           }
        else{
            var data = $.parseJSON(result);
            var subtotal = data[0];
            var total = data[1];
            var total_hidden = data[2];
            var item_qty = data[3];
            $(`#cart_subtotal${id}`).html(subtotal);
            $('#total_value').html(total);
            $('#cart_total').val(total_hidden);
            $(`#featured_qty${id}`).val(item_qty);
            $('#navbar_cart_hidden').val(total_hidden);
            $('#navbar_cart_total').html(total);
            $(`#cart_qty${id}`).val(item_qty);
            $(`#cart_unit_qty${id}`).html(item_qty);
            $('#mobile_cart_total').html(total);
        }   
    }); 
  });

  $(document).on('click','.recommended_decrease',function(){
    var el = $(this);
    var id = el.attr("id");
    var qty = $(`#recommended_qty${id}`).val();
    var total = $('#navbar_cart_hidden').val();
    var where = 'cart_decrease'
    $.post("cart.php",{id:id,total:total,qty:qty,where:where},
    function(result){
        var data = $.parseJSON(result);
        var subtotal = data[0];
        var total = data[1];
        var total_hidden = data[2];
        var item_qty = data[3];
        $(`#cart_subtotal${id}`).html(subtotal);
        $('#total_value').html(total);
        $('#cart_total').val(total_hidden);
        $(`#featured_qty${id}`).val(item_qty);
        $('#navbar_cart_hidden').val(total_hidden);
        $('#navbar_cart_total').html(total);
        $(`#cart_qty${id}`).val(item_qty);
        $(`#cart_unit_qty${id}`).html(item_qty);
        $('#mobile_cart_total').html(total);
    }); 
  });


    $('.addAvailabilityDetails').click(function(){
    var home_id = $(this).attr("id");
    var start_date = $(`#start_date${home_id}`).val();
    var end_date = $(`#end_date${home_id}`).val();
    var extra_details = $(`#extra-details${home_id}`).val();
    if(extra_details == null)
    {
        extra_details = 'No extra details';
    }   
    var where = 'availability'
    $.post("add.php",{start_date:start_date,end_date:end_date,extra_details:extra_details,home_id:home_id,where:where},
    function(result){
        if (result == 'success') {
            alert('Home availability successfully added.');
           }
            else{
            alert("Something went wrong. Please try again later.");
           }
           location.reload(true);
    });        
});

  $(document).on('click','#user_contact',function(){
    var email = $('#hidden_email').val();
    var subject = $('#subject').val();
    var message = $('#message').val();
    var token = $('.contact_page_token').val();
    var where = 'site_contact'
    $.post("add.php",{email:email,token:token,subject:subject,message:message,where:where},
    function(result){
        if (result == 'success') {
            alert('Your message was successfully sent! We shall get back to you in the shortest instance possible.');
            location.reload(true);
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later.");
           }
            else{
            alert("Something went wrong. Please try again later.");
           }
    });        
});

$(document).on('click','#anonymous_contact',function(){
    var name = $('#full_name').val();
    var email = $('#email_address').val();
    var number = $('#mobile_number').val();
    var subject = $('#subject').val();
    var message = $('#message').val();
    var token = $('.contact_page_token').val();
    var where = 'site_contact';
    $.post("add.php",{name:name,email:email,token:token,number:number,subject:subject,message:message,where:where},
    function(result){
        if (result == 'success') {
            alert('Your message was successfully sent! We shall get back to you in the shortest instance possible.');
            location.reload(true);
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later."); 
          }
            else{
            alert("Something went wrong. Please try again later.");
           }
    });        
});

$(document).on('click','#user_comment',function(){
    var email = $('#hidden_email').val();
    var id = $('#blog_id').val();
    var comment = $('#comment').val();
    var token = $('.comment_token').val();
    var where = 'site_comment';
    $.post("add.php",{id:id,email:email,token:token,comment:comment,where:where},
    function(result){ 
        if (result == 'success') {
            alert('Your comment was successfully posted! ');
            location.reload(true);
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later.");
            location.reload(true);
           }
            else{
            alert("Something went wrong. Please try again later.");
            location.reload(true);
           }
    });        
});

$(document).on('click','#anonymous_comment',function(){
    var name = $('#name').val();
    var email = $('#email').val();
    var id = $('#blog_id').val();
    var comment = $('#comment').val();
    var token = $('.comment_token').val();
    var where = 'site_comment';
    $.post("add.php",{id:id,name:name,email:email,token:token,comment:comment,where:where},
    function(result){
        if (result == 'success') {
            alert('Your comment was successfully posted! ');
            location.reload(true);
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later."); 
            location.reload(true);
          }
            else{
            alert("Something went wrong. Please try again later.");
            location.reload(true);
           }
    });        
});

$(document).on('click','.reply-btn',function(){
    var el = $(this);
    var id = el.attr("id");
    var email = $('#hidden_email').val();
    var extraForm = "";
    extraForm += "<form action='#' class='respons-contact-form'>";
    extraForm += '<div class="form-item col-lg-7 p-0">';
    extraForm += '<input type="text" name="subcomment_name" id="subcomment_name" placeholder="Full Name" required>';
    extraForm += '<i class="fas fa-user"></i>';
    extraForm += '</div>';
    extraForm += '<div class="form-item col-lg-7 p-0">';
    extraForm += '<input type="text" name="subcomment_email" id="subcomment_email" placeholder="Email Address" required>';
    extraForm += '<i class="fas fa-envelope"></i>';
    extraForm += '</div>';
    extraForm += '<div class="form-item col-lg-12 p-0">';
    extraForm += '<textarea name="subcomment" id="subcomment" placeholder="Type your reply" required></textarea>';
    extraForm += '<i class="fab fa-telegram-plane"></i>';
    extraForm += '</div>';
    extraForm += '<div>';
    extraForm += '<input type="hidden" class="subcomment_token" id="token" name="token">';
    extraForm += `<input type="hidden" class="comment_id" id="comment_id" name="comment_id" value="`+id+`">`;
    extraForm += '<button type="submit" class="submit anonymous_subcomment" id="'+id+'" >Reply to Comment</button>';
    extraForm += '</div>';
    extraForm += "</form>";
    extraForm += "<br>";
    
    var form = "";
    form += "<form action='#' class='respons-contact-form'>";
    form += "<input type='hidden' class='subcomment_token' id='token' name='token'>";
    form += "<input type='hidden' class='comment_id' id='comment_id' name='comment_id' value='"+id+"'>";
    form += "<input type='hidden' name='subcomment_hidden_email' id='subcomment_hidden_email' value='"+email+"'>";
    form += "<div class='form-item col-lg-12 p-0'>";
    form += "<textarea name='subcomment' id='subcomment' placeholder='Type your reply' required></textarea>";
    form += "<i class='fab fa-telegram-plane'></i>";
    form += "</div>";
    form += "<button type='submit' class='submit user_subcomment' id='"+id+"'>Reply to Comment</button>";
    form += "</form>";
    form += "<br>";
    $(`.subcomment-response-user${id}`).html(form); 
    $(`.subcomment-response-anonymous${id}`).html(extraForm); 
});

$(document).on('click','#add_comment',function(){
    var form = "";
    form += "<br>";
    form += "<form action='#' class='respons-contact-form'>";
    form += "<div class='form-item col-lg-12 p-0'>";
    form += "<textarea name='comment' id='comment' style='color:gray' placeholder='Type your comment' required></textarea>";
    form += "<i class='fab fa-telegram-plane fa-2x'></i>";
    form += "<br>";
    form += "<a href='#' class='btn btn-danger' role='button' aria-pressed='true' style='margin-right: 50px;float: right; border-radius: 25px' id='post_comment_btn'>Post Comment</a>";
    form += "<br>";
    form += "<br>";
    $('.comment-input').html(form); 
});

$(document).on('click','#post_comment_btn',function(){
    var comment = $('#comment').val();
    var home = $('#home_id').val();
    var token = $('#token').val();
    var commenter = $('#commenter_id').val();
    var where = 'site_comment';
    $.post("add.php",{commenter:commenter,home:home,token:token,comment:comment,where:where},
    function(result){
        if (result == 'success') {
            alert('Your comment was successfully posted!');
            $( "#comments-section" ).load(window.location.href + " #comments-section" );
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later.");
           }
            else{
            alert("Something went wrong. Please try again later.");
           }
    });  
});

$(document).on('click','.user_subcomment',function(){
    var email = $('#subcomment_hidden_email').val();
    var id = $('#comment_id').val();
    var subcomment = $('#subcomment').val();
    var token = $('.subcomment_token').val();
    var where = 'site_subcomment';
    $.post("add.php",{id:id,email:email,token:token,subcomment:subcomment,where:where},
    function(result){
        if (result == 'success') {
            alert('Your reply was successfully posted! ');
            location.reload(true);
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later.");
            location.reload(true);
           }
            else{
            alert("Something went wrong. Please try again later.");
            location.reload(true);
           }
    });        
});

$(document).on('click','.anonymous_subcomment',function(){
    var name = $('#subcomment_name').val();
    var email = $('#subcomment_email').val();
    var id = $('#comment_id').val();
    var subcomment = $('#subcomment').val();
    var token = $('.subcomment_token').val();
    var where = 'site_subcomment';
    $.post("add.php",{id:id,name:name,email:email,token:token,subcomment:subcomment,where:where},
    function(result){
        if (result == 'success') {
            alert('Your reply was successfully posted! ');
            location.reload(true);
           }
           else if(result == 'error'){
            alert("Something went wrong. Please try again later."); 
            location.reload(true);
          }
            else{
            alert("Something went wrong. Please try again later.");
            location.reload(true);
           }
    });        
});

function increase_decrease_btn(action, html_id)
{
    var qty = parseInt($(html_id).text());
    if(action == "decrease")
    {
        qty--;
        if(qty < 0)
     {
         qty = 0;
     }
     $(html_id).html(qty);
    }
    else if(action == "increase")
    {
        qty++;
        $(html_id).html(qty);
    }
}
function increase_decrease_btn_kids(action, html_id)
{
    $('.kids_coming').each(function() {
        if($(this).prop('checked')) 
        {
            increase_decrease_btn(action, html_id);
        }
        else
        {
            $(html_id).html(0);
        }
    });
}

/*
$(document).on('click','.home-like',function(){
    if($('input[name="home_type"]:checked').val() == null && )
    {

    }
    alert($('input[name="home_type"]:checked').val());

});
*/
function encodeHomeFeatures(value)
{
   var result;
   if(value == null)
   {
       result = 0;
   }
   else
   {
       result = 1;
   }
   return result;
}

$(document).on('submit','#form',function(e){
 e.preventDefault();
 e.stopPropagation();
 $(".preloader").show();
 var home_features = [
    encodeHomeFeatures($('input[name="swimming"]:checked').val()),
    $('input[name="home_type"]:checked').val(),
    $('input[name="residence_type"]:checked').val(),
    encodeHomeFeatures($('input[name="wifi"]:checked').val()),
    encodeHomeFeatures($('input[name="tv"]:checked').val()),
    encodeHomeFeatures($('input[name="ac"]:checked').val()),
     $('#bedrooms').text(),
     $('#bathrooms').text(),
     $('#occupancy').text(),
     encodeHomeFeatures($('input[name="gym"]:checked').val()),
     encodeHomeFeatures($('input[name="parking"]:checked').val()),
     encodeHomeFeatures($('input[name="wheelchair"]:checked').val()),
     encodeHomeFeatures($('input[name="pets"]:checked').val()),
     encodeHomeFeatures($('input[name="kids"]:checked').val()),
    encodeHomeFeatures($('input[name="workers"]:checked').val()),
    encodeHomeFeatures($('input[name="security"]:checked').val()),
    encodeHomeFeatures($('input[name="garden"]:checked').val()),
    encodeHomeFeatures($('input[name="smokers"]:checked').val())
   ];
   var features_array = JSON.stringify(home_features);
   var form_data = new FormData(this);
   form_data.append('subcounty',$('#subcounty_search').val());
   form_data.append('area',$('#area').val());
   form_data.append('home_features',features_array);
   $.ajax({
    url: 'tiermatch/add_home.php',
    type: 'post',
    data: form_data,
    contentType : false,
    processData : false,
    cache : false,
      success : function(data){  
        $(".preloader").hide();
          alert('Home added successfully'); 
        window.location.href = 'home-dashboard.php?id='+data;
      }
      });
});

$('#home-dashboard-image').on('change',function(){
    var form_data = new FormData(document.getElementById('images-form'));
    $.ajax({
        url: 'add.php',
        type: 'post',
        data: form_data,
        contentType : false,
        processData : false,
        cache : false,
        success : function(result){
            $( "#home-image-section" ).load(window.location.href + " #home-image-section" );
         }
        });
});

$(document).on('click','#cancel-availability',function(e){
    bootbox.confirm('Do you really want to cancel this homes availability?',function(result)
    {if(result){
    e.preventDefault();
    e.stopPropagation();
    var where = 'home_avaliability';
    var availability_id = $('#availability_id').val();
    $.post("delete.php",{id:availability_id, where:where},
    function(result){
        if (result == '1') {
            alert("The home's availbility has been cancelled");
            location.reload(true);
           }
             else{
            alert("Something went wrong. Try again.");
           }
    });
}});  
});

$(document).on('click','#delete-home',function(){
    bootbox.confirm('Do you really want to delete the selected home?',function(result)
    {if(result){
    var where = 'delete_home';
    var id = $('#home_id').val();
    $.post("delete.php",{id:id, where:where},
    function(result){
        if (result == '1') {
            alert("Home successfully deleted");
            window.location.href = 'my-homes.php';
           }
             else{
            alert("Something went wrong. Try again.");
           }
    });
  }});  
});

$(document).on('click','#edit_home',function(e){
    e.preventDefault();
    e.stopPropagation();
    var where = 'edit_home';
    var name = $('#home_name').val();
    var description = $('#home_description').val();
    var id = $('#home_id').val();
    $.post("save.php",{id:id, name:name, description:description, where:where},
    function(result){
        if (result == 'success') {
            alert("The home's details have been changed");
            location.reload(true);
           }
             else{
            alert("Something went wrong. Try again.");
           }
    });
});

    $('.remove-images-btn').click(function(e){
    e.preventDefault();
    e.stopPropagation();
    var where = 'remove_image';
    var id = $(this).attr('id');
    $.post("delete.php",{id:id, where:where},
    function(result){
        $( "#home-image-section" ).load(window.location.href + " #home-image-section" );
    });
});

$('#rate_home').click(function(e){
    e.preventDefault();
    e.stopPropagation();
    var where = 'rate-home';
    var home_id = $('#home_id').val();
    var rater_id = $('#rater_id').val();
    var val = $("input[type='radio'][name='rate-home']:checked").val();
    $.post("add.php",{home_id:home_id, rater_id:rater_id, val:val, where:where},
    function(result){
        if(result == 1)
        {
            alert('Home rating added successfully');
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
        location.reload(true);
    });
});

$('#rate_home_owner').click(function(e){
    e.preventDefault();
    e.stopPropagation();
    var where = 'rate-home-owner';
    var owner_id = $('#home_owner_id').val();
    var rater_id = $('#rater_id').val();
    var val = $("input[type='radio'][name='rate-home-owner']:checked").val();
    $.post("add.php",{owner_id:owner_id, rater_id:rater_id, val:val, where:where},
    function(result){
        if(result == 1)
        {
            alert('Home owner rating added successfully');
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
        location.reload(true);
    });
});

$(document).on('click','#edit_availability',function(e){
    e.preventDefault();
    e.stopPropagation();
    var where = 'edit_availability';
    var id = $('#availability_id').val();
    var start = $('#start_date').val();
    var end = $('#end_date').val();
    var extra_details ='';
    if($('#extra_details').val() == null)
    {
       extra_details = 'No extra details';
    }
    else
    {
       extra_details = $('#extra_details').val();
    }    
    $.post("save.php",{id:id, start:start, end:end, extra_details:extra_details, where:where},
    function(result){
        if (result == 'success') {
            alert("The home's availability details have been changed");
            location.reload(true);
           }
             else{
            alert("Something went wrong. Try again.");
           }
    });
});

function tier_analysis()
{
    var xml = new XMLHttpRequest();
    xml.open("POST", "{{url_for(func.func)}}",true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.onload = function()
    {
        var dataReply = JSON.parse(this.responseText)
        alert(dataReply)
    }
    var dataSend = {}
    xml.send(dataSend)
}

function formAjax(module){
    var form_data = new FormData($('form')[0]);
    var form_data = new FormData();
    form_data.append('where', 'home');
    $.ajax({
      url: '../add.php',
      type: 'post',
      data: form_data,
      contentType : false,
      processData : false,
      cache : false,
        success : function(data){
         if (data == 'success') {
          alert(module+' Added Successfully');
          location.reload(true);
         }
          else if (data == 'exists') {
          alert(module+' Already Exists');
         }
           else{
          alert("Something went wrong");
         }
         }
        });
 }


 function displayname(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            _this.siblings('label').html(input.files[0]['name'])
            
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function filter_data()
    {
        var organization = $('.organization_name').val();
        var loader = '<div class="loader__figure"></div';
        loader += '<p class="loader__label">'+organization+'</p>';
        $('.loader').html(loader);
        var range = $('.js-range-slider').val();
        var arr = range.split(";");
        var minimum_rating = arr.splice(0,1).join("");
        var maximum_rating = arr.join(";");
        var county = get_filter('county_selector');
        var features = JSON.stringify(get_filter('feature_selector'));
        var where = 'filter';
        $.post("load.php",{minimum_rating:minimum_rating,maximum_rating:maximum_rating,features:features,county:county,where:where},
    function(data){
        $('.product-list').html(data);
    });
    }

function get_filter(class_name)
{
    var filter = [];
    $('.'+class_name+':checked').each(function(){
         filter.push($(this).val());
    });
    return filter;
} 

$(document).on('change','.js-range-slider',function(){
    filter_data();
});

$(document).on('click','.county_selector',function(){
    filter_data();
});

$(document).on('click','.feature_selector',function(){
    filter_data();
});

$(document).on('click','.editProfile',function(){
    var firstname = $('#firstname').val();
    var othername = $('#othername').val();
    var lastname = $('#lastname').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    var Location = $('#location').val();
    var old_email = $('#old_email').val();
    var token= $('#token').val();
    var where = $('#where').val();
    $.post("save.php",{firstname:firstname,othername:othername,lastname:lastname,email:email,mobile:mobile,location:Location,old_email:old_email,token:token,where:where},
    function(result){
        if (result == 'success') {
            alert('Your details have been edited successfully');
            location.reload(true);
           }
            else if (result == 'exists') {
            alert('Email address or mobile number entered exists');
           }
             else{
            alert("Something went wrong");
           }
    });
});

function paginate(page)
{
    var where = 'pagination';
    $.ajax({
        url:"load.php",
        method:"POST",
        data:{page:page,where:where},
        success:function(data){
            $('.pagination_data').html(data);
        }
    });
}

$(document).on('click','.pagination_link',function(){
    remove-images-btn
  paginate(page);
});

$('#location_Search').keyup(function(){
    var txt = $('#location_Search').val();
    var selector = document.getElementById('Cat_select');
    //var category = selector[selector.selectedIndex].value;
    if(txt != '')
    {
      $.ajax({
        url: 'search.php',
        type:"post",
        data:{search:txt},
        dataType:"text",
        success:function(data)
        {
          $('#show_list').html(data);
        }
      });
    }
    else
    {
      $('#show_list').html('');
    }
    $(document).on('click','a',function(){
        $("#location_Search").val($(this).text());
        $("#show_list").html(''); 
    });
 });

 $('#Location_Search').keyup(function(){
    var txt = $('#Location_Search').val();
    var selector = document.getElementById('Cat_Select');
    //var category = selector[selector.selectedIndex].value;
    if(txt != '')
    {
      $.ajax({
        url: 'search.php',
        type:"post",
        data:{search:txt},
        dataType:"text",
        success:function(data)
        {
          $('#Show_List').html(data);
        }
      });
    }
    else
    {
      $('#Show_List').html('');
    }
    $(document).on('click','a',function(){
        $("#Location_Search").val($(this).text());
        $("#Show_List").html(''); 
    });
 });

 $(document).on('click','#search-Location-Submit',function(e){
    e.preventDefault();
    e.stopPropagation();
    var location = $("#Location_Search").val();
    window.location.href = 'homes-list.php?location='+location;
});

$(document).on('click','#searchLocationSubmit',function(e){
    e.preventDefault();
    e.stopPropagation();
    var location = $("#location_Search").val();
    window.location.href = 'homes-list.php?location='+location;
});

 $('#county_search').keyup(function(){
    var subcounty = document.getElementById('subcounty_search');
    var text = $("#county_search").val();
    var where = 'county';
    if(text != "")
    {
        subcounty.disabled = false;
        $.ajax({
            url: 'search.php',
            type:"post",
            data:{text:text,where:where},
            dataType:"text",
            success:function(data)
            {
              $('#county_list').html(data);
            }
          });
    }
    else
    {
        subcounty.disabled = true;
        $('#county_list').html('');
    }
    $(document).on('click','#county',function(){
        $("#county_search").val($(this).text());
        $("#county_list").html(''); 
    });
 });

 $('#subcounty_search').keyup(function(){
    var subcounty = $('#subcounty_search').val();
    var county = $('#county_search').val();
    var where = 'subcounty';
    if(subcounty != '')
    {
      $.ajax({
        url: 'search.php',
        type:"post",
        data:{subcounty:subcounty, county:county, where:where},
        dataType:"text",
        success:function(data)
        {
          $('#subcounty_list').html(data);
        }
      });
    }
    else
    {
      $('#subcounty_list').html('');
    }
    $(document).on('click','#subcounty',function(){
        $("#subcounty_search").val($(this).text());
        $("#subcounty_list").html(''); 
    });
 });

 $('.view').on('click',function(){
    // $(this).text("Show Less"); 
    $(this).parents('.order-card').addClass("show")
});
$('.show-less').on('click',function(){
    // $(this).text("Show Less"); 
    $(this).parents('.order-card').removeClass("show")
});

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

 $(document).on('click','#requirements-submit',function(e){
    e.preventDefault();
    e.stopPropagation();
    $(".preloader").show();
    var extra_details = '';
    if($("#extra-requirements").val() == null)
    {
        extra_details = 'No extra details';
    }
    else
    {
        extra_details = $("#extra-requirements").val();
    }
     var features_cookie = JSON.stringify({
     swimming : encodeHomeFeatures($('input[name="swimming"]:checked').val()),
     wifi : encodeHomeFeatures($('input[name="wifi"]:checked').val()),
     tv : encodeHomeFeatures($('input[name="tv"]:checked').val()),
     ac : encodeHomeFeatures($('input[name="ac"]:checked').val()),
     gym : encodeHomeFeatures($('input[name="gym"]:checked').val()),
     parking : encodeHomeFeatures($('input[name="parking"]:checked').val()),
     wheelchair : encodeHomeFeatures($('input[name="wheelchair"]:checked').val()),
     pets : encodeHomeFeatures($('input[name="pets"]:checked').val()),
     kids : encodeHomeFeatures($('input[name="kids_coming"]:checked').val()),
     workers : encodeHomeFeatures($('input[name="workers"]:checked').val()),
     security : encodeHomeFeatures($('input[name="security"]:checked').val()),
     garden : encodeHomeFeatures($('input[name="garden"]:checked').val()),
     smokers : encodeHomeFeatures($('input[name="smokers"]:checked').val()),
     county : $('#county_search').val(),
     subcounty : $('#subcounty_search').val(),
     exchange_home : $("#exchange_home_id").val(),
     people_accompanying : $('#people_no').text(),
     kids_accompanying : $('#kids_no').text(),
     start_date : $("#start_date").val(),
     end_date : $("#end_date").val(),
     extra_requirements : extra_details
    });
    setCookie('requirements',features_cookie,$("#holiday_requirements_expiry").val());
    $(".preloader").hide();
    window.location.href = 'homes-list.php?requirements-search=true';
});

function ExchangePoints(source, unit_of_exchange, target)
{
    var diff = source - target;
    var transfered_points = unit_of_exchange * diff;
    return transfered_points;
}

function makeHomeRequest(details)
{
    var where = 'request'
    data = JSON.parse(details);
    $.post("add.php",{user_id:data.user_id, availability_id:data.availability_id, exchange_home:data.exchange_home, people_accompanying:data.people_accompanying, start_date:data.start_date, end_date:data.end_date, extra_requirements:data.extra_requirements, where:where},
    function(result){
        if(result == 1)
        {
            alert('Request successful');
            window.location.href = 'reservation-success.php';
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
    });
}

$(document).on('click','#make-request',function(e){
    e.preventDefault();
    e.stopPropagation();
    var details = JSON.parse(getCookie('requirements'));
    details.user_id = $('#user-id').val();
    details.availability_id = $('#availability_id').val();
    details = JSON.stringify(details);
    var required_points = ExchangePoints($('#requester-home-tier').val(), $('#unit-of-exchange').val(), parseInt($('#home-tier-val').text()));
    if(required_points < 0)
    { 
        required_points *= -1;
        bootbox.confirm(required_points+' points will be transfered to your account on acceptance of the other party. Would you like to proceed with the request?',function(result)
        {if(result){
            makeHomeRequest(details);
        }}); 
    }
    else{
        bootbox.confirm(required_points+' will be deducted from your account on acceptance of the other party. Would you like to proceed with the request?',function(result)
        {if(result){
            makeHomeRequest(details);
        }}); 
    }
});

$(document).on('click','#submit-holiday-details',function(e){
    e.preventDefault();
    e.stopPropagation();
    var details = JSON.stringify({
    exchange_home : $("#exchange_home_id").val(),
    people_accompanying : $('#people_no').text(),
    start_date : $("#start_date").val(),
    end_date : $("#end_date").val(),
    extra_requirements : $("#extra-requirements").val(),
    user_id : $('#user-id').val(),
    availability_id : $('#availabilityId').val()
    });
    setCookie('requirements',details,$("#holiday_requirements_expiry").val());
    $.post("load.php",{exchange_home_id:$("#exchange_home_id").val(), target_home_id:$("#home-id").val(), where:'getTier'},
    function(result){
        var tier_data = $.parseJSON(result);
        var required_points = ExchangePoints(tier_data[0], $('#unit-of-exchange').val(), tier_data[1]);
        if(required_points < 0)
        { 
            required_points *= -1;
            bootbox.confirm(required_points+' points will be transfered to your account on acceptance of the other party. Would you like to proceed with the request?',function(result)
            {if(result){
                makeHomeRequest(details);
            }}); 
        }
        else{
            bootbox.confirm(required_points+' will be deducted from your account on acceptance of the other party. Would you like to proceed with the request?',function(result)
            {if(result){
                makeHomeRequest(details);
            }}); 
        }
    });
});

$(document).on('click','.accept-request',function(e){
    e.preventDefault();
    e.stopPropagation();
    var id = $(this).attr("id");
    var where = 'request'
    var action = 'accept';
    var availability = $("#availability-id").val();
    var source_tier = $("#requester-tier").val();
    var target_tier = $("#my-tier").val();
    var requester_id = $("#requester-id").val();
    var my_id = $("#my-id").val();
    bootbox.confirm('Are you sure you want to accept the selected request?',function(result)
    {if(result){
    $.post("save.php",{id: id, requester_id:requester_id, my_id:my_id, source: source_tier, target: target_tier,availability:availability, action:action, where:where},
    function(result){
        if(result == 1)
        {
            alert('Request successfully accepted');
            $( ".cart-product-container" ).load(window.location.href + " .cart-product-container" );
            $( "#notifications_number" ).load(window.location.href + " #notifications_number" );
            $( "#notifications_icon" ).load(window.location.href + " #notifications_icon" );
            $( "#exchange-points-value" ).load(window.location.href + " #exchange-points-value" );
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
    });
   }}); 
});

$(document).on('click','.decline-request',function(e){
    e.preventDefault();
    e.stopPropagation();
    var id = $(this).attr("id");
    var where = 'request'
    var action = 'decline';
    bootbox.confirm('Are you sure you want to decline the selected request?',function(result)
    {if(result){
    $.post("save.php",{id: id,action:action, where:where},
    function(result){
        if(result == 1)
        {
            alert('Request successfully declined');
            $( ".cart-product-container" ).load(window.location.href + " .cart-product-container" );
            $( "#notifications_number" ).load(window.location.href + " #notifications_number" );
            $( "#notifications_icon" ).load(window.location.href + " #notifications_icon" );
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
    });
}}); 
});

$(document).on('click','.clear-request',function(e){
    e.preventDefault();
    e.stopPropagation();
    var id = $(this).attr("id");
    var where = 'clear-request'
    var action = 'clear';
    $.post("save.php",{id: id,action:action, where:where},
    function(result){
        if(result == 1)
        {
            $( ".cart-product-container" ).load(window.location.href + " .cart-product-container" );
            $( "#notifications_number" ).load(window.location.href + " #notifications_number" );
            $( "#notifications_icon" ).load(window.location.href + " #notifications_icon" );
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
    });
});

$(document).on('click','.clear-all',function(e){
    e.preventDefault();
    e.stopPropagation();
    var requester_id = $("#requester-id").val();
    var where = 'clear-request'
    var action = 'clear-all';
    $.post("save.php",{requester_id: requester_id,action:action, where:where},
    function(result){
        if(result == 1)
        {
            $( ".cart-product-container" ).load(window.location.href + " .cart-product-container" );
            $( "#notifications_number" ).load(window.location.href + " #notifications_number" );
            $( "#notifications_icon" ).load(window.location.href + " #notifications_icon" );
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
    });
});

$(document).on('click','.cancel-request',function(e){
    e.preventDefault();
    e.stopPropagation();
    var id = $(this).attr("id");
    bootbox.confirm('Are you sure you want to cancel the selected request?',function(result)
    {if(result){
    var where = 'delete_request';
    $.post("delete.php",{id:id, where:where},
    function(result){
        if(result == 1)
        {
            alert('Request successfully cancelled')
            $( "#my-exchanges-section" ).load(window.location.href + " #my-exchanges-section" );
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
    });
}}); 
});

$(document).on('click','.decline-all',function(e){
    e.preventDefault();
    e.stopPropagation();
    var where = 'request'
    var action = 'decline_all';
    var my_id = $("#my-id").val();
    bootbox.confirm('Are you sure you want to decline all requests?',function(result)
    {if(result){
    $.post("save.php",{action:action,my_id:my_id, where:where},
    function(result){
        if(result == 1)
        {
            alert('Requests successfully declined');
            $( ".cart-product-container" ).load(window.location.href + " .cart-product-container" );
            $( "#notifications_number" ).load(window.location.href + " #notifications_number" );
            $( "#notifications_icon" ).load(window.location.href + " #notifications_icon" );
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
    });
}}); 
});

$(document).on('click','#sendFeedback',function(e){
    e.preventDefault();
    e.stopPropagation();
    var where = 'feedback'
    var user = $("#customer_id").val();
    var message = $("#feedback-message").val();
    $.post("add.php",{user:user, message:message, where:where},
    function(result){
        if(result == 1)
        {
            alert('Feedback successfully sent. Thank you!');
            window.location.href = 'homes-list.php';
        }
        else
        {
            alert('Something went wrong. Try again.')
        }
    });
});