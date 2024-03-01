$(document).ready(function () {
    var table = $('#myTable').DataTable({
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            },
        ],
        order: [[1, 'desc']],
        dom: 'Blfrtip',
        pageLength: 10,
        responsive: true,
        lengthMenu: [
            [ 10, 20, 25, 50, 100, -1],
            [ 10, 20, 25, 50, 100, 'All'],
        ],
        buttons: [
              
            // {
                
            //     text: '<a class="text-white addbtn"><i class="fas fa-plus text-white "></i>&nbsp; Add New User</a>',
            //     className: "buttontest",
            //     action: function(e, dt, node, config) {
            //         $('#add_model').modal('show')
            //     },
            
            //     },
                {
                    extend: 'excelHtml5',
                    text:'<a class="text-white excelbtn"><i class="fa fa-file-excel  text-white"></i>&nbsp;&nbsp;Excel Download</a>',
                    className: "buttontest",
                    autoFilter: true,
                    sheetName: 'Exported data',
                    exportOptions: {
                        columns: ':visible'
                    },  title: 'Trims',
                },
                {
                    extend: 'pdfHtml5',
                    text: '<a class="text-white pdfbtn"><i class="fa fa-file-pdf text-white"></i>&nbsp;&nbsp;PDF Download</a>',
                    className: 'buttontest',
                    title: 'Trims',
                    customize: function(doc) {
                        // Remove borders from buttons in the generated PDF
                        $(doc.document).find('.buttontest').css('border', 'none');
                    }
                }
                
                
                
        ],
    });
});
