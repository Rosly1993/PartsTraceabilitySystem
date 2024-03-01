<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/sidebar'); ?>

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tables</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
			<button id="btnAdd" class="btn btn-primary">Add New</button>
			  <div class="alert alert-success" style="display: none;"></div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">

			
			<table id='cat-tbl' class="table table-bordered table-responsive" style="margin-top: 20px;">
		     <thead>
				<tr>
				<td>ID</td>
				<td>Employee Name</td>
				<td>Address</td>
				<td>Created at</td>
				<td>Action</td>
				</tr>
			</thead>
			<tbody id="showdata">
			
			</tbody>
			</table>
            </div>
            </div>
            </div>
            </div>

<?php $this->load->view("modals/add_employee") ?>
<?php $this->load->view("modals/edit_employee") ?>
<?php $this->load->view('components/footer.php'); ?>



<script>
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
</script>