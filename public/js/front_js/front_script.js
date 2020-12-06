$(document).ready(function (message){
    // $("#sort").on('change',function () {
    //     this.form.submit();
    // })
    $("#sort").on('change', function () {
        let sort = $(this).val();
        var url = $("#url").val();
        var fabric = get_filter('fabric');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
        var pattern = get_filter('pattern');
        var sleeve = get_filter('sleeve');
       $.ajax({
           url:url,
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
        var sort = $("#sort option:selected").text();
        var url = $("#url").val();
        $.ajax({
            url:url,
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


});
