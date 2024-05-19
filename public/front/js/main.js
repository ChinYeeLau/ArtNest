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
            $(".totalCartItems").html(resp.totalCartItems);
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
                    $(".totalCartItems").html(resp.totalCartItems);
                    $("#appendCartItems").html(resp.view);

                },error:function(){
                    alert("Error");
                }
               })  
        }
     
    });

    $("#registerForm").submit(function(e){
        e.preventDefault(); // Prevent the default form submission
    
        var formdata = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/user/register",
            type: "POST",
            data: formdata,
            success: function(resp) {
                if (resp.type == "error") {
                    $.each(resp.errors, function(i, error) {
                        $("#register-" + i).attr('style', 'color:red');
                        $("#register-" + i).html(error);
                        setTimeout(function() {
                            $("#register-" + i).css({
                                'display': 'none'
                            });
                        }, 3000);
                    });
                } else if (resp.type == "success") {
                    $("#register-success").attr('style', 'color:green');
                    $("#register-success").html(resp.message).fadeIn();
                    setTimeout(function(){
                        location.reload();
                    }, 5000); // Refresh after 5 seconds
                }
            },
            error: function() {
                alert("Error occurred while processing your request.");
            }
        });
    });
    //accountform
    $("#accountForm").submit(function(e){
        e.preventDefault(); // Prevent the default form submission
    
        var formdata = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/user/account",
            type: "POST",
            data: formdata,
            success: function(resp) {
                if (resp.type == "error") {
                    $.each(resp.errors, function(i, error) {
                        $("#account-" + i).attr('style', 'color:red');
                        $("#account-" + i).html(error);
                        setTimeout(function() {
                            $("#account-" + i).css({
                                'display': 'none'
                            });
                        }, 3000);
                    });
                } else if (resp.type == "success") {
                    $("#account-success").attr('style', 'color:green');
                    $("#account-success").html(resp.message).fadeIn();
                    setTimeout(function(){
                        location.reload();
                    }, 3000); // Refresh after 3 seconds
                }
            },
            error: function() {
                alert("Error occurred while processing your request.");
            }
        });
    });
    //passwordform
    $("#passwordForm").submit(function(e){
        e.preventDefault(); // Prevent the default form submission
    
        var formdata = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/user/update-password",
            type: "POST",
            data: formdata,
            success: function(resp) {
                if (resp.type == "error") {
                    $.each(resp.errors, function(i, error) {
                        $("#password-" + i).attr('style', 'color:red');
                        $("#password-" + i).html(error);
                        setTimeout(function() {
                            $("#password-" + i).css({
                                'display': 'none'
                            });
                        }, 3000);
                    });
                } else if (resp.type == "incorrect") {
                    $("#password-error").attr('style', 'color:red');
                    $("#password-error").html(resp.message).fadeIn();
                    setTimeout(function(){
                        location.reload();
                    }, 3000); // Refresh after 3 seconds
                
                } else if (resp.type == "success") {
                    $("#password-success").attr('style', 'color:green');
                    $("#password-success").html(resp.message).fadeIn();
                    setTimeout(function(){
                        location.reload();
                    }, 3000); // Refresh after 3 seconds
                }
            },
            error: function() {
                alert("Error occurred while processing your request.");
            }
        });
    });
     //login form validation
     $("#loginForm").submit(function(){
        var formdata=$(this).serialize();
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/user/login",
        type:"POST",
        data:formdata,
        success:function(resp){
            if(resp.type=="error"){
                $.each(resp.errors,function(i,error){
                  $("#login-"+i).attr('style','color:red');
                  $("#login-"+i).html(error);
                setTimeout(function(){
                  $("#login-"+i).css({
                      'display':'none'
                  });
                },3000);
              });
            }else if(resp.type=="incorrect"){
                //alert(resp.message);
                $("#login-error").attr('style','color:red');
                $("#login-error").html(resp.message);
            }else if(resp.type=="inactive"){
                      //alert(resp.message);
                $("#login-error").attr('style','color:red');
                $("#login-error").html(resp.message);          
            }else if(resp.type=="success"){
                window.location.href=resp.url;
            }
        },error:function(){
            alert("Error");
        }
      })
    });
});
$("#forgotForm").submit(function(e){
    e.preventDefault(); // Prevent the default form submission

    var formdata = $(this).serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/user/forgot-password",
        type: "POST",
        data: formdata,
        success: function(resp) {
            if (resp.type == "error") {
                // Handle errors if any
                $.each(resp.errors, function(i, error) {
                    $("#forgot-" + i).attr('style', 'color:red');
                    $("#forgot-" + i).html(error);
                    setTimeout(function() {
                        $("#forgot-" + i).css({
                            'display': 'none'
                        });
                    }, 3000);
                });
            } else if (resp.type == "success") {
                // Show success message
                $("#forgot-success").attr('style', 'color:green');
                $("#forgot-success").html(resp.message).fadeIn();
                // Optionally, you can redirect to a specific page after showing the success message
                // window.location.href = "/success-page";
                // Alternatively, you can refresh the current page after a delay
                setTimeout(function(){
                    location.reload();
                }, 3000); // Refresh after 3 seconds
            }
        },
        error: function() {
            alert("Error occurred while processing your request.");
        }
    });
   
});
   //apply coupon
   $("#ApplyCoupon").submit(function(){
    var user=$(this).attr("user");
   // alert(user);
   if(user==1){
    //do nothing
   }else{
    alert("please login to apply coupon");
    return false;
   }
   var code= $("#code").val();
   $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:"post",
    data:{code:code},
    url:'/apply-coupon',
    success:function(resp){  
       if(resp.message!=""){
            alert(resp.message)
            location.reload();
        }
        $(".totalCartItems").html(resp.totalCartItems);
        $("#appendCartItems").html(resp.view);
         if(resp.couponAmount>0){
            $(".couponAmount").text("RM" + (resp.couponAmount));
        }else{
            $(".couponAmount").text("RM0");
         }
         if(resp.grand_total>0){
            $(".grand_total").text("RM" + (resp.grand_total));
         }
    },
    error: function() {
        alert("Error");
    }
})
   });
   
   //edit delivery address
   $(document).on('click','.editAddress',function(){
      var addressid = $(this).data("addressid");
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      data:{addressid:addressid},
      url:'/get-delivery-address',
      type:'post',
      success:function(resp){
        $("#myCheck").prop('checked', true);
        toggleForm();  // Call toggleForm to ensure the form is shown    
        $(".newAddress").hide();
        $(".deliveryText").text("Edit Delivery Address");
        $('[name=delivery_id]').val(resp.address['id']);
        $('[name=delivery_name]').val(resp.address['name']);
        $('[name=delivery_address]').val(resp.address['address']);
        $('[name=delivery_state]').val(resp.address['state']);
        $('[name=delivery_postcode]').val(resp.address['postcode']);
        $('[name=delivery_mobile]').val(resp.address['mobile']);
      },error:function(){
        alert ("Error");
      }
      });
   });
//save delivery address
$(document).on('submit',"#addressAddEditForm",function(){
   
    var formdata=$("#addressAddEditForm").serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/save-delivery-address',
        type:'post',
        data:formdata,
        success:function(resp){
            if (resp.type == "error") {
                $.each(resp.errors, function(i, error) {
                    $("#delivery-" + i).attr('style', 'color:red');
                    $("#delivery-" + i).html(error);
                    setTimeout(function() {
                        $("#delivery-" + i).css({
                            'display': 'none'
                        });
                    }, 3000);
                });
            } else{
                $("#deliveryAddresses").html(resp.view);
           
            }
        },error:function(){
            alert("Error");
        }
    });
});

//remove delivery address
$(document).on('click','.removeAddress',function(){
 if(confirm("Are you sure to remove this?")){
    var addressid = $(this).data("addressid");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/remove-delivery-address',
        type:'post',
        data:{addressid:addressid},
        success:function(resp){
          $("#deliveryAddresses").html(resp.view);

        },error:function(){
            alert("Error");
        }

    });
}

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
//add new address checkbox
function toggleForm() {
    var checkBox = document.getElementById("myCheck");
    var formContainer = document.getElementById("formContainer");

    if (checkBox.checked) {
        formContainer.style.display = "block";
    } else {
        formContainer.style.display = "none";
    }
}

// Checkbox state management
$(document).ready(function() {
    // Retrieve the checkbox state from localStorage
    var checkboxState = localStorage.getItem("checkboxState");
    if (checkboxState === "checked") {
        $("#myCheck").prop('checked', true);
    } else {
        $("#myCheck").prop('checked', false);
    }
    toggleForm(); // Ensure the form is shown or hidden based on the checkbox state

    // Event listener for checkbox state change
    $('#myCheck').on('change', function() {
        if ($(this).is(':checked')) {
            localStorage.setItem("checkboxState", "checked");
        } else {
            localStorage.setItem("checkboxState", "unchecked");
        }
        toggleForm(); // Toggle form visibility based on checkbox state
    });
});

// Function to toggle form visibility
function toggleForm() {
    if ($('#myCheck').is(':checked')) {
        $('#formContainer').show();
    } else {
        $('#formContainer').hide();
    }
}
  