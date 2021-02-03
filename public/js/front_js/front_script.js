$(document).ready(function (message){
    // $("#sort").on('change',function () {
    //     this.form.submit();
    // })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#sort").on('change', function () {
        let sort = $(this).val();
        var url = $("#url").val();
        var fabric = get_filter('fabric');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
        var pattern = get_filter('pattern');
        var sleeve = get_filter('sleeve');
       $.ajax({
           url:'category'+url,
           method:'post',
           data:{occasion:occasion,fabric:fabric,fit:fit,sleeve:sleeve,pattern:pattern,sort:sort,url:url},
           success:function (data) {
                $('.filter_products').html(data);
           }
       });
    });

    $(".fabric,.occasion,.fit,.pattern,.sleeve").on('click', function () {
        var fabric = get_filter('fabric');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
        var pattern = get_filter('pattern');
        var sleeve = get_filter('sleeve');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:'category'+url,
            method:'post',
            data:{occasion:occasion,fabric:fabric,fit:fit,sleeve:sleeve,pattern:pattern,sort:sort,url:url},
            success:function (data) {
                $('.filter_products').html(data);
            }
        });
    });


    function get_filter(class_name) {
        var filter = [];
        $('.'+class_name+':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }
    $("#GetPriceBySize").change(function (message) {
       let id = $(this).attr('productId');
       let size = $(this).val();
       if (size == ''){
           alert(' Please select a size');
       }
       //alert(size +' '+ productId);
        $.ajax({
            url: '/product/price-by-size',
            data:{size:size,id:id},
            type:'post',
            success:function (resp) {
                //alert(resp)
                $(".attribute_price").html('&#8358;.'+resp['getProductPriceBySize']['price']);
                $(".stockBySize").html(resp['getProductPriceBySize']['stock']+' '+'items in stock')
                    .attr("id", 'stock').attr("stock", resp['getProductPriceBySize']['stock'])
            },
            error:function () {
                alert('Error')
            }
        });
    })

    $("#qty").on('click',function () {
        let errorMessage = $("#errorMessage").hide();
        let stock = $("#qty").val();
        let size = $("#GetPriceBySize").val();
        let id = $(this).attr('product-id');
        let addcartbutton = $("#add-cart-button").removeAttr('disabled');
        //console.log(addcartbutton)
       // alert($(this).attr('productId') );
        $("#GetPriceBySize").change(function(){
            if ($(this).attr('productId') != ''){
                errorMessage.hide();
                addcartbutton.removeAttr('disabled');
            }
        });

        $.ajax({
            url:'/product/qty-check',
            type:'post',
            data:{stock:stock,id:id,size:size},
            success:function (resp) {
                if (resp !== ''){
                    errorMessage.html(resp['getProductSize']).css({"color":"red","padding-top":"3px"}).show();
                    errorMessage.html(resp['getProductQty']).css({"color":"red","padding-top":"3px"}).show();
                    addcartbutton.attr('disabled', 'disabled');
                }else {
                    addcartbutton.removeAttr('disabled');
                }
            },
            error:function () {
                alert('Error something went wrong ');
            }

        });
    })

});
