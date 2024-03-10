(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Fixed Navbar
    $(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow');
            } else {
                $('.fixed-top').removeClass('shadow');
            }
        } else {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow').css('top', -55);
            } else {
                $('.fixed-top').removeClass('shadow').css('top', 0);
            }
        } 
    });
    
    
   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


   


    // Modal Video
    


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

})(jQuery);



$(document).ready(function() {
    $("#getPrice").change(function() {
       

        var size = $(this).val();
        var product_id = $(this).attr("product-id");
        if (size === "") {
       return; // Exit the function early
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/get-product-price',
            data: { size: size, product_id: product_id },
            type: 'post',
            success: function(resp) {
                if (resp.discount > 0) {
                    $(".getAttributePrice").html("<h5 class='text-dark fs-5 fw-bold mb-0 product-discount-price'>RM" + resp.final_price + "</h5>  <span>Original Price:</span><span class='text-dark product-price'>RM" + resp.product_price + "</span>");
                } else {
                    $(".getAttributePrice").html("<h5 class='text-dark fs-5 fw-bold mb-0 product-discount-price'>RM" + resp.final_price + "</h5>");
                }
            },
            error: function(resp) {
                alert("Error");
            }
        });
    });
});
function get_filter(class_name){
    var filter=[];
    $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
    });
    return filter;
}

// jQuery code to close the alert box when the close button is clicked
$(document).ready(function(){
    $(".close").click(function(){
        $(".alert").alert('close');
    });
});

function change_image(element) {
        var imageSrc = element.src;
        document.getElementById('main-image').src = imageSrc;
    }

