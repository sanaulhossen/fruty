

$(document).ready(function () {
    cartload();
    wishload();

    //Product count for cart
    function cartload()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/load-cart-data',
            method: "GET",
            success: function (response) {
                $('.basket-item-count').html('');
                var parsed = jQuery.parseJSON(response)
                var value = parsed; //Single Data Viewing
                $('.basket-item-count').append($('<span>'+ value['totalcart'] +'</span>'));
            }
        });
    }

    //Add to cart code shop page
    $('.add-to-cart-btn').click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var product_qty = $(this).closest('.product_data').find('.quantity').val();

        //alert(product_id);

        $.ajax({
            url: "/add-to-cart",
            method: "POST",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
                cartload();
            },
        });
    });

    //Add to cart code shop details
    $('.add-to-cart-details').click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $("input[name='product_id']").val();
        var product_qty  = $("input[name='product_quantity']").val();



        //alert(product_qty);

        $.ajax({
            url: "/add-to-cart-details",
            method: "POST",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
                cartload();
            },
        });
    });


    //CART PAGE INCREMENT AJAX
    $('.increment-btn').click(function (e) {
        e.preventDefault();
        var incre_value = $(this).parents('.quantity').find('.qty-input').val();
        var value = parseInt(incre_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<10){
            value++;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });

    //CART PAGE DECREMENT  AJAX
    $('.decrement-btn').click(function (e) {
        e.preventDefault();
        var decre_value = $(this).parents('.quantity').find('.qty-input').val();
        var value = parseInt(decre_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });

    // UPDATE CART WITH INCREMENT AND DECREMENT
    $('.changeQuantity').click(function (e) {
        e.preventDefault();

        var thisclick = $(this);
        var quantity = $(this).closest(".cartpage").find('.qty-input').val();
        var product_id = $(this).closest(".cartpage").find('.product_id').val();

        var data = {
            '_token': $('input[name=_token]').val(),
            'quantity':quantity,
            'product_id':product_id,
        };

        $.ajax({
            url: '/update-to-cart',
            type: 'POST',
            data: data,
            success: function (response) {
                // window.location.reload();
                thisclick.closest(".cartpage").find('.cart__price').text(response.gtprice);
                $('#cart__total__id').load(location.href + ' .cart_total_all');
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
            }
        });
    });

    // CART DELETE
    $('.delete_cart_data').click(function (e) {
        e.preventDefault();

        var thisdelete = $(this);
        var product_id = $(this).closest(".cartpage").find('.product_id').val();

        //alert(product_id);

        var data = {
            '_token': $('input[name=_token]').val(),
            "product_id": product_id,
        };

        // $(this).closest(".cartpage").remove();

        $.ajax({
            url: '/delete-from-cart',
            type: 'DELETE',
            data: data,
            success: function (response) {
                thisdelete.closest(".cartpage").remove();
                $('#cart__total__id').load(location.href + ' .cart__total');
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
                cartload();
            }
        });
    });

    //PRODUCT COUNT FOR WISH
    function wishload(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/load-wish-data',
            method: "GET",
            success: function (response) {
                $('.wish-item-count').html('');
                var parsed = jQuery.parseJSON(response)
                var value = parsed; //Single Data Viewing
                $('.wish-item-count').append($('<span>'+ value['totalwish'] +'</span>'));
            }
        });
    }

    //ADD TO WISH BUTTON
    $('.add-to-wish-btn').click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product__hover').find('.product_id').val();


        //alert(product_id);

        $.ajax({
            url: "/add-to-wish",
            method: "POST",
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
                wishload();
            },
        });
    });

    //ADD TO CART FROM WISH
        $('.add-to-cart-btn-from-wish').click(function (e) {
        e.preventDefault();

        //alert('add-to-cart-btn-from-wish');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var thisdeletewish = $(this);
        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var product_qty = $(this).closest('.product_data').find('.quantity').val();

        //alert(product_qty);

        $.ajax({
            url: "/add-to-cart-from-wish",
            method: "POST",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                thisdeletewish.closest(".wishTableRaw").remove();
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
                cartload();
                wishload();
            },
        });
    });

    // WISH DELETE
    $('.delete_wish_data').click(function (e) {
        e.preventDefault();

        var wishdelete = $(this);
        var product_id = $(this).closest(".wishTableRaw").find('.product_id').val();

        var data = {
            '_token': $('input[name=_token]').val(),
            "product_id": product_id,
        };

        // $(this).closest(".cartpage").remove();

        $.ajax({
            url: '/delete-from-wish',
            type: 'DELETE',
            data: data,
            success: function (response) {
                wishdelete.closest(".wishTableRaw").remove();
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
                wishload();
            }
        });
    });





















        //Newsletter section
     $("#footer__newslatter").submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var subscriber_email = $("#subscriber_email").val();
        var _token = $("input[name=_token]").val();

        //alert(subscriber_email);

        $.ajax({
            url:"/newsletter-subscriber",
            method:"POST",
            data:{
                'subscriber_email':subscriber_email,
                '_token':_token
            },
            success:function(response){
                alertify.set('notifier','position','top-right');
                alertify.success(response.status);
                $('input[type="email"]').val('');
            }
        });
    });

});
