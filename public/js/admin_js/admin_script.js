$(document).ready(function (message) {
    //check Admin Password is correct or not
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data:{current_pwd:current_pwd},
            success:function (resp) {
                if (resp == "false"){
                    $("#checkCurrentPwd").html("<span style='color: red;'>Current Password is incorrect</span>")
                }else if(resp == "true"){
                        $("#checkCurrentPwd").html("<span style='color: green;'>Current Password is correct</span>")
                }
            },
            error:function () {
                console.log('error')
            }
        })
    });

    /*Categories level*/
    $("#section_id").change(function () {
        var section_id = $(this).val();
       $.ajax({
           type: 'post',
           url: '/admin/append-categories-level',
           data:{section_id:section_id},
           success:function (resp) {
                $("#appendCategoriesLevel").html(resp)
           },
           error:function () {
                alert('Something went wrong')
           }
       });
    });

    /*Update status*/
    $(document).on("click",".updateStatus",function(){
        var status = $(this).children('i').attr('status');
        var url = $(this).attr('url');
        var data_id = $(this).attr("data_id");
        //alert(url +' '+ data_id +' '+ status);
        $.ajax({
            type: 'patch',
            url: '/admin/'+url,
            data:{status:status, data_id:data_id},
            success:function (resp) {
                if (resp['status']==0){
                    $("#data-"+data_id)
                        .html("<i class='fas fa-toggle-off' aria-hidden='true' title='Status is inactive' status='Inactive'></i>")
                }else {
                    $("#data-"+data_id)
                        .html("<i class='fas fa-toggle-on' aria-hidden='true' title='Status is active' status='Active'></i>")
                }
            },
            error:function () {
                alert('Something went wrong')
            }
        });
    });


    $(document).on("click",".confirmDelete",function(){
        var record = $(this).attr('record');
        var recordid = $(this).attr('recordid');
       //alert(record);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href="/admin/delete-"+record+"/"+recordid;
            }
        });
    });

    /*ADD AND REMOVE INPUT FIELD DYNAMICALLY BY JQUERY*/
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div>' +
        '<input type="text" name="size[]" id="size" value="" class="mb-2" placeholder="Size"/>'+
        '<input type="text" name="price[]" id="price" value="" class="mb-2 ml-1" placeholder="Price"/>'+
        '<input type="text" name="sku[]" id="sku" value="" class="mb-2 ml-1" placeholder="Sku"/>'+
        '<input type="text" name="stock[]" id="stock" value="" class="mb-2 ml-1" placeholder="Stock"/>'+
        '<a href="javascript:void(0);" class="remove_button"><i class="fas fa-minus-circle ml-1"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

});
