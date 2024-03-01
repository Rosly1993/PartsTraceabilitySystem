<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/sidebar'); ?>


    <div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h3 text-white d-inline-block mb-0">Models tables</h3>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?=site_url().'/models/'?>"><i class="fas fa-home"></i></a></li>
                           
                        </ol>
                    </nav>
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
               
              
                <!-- Light table -->
                <div style="padding: 15px">
                
                    <table id='items_table' class="table table-bordered table-striped" style="width: 100%" >
                        <thead style="height: 50px">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Area</th>
                                <th scope="col">Location</th>
                                <th scope="col">Created at</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body content goes here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



        
<?php $this->load->view("modals/add_model") ?>
<?php $this->load->view("modals/edit_model") ?>
<?php $this->load->view('components/footer.php'); ?>
  


        <script>
            $(document).ready(function () {
                // DataTable initialization
                var table = $('#items_table').DataTable({
                    "ajax": "<?php echo base_url('index.php/models/get_models'); ?>",
                    "columns": [
                        {
                            data: 'id',
                            className: 'py-0 px-1 text-center'
                        },
                        {
                            data: 'model',
                            className: 'py-0 px-1 text-center'
                        },
                        {
                            data: 'created_at',
                            className: 'py-0 px-1 text-center'
                        },
                        {
                            data: 'id',
                            orderable: false,
                            className: 'text-center py-0 px-1',
                            render: function (data, type, row, meta) {
                                return '<a class="me-2 btn-sm editbtn rounded-0 py-0 edit_data" href="javascript:void(0)" data-id="' + (row.id) + '" data-url="<?php echo base_url('index.php/models/get_model_details/'); ?>"><i class="ni ni-settings"></i></a>' +
                    '<a class="me-2 btn-sm deletebtn rounded-0 py-0 delete_data" href="javascript:void(0)" data-id="' + (row.id) + '"><i class="ni ni-fat-remove"></i></a>';
                            }
                        }
                    ],
                });

                // Buttons initialization
                new $.fn.dataTable.Buttons(table, {
                    buttons: [
                        {
                            text: '<a class="text-white addbtn"><i class="fas fa-plus text-white "></i>&nbsp; Add Model</a>',
                            className: "buttontest",
                            action: function (e, dt, node, config) {
                                $('#add_model').modal('show');
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<a class="text-white excelbtn"><i class="fa fa-file-excel  text-white"></i>&nbsp;&nbsp;Excel Download</a>',
                            className: "buttontest",
                            autoFilter: true,
                            sheetName: 'Exported data',
                            exportOptions: {
                                columns: ':visible'
                            },
                            title: 'Traceability'
                        },
                        {
                            extend: 'print',
                            text: '<a class="text-white pdfbtn"><i class="fa fa-file-pdf text-white"></i>&nbsp;&nbsp;PDF Download</a>',
                            className: "buttontest",
                            autoFilter: true,
                            orientation: 'landscape',
                            sheetName: 'Exported data',
                            exportOptions: {
                                columns: ':visible'
                            },
                            title: 'Traceability'
                        }
                    ]
                });

                // Add the buttons to the layout
                table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

                // ... Your existing code ...

                // Delegate click event to dynamically added elements
                $('#items_table tbody').on('click', '.edit_data', function () {
                    var id = $(this).data('id');
                    edit_data(id);
                });

                function addModel() {
                var modelName = $('#model').val();
                var userdata = $('#userdata').val();

                $.post("<?php echo base_url('index.php/models/add_model'); ?>", { modelName: modelName, userdata: userdata})
                    .done(function (data) {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });

                            table.ajax.reload();
                            $('#add_model').modal('hide');
                            $('#model').val('');
                            // $('#location').val('');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message
                            });
                        }
                    })
                    .fail(function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add area. Please try again later.'
                        });
                    });
            }

            $(document).on('click', '#saveChangesBtn', function (event) {
                event.preventDefault();
                addModel();
            });


// Function to handle edit_data
function edit_data(id) {
    // Fetch the current item details from the server
    $.ajax({
        url: "<?php echo base_url('index.php/models/get_model_details/'); ?>" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            // Log the data received from the server
            console.log("Data Received:", data);

            // Check if the response contains line_details
            if (data.model_details) {
                var existingId = data.model_details.id;
               
                var existingModel = data.model_details.model;
               
                // Log the existing data
                console.log("Existing Line:", existingId);
             
                console.log("Existing Model:", existingModel);

                // Populate form fields in the modal with existing data
                $('#edit_id').val(existingId);
              
                $('#edit_model').val(existingModel);
           

                // Show modal with pre-filled form fields
                $('#edit_modal').modal('show');
            } else {
                // Handle error or show a message if item details are not available
                console.error('Failed to fetch item details.');
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            // Handle error or show a message
        }
    });
}

        // Bind click event to the "Save Changes" button within the modal
        $('#updateChangesBtn').click(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Get the form data
            var formData = {
                id: $('#edit_id').val(),
                model: $('#edit_model').val(),
                userdata: $('#userdata').val()
                // Add any other form fields as needed
            };

            // Perform an AJAX request to save the edited data
            $.ajax({
    url: "<?php echo base_url('index.php/models/update_model'); ?>",
    type: "POST",
    data: formData,
    dataType: "json",
    success: function(response) {
        console.log("Success:", response);
        // Close the modal after successful submission
        $('#edit_modal').modal('hide');
        // Optionally, reload the DataTable or update the UI as needed
        table.ajax.reload(); // Reload the DataTable

       // Check if no changes were made
       if (response.status === 'no_changes') {
            Swal.fire({
                icon: 'info',
                title: 'No Changes',
                text: 'No changes were made.'
            });
        } else if (response.status === 'duplicate') {
            Swal.fire({
                icon: 'warning',
                title: 'Duplicate Data',
                text: 'Model already exists.'
            });
        } else {
            // Show a SweetAlert success message upon successful save
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data saved successfully!'
            });
        }
    },
    error: function(xhr, status, error) {
        console.error("Error:", error);
        // Handle errors or display error messages to the user
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while saving the data. Please try again.'
        });
    }
});
});






// Function to handle delete_data
function delete_data(id) {
    // Show Swal confirmation modal
    Swal.fire({
        title: 'Delete Model',
        text: 'Are you sure you want to delete this model?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed, make an AJAX request to delete the item
            $.ajax({
                url: "<?php echo base_url('index.php/models/delete_model'); ?>",
                type: "POST",
                data: { id: id },
                success: function (data) {
                    console.log("Success:", data);
                    // Reload the DataTable after deleting the item
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Area Deleted Successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            });
        }
    });
}

// Attach click event to dynamically added elements
$('#items_table tbody').on('click', '.delete_data', function () {
    var id = $(this).data('id');
    delete_data(id);
});
});


</script>
