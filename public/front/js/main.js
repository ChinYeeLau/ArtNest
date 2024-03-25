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

// Track the last scroll position
var lastScrollTop = 0;

$(window).scroll(function() {
    var st = $(this).scrollTop();

    // Check scroll direction and position
    if (st > lastScrollTop) {
        // Scroll down
        $('.fixed-top').addClass('hidden');
    } else {
        // Scroll up
        $('.fixed-top').removeClass('hidden');
    }

    // Update last scroll position
    lastScrollTop = st;
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
    
        $('.quantity button').on('click', function (event) {
            event.preventDefault(); // Prevent the default form submission behavior
            var button = $(this);
            var oldValue = button.parent().parent().find('input').val();
            if (button.hasClass('btn-plus')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue >1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            button.parent().parent().find('input').val(newVal);
        });
    })(jQuery);
/*$('.quantity button').on('click', function () {
    var button = $(this);
    var inputField = button.parent().parent().find('input');
    var oldValue = parseFloat(inputField.val());

    if (button.hasClass('btn-plus')) {
        var newVal = oldValue + 1;
    } else {
        if (oldValue > 0) {
            var newVal = oldValue - 1;
        } else {
            newVal = 0;
        }
    }

    inputField.val(newVal);
})(jQuery);*/


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
    //update cart items qty
    $(document).on('click','.updateCartItem',function(){
     if($(this).hasClass('btn-plus')){
        //get qty
        var quantity=$(this).data('qty');
        //increase qty by 1
         new_qty=parseInt(quantity)+ 1;
        // alert(new_qty);
     }
     if($(this).hasClass('btn-minus')){
        //get qty
        var quantity=$(this).data('qty');
        //check qty is atleast 1
        if(quantity<=1){
            alert("Item quantity must be 1 or greater!");
            return false;
        }
        //decrease qty by 1
         new_qty=parseInt(quantity)- 1;
         //alert(new_qty);
     }
     var cartid=$(this).data('cartid');
    $.ajax ({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{cartid:cartid,qty:new_qty},
        url:'/cart/update',
        type:'post',
        success:function(resp){
            if(resp.status==false){
                alert(resp.message);
            }
            $("#appendCartItems").html(resp.view);

        },error:function(){
            alert("Error");
        }

    })
    });
     //delete cart items qty
     $(document).on('click', '.deleteCartItem', function() {
        var cartid=$(this).data('cartid');
        var result =confirm("Are you sure to delete this Cart Item?");
        if(result){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        
                data:{cartid:cartid},
                url:'/cart/delete',
                type:'post',
                success:function(resp){
                    $("#appendCartItems").html(resp.view);
        
                },error:function(){
                    alert("Error");
                }
               })  
        }
     
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

