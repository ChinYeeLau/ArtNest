<?php 
use App\Models\ProductsFilter;

$productFilters=ProductsFilter::productFilters();

?>

<script >

$(document).ready(function(){
    //sort by filter
    $("#sort").on("change", function(){
        var sort = $("#sort").val();
        var color= get_filter('color');
        var size= get_filter('size');
        var url = $("#url").val();
        var price= get_filter('price');
        @foreach($productFilters as $filters)
        var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
        @endforeach
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: 'POST',
            data: { 
                @foreach($productFilters as $filters)
            {{$filters['filter_column']}}: {{$filters['filter_column']}},
            @endforeach
            url: url, sort: sort,size:size,color:color,price:price}, 
            success: function(data) {
                $('.filter_products').html(data);
            },
            error: function() { 
                alert("Error");
            }
        });
    });
    //size filter
    $(".size").on("change", function(){
        var price = $("#price").val();
        var color= get_filter('color');
        var size= get_filter('size');
        var sort = $("#sort").val();
        var url = $("#url").val();
        @foreach($productFilters as $filters)
        var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
        @endforeach
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: 'POST',
            data: { 
                @foreach($productFilters as $filters)
            {{$filters['filter_column']}}: {{$filters['filter_column']}},
            @endforeach
            url: url, sort: sort,size:size,color:color,price:price}, 
            success: function(data) {
                $('.filter_products').html(data);
            },
            error: function() { 
                alert("Error");
            }
        });
    });
     //color filter
     $(".color").on("change", function(){
        var price = get_filter("price");
        var color= get_filter('color');
        var size= get_filter('size');
        var sort = $("#sort").val();
        var url = $("#url").val();
        @foreach($productFilters as $filters)
        var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
        @endforeach
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: 'POST',
            data: { 
                @foreach($productFilters as $filters)
            {{$filters['filter_column']}}: {{$filters['filter_column']}},
            @endforeach
            url: url, sort: sort,size:size,color:color,price:price}, 
            success: function(data) {
                $('.filter_products').html(data);
            },
            error: function() { 
                alert("Error");
            }
        });
    });

    //price filter
    $(".price").on("change", function(){
        var price = get_filter('price');
    var color = get_filter('color');
    var size = get_filter('size');
    var sort = $("#sort").val();
    var url = $("#url").val();
    @foreach($productFilters as $filters)
        var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
    @endforeach
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        method: 'POST',
        data: { 
            @foreach($productFilters as $filters)
                {{$filters['filter_column']}}: {{$filters['filter_column']}},
            @endforeach
            url: url, sort: sort, size: size, color: color, price: price}, 
        success: function(data) {
            $('.filter_products').html(data);
        },
        error: function() { 
            alert("Error");
        }
    });
});
//dynamic filter
    @foreach($productFilters as $filter)
    $('.{{$filter['filter_column']}}').on('click', function() {
    var url = $("#url").val();
    var sort = $("#sort option:selected").val();
    var color= get_filter('color');
        var size= get_filter('size');
        var price= get_filter('price');
    @foreach($productFilters as $filters)
    var {{$filters['filter_column']}} = get_filter('{{$filters['filter_column']}}');
    @endforeach
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        method: "post",
        data: { 
            @foreach($productFilters as $filters)
            {{$filters['filter_column']}}: {{$filters['filter_column']}},
            @endforeach
            url: url, sort: sort,size:size,color:color,price:price}, 
        success: function(data) {
            $('.filter_products').html(data);
        },
        error: function() {
            alert("Error");
        }
    });
});
@endforeach
});


</script>