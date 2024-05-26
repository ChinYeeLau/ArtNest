$(document).ready(function(){
    //call dataTable 
    $('#orders').DataTable();
    $('#pages').DataTable();
    $('#sections').DataTable();
    $('#categories').DataTable();
    $('#products').DataTable();
    $('#banners').DataTable();
    $('#filters').DataTable();
    $('#coupons').DataTable();
    $('#users').DataTable();
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");
    // Check Admin Password 
    $("#current_password").keyup(function(){
      
        var current_password = $("#current_password").val();

        
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/check-admin-password',
                data: { current_password: current_password },
                success: function(resp){
                  
                    if(resp == "false"){
                        $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
                    } else if (resp == "true"){
                        $("#check_password").html("<font color='green'>Current Password is Correct!</font>");
                    }
                },
                error: function(){
                    alert('Error');
                }
            });

    });
    //update Admin Status
    $(document).on("click",".updateAdminStatus",function(){
        var status = $(this).children("i").attr("status");
        var admin_id=$(this).attr("admin_id");
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-admin-status',
            data:{status:status,admin_id:admin_id},
            success:function(resp){
               // alert(resp);
              if(resp['status']==0){
                $("#admin-"+admin_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
            } else if(resp['status'] == 1){
                $("#admin-" + admin_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
            }
        },
        error: function(){
            alert("Error");
        }
    })
    });
     //update Page Status
     $(document).on("click",".updatePageStatus",function(){
        var status = $(this).children("i").attr("status");
        var page_id=$(this).attr("page_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-cms-page-status',
            data:{status:status,page_id:page_id},
            success:function(resp){
               // alert(resp);
              if(resp['status']==0){
                $("#page-"+page_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
            } else if(resp['status'] == 1){
                $("#page-" + page_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
            }
        },
        error: function(){
            alert("Error");
        }
    })
    });
     //update User Status
     $(document).on("click",".updateUserStatus",function(){
        var status = $(this).children("i").attr("status");
        var user_id=$(this).attr("user_id");
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-user-status',
            data:{status:status,user_id:user_id},
            success:function(resp){
               // alert(resp);
              if(resp['status']==0){
                $("#user-"+user_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
            } else if(resp['status'] == 1){
                $("#user-" + user_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
            }
        },
        error: function(){
            alert("Error");
        }
    })
    });
//update Banner Status
$(document).on("click",".updateBannerStatus",function(){
    var status = $(this).children("i").attr("status");
    var banner_id=$(this).attr("banner_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-banner-status',
        data:{status:status,banner_id:banner_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#banner-"+banner_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#banner-" + banner_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});
  //update Section Status
  $(document).on("click",".updateSectionStatus",function(){
    var status = $(this).children("i").attr("status");
    var section_id=$(this).attr("section_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-section-status',
        data:{status:status,section_id:section_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#section-"+section_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#section-" + section_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});
 //update Category Status
 $(document).on("click",".updateCategoryStatus",function(){
    var status = $(this).children("i").attr("status");
    var category_id=$(this).attr("category_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-category-status',
        data:{status:status,category_id:category_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#category-"+category_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#category-" + category_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});
 //update Filter Status
 $(document).on("click",".updateFilterStatus",function(){
    var status = $(this).children("i").attr("status");
    var filter_id=$(this).attr("filter_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-filter-status',
        data:{status:status,filter_id:filter_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#filter-"+filter_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#filter-" + filter_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});
//update Filter Value Status
$(document).on("click",".updateFilterValueStatus",function(){
    var status = $(this).children("i").attr("status");
    var filter_id=$(this).attr("filter_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-filter-value-status',
        data:{status:status,filter_id:filter_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#filter-"+filter_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#filter-" + filter_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});
 //update Product Status
 $(document).on("click",".updateProductStatus",function(){
    var status = $(this).children("i").attr("status");
    var product_id=$(this).attr("product_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-product-status',
        data:{status:status,product_id:product_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#product-"+product_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#product-" + product_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});
//update Coupon Status
$(document).on("click",".updateCouponStatus",function(){
    var status = $(this).children("i").attr("status");
    var coupon_id=$(this).attr("coupon_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-coupon-status',
        data:{status:status,coupon_id:coupon_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#coupon-"+coupon_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#coupon-" + coupon_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});
 //update Atribute Status
 $(document).on("click",".updateAttributeStatus",function(){
    var status = $(this).children("i").attr("status");
    var attribute_id=$(this).attr("attribute_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-attribute-status',
        data:{status:status,attribute_id:attribute_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#attribute-"+attribute_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#attribute-" + attribute_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});
 //update Image Status
 $(document).on("click",".updateImageStatus",function(){
    var status = $(this).children("i").attr("status");
    var image_id=$(this).attr("image_id");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-image-status',
        data:{status:status,image_id:image_id},
        success:function(resp){
           // alert(resp);
          if(resp['status']==0){
            $("#image-"+image_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-outline' status='Inactive'></i>");
        } else if(resp['status'] == 1){
            $("#image-" + image_id).html("<i style='font-size:25px'class='mdi mdi-bookmark-check' status='Active'></i>");
        }
    },
    error: function(){
        alert("Error");
    }
})
});


 //confirm delete(simple java)
 /*$(".confirmDelete").click(function(){
    var title=$(this).attr("title");
    if(confirm("Are you sure to delete this "+title+"?")){
        return true;
    }else{
        return false;
    }
 })*/
  //confirm delete(sweet alert)
 // $(".confirmDelete").click(function(){
    $(document).on("click",".confirmDelete",function(){
    var module=$(this).attr('module');
    var moduleid=$(this).attr('moduleid');
    
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            "Deleted!",
             "Your file has been deleted.",
            "success"
          )
          window.location="/admin/delete-"+module+"/"+moduleid;
        }
      });
 })
//products attributes add/remove
 var maxField = 10; //Input fields increment limitation
 var addButton = $('.add_button'); //Add button selector
 var wrapper = $('.field_wrapper'); //Input field wrapper
 var fieldHTML = '<div><div style="height:10px;"></div><input type="text" name="size[]" placeholder="Size" style="width:120px;" />&nbsp;<input type="text" name="sku[]" placeholder="SKU" style="width:120px;" />&nbsp;<input type="text" name="price[]" placeholder="Price" style="width:120px;" />&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width:120px;" />&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
 var x = 1; //Initial field counter is 1
 
 // Once add button is clicked
 $(addButton).click(function(){
     //Check maximum number of input fields
     if(x < maxField){ 
         x++; //Increase field counter
         $(wrapper).append(fieldHTML); //Add field html
     }else{
         alert('A maximum of '+maxField+' fields are allowed to be added. ');
     }
 });
 
 // Once remove button is clicked
 $(wrapper).on('click', '.remove_button', function(e){
     e.preventDefault();
     $(this).parent('div').remove(); //Remove field html
     x--; //Decrease field counter
 });
 //show filters on selection of category
 $("#category_id").on('change',function(){
    var category_id=$(this).val();
   /*alert(category_id);*/
   $.ajax({
    headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
    type:'post',
    url:'category-filters',
    data:{category_id:category_id},
    success:function(resp){
        $(".loadFilters").html(resp.view);
    }
   });
 });
//show coupon feild for manual /automatic
$("#ManualCoupon").click(function(){
$("#couponField").show();
});
$("#AutomaticCoupon").click(function(){
    $("#couponField").hide();
    });
});

 //Show courier name and tracking number in case of shipped order status
 $("#courier_name").hide();
 $("#tracking_number").hide();
 $("#order_status").on("change",function(){
    if(this.value=="Shipped"){
        $("#courier_name").show();
        $("#tracking_number").show();
    }else{
        $("#courier_name").hide();
        $("#tracking_number").hide();
    }
 });
 