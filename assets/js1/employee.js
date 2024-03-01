$(function(){
    showAllEmployee();

    //Add New
    $('#btnAdd').click(function(){
        $('#myModal').modal('show');
        $('#myModal').find('.modal-title').text('Add New Employee');
        $('#myForm').attr('action', '<?php echo base_url() ?>employee/addEmployee');
    });


    $('#btnSave').click(function(){
        var url = $('#myForm').attr('action');
        var data = $('#myForm').serialize();
        //validate form
        var empoyeeName = $('input[name=txtEmployeeName]');
        var address = $('textarea[name=txtAddress]');
        var result = '';
        if(empoyeeName.val()==''){
            empoyeeName.parent().parent().addClass('has-error');
        }else{
            empoyeeName.parent().parent().removeClass('has-error');
            result +='1';
        }
        if(address.val()==''){
            address.parent().parent().addClass('has-error');
        }else{
            address.parent().parent().removeClass('has-error');
            result +='2';
        }

        if(result=='12'){
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#myModal').modal('hide');
                        $('#myForm')[0].reset();
                        if(response.type=='add'){
                            var type = 'added'
                        }else if(response.type=='update'){
                            var type ="updated"
                        }
                        $('.alert-success').html('Employee '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
                        showAllEmployee();
                    }else{
                        alert('Error');
                    }
                },
                error: function(){
                    alert('Could not add data');
                }
            });
        }
    });

    //edit
    $('#showdata').on('click', '.item-edit', function(){
        var id = $(this).attr('data');
        $('#myModal').modal('show');
        $('#myModal').find('.modal-title').text('Edit Employee');
        $('#myForm').attr('action', '<?php echo base_url() ?>employee/updateEmployee');
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo base_url() ?>employee/editEmployee',
            data: {id: id},
            async: false,
            dataType: 'json',
            success: function(data){
                $('input[name=txtEmployeeName]').val(data.employee_name);
                $('textarea[name=txtAddress]').val(data.address);
                $('input[name=txtId]').val(data.id);
            },
            error: function(){
                alert('Could not Edit Data');
            }
        });
    });

    //delete- 
    $('#showdata').on('click', '.item-delete', function(){
        var id = $(this).attr('data');
        $('#deleteModal').modal('show');
        //prevent previous handler - unbind()
        $('#btnDelete').unbind().click(function(){
            $.ajax({
                type: 'ajax',
                method: 'get',
                async: false,
                url: '<?php echo base_url() ?>employee/deleteEmployee',
                data:{id:id},
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('#deleteModal').modal('hide');
                        $('.alert-success').html('Employee Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                        showAllEmployee();
                    }else{
                        alert('Error');
                    }
                },
                error: function(){
                    alert('Error deleting');
                }
            });
        });
    });



    //function
    function showAllEmployee(){
        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url() ?>employee/showAllEmployee',
            async: false,
            dataType: 'json',
            success: function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html +='<tr>'+
                                '<td>'+data[i].id+'</td>'+
                                '<td>'+data[i].employee_name+'</td>'+
                                '<td>'+data[i].address+'</td>'+
                                '<td>'+data[i].created_at+'</td>'+
                                '<td>'+
                                    '<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Edit</a>'+
                                    '<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a>'+
                                '</td>'+
                            '</tr>';
                }
                $('#showdata').html(html);
            },
            error: function(){
                alert('Could not get Data from Database');
            }
        });
    }
});