<!-- Add the form element with an ID -->
<?php
				$user = $this->session->userdata('user');
				extract($user);
?> 
<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form id="addItemForm" action="<?php echo base_url('debplans/add_debplans'); ?>" method="post" enctype="multipart/form-data">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Deburring Plan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
            <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $fullname; ?>">
              <label for="model" class="control-label">Model</label><span style="color:red">*</span>
              <select type="text" class="form-control input-lg" id="model" name="model" placeholder="Enter description Name Here" required autocomplete="off">
                <option value="">Select Model</option>
                <?php foreach ($models as $model): ?>
                  <option value="<?php echo $model['model']; ?>"><?php echo $model['model']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group col-md-6">
              <label for="mold_no" class="control-label">Mold No</label><span style="color:red">*</span>
              <select type="text" class="form-control input-lg" id="mold_no" name="mold_no" placeholder="Enter Mold No Here" required autocomplete="off">
                <option value="">Select Mold No</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cavity" class="control-label">Cavity</label><span style="color:red">*</span>
              <select type="text" class="form-control input-lg" id="cavity" name="cavity" placeholder="Enter Location Here" required autocomplete="off">
                <option value="">Select Cavity</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="attachment" class="control-label">Attachment</label><span style="color:red">*</span>
              <input type="file" class="form-control input-lg" id="attachment" name="attachment" style="height: 40px" required autocomplete="off">
                
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('#model').change(function() {
    var selectedModel = $(this).val();
    console.log('Selected Model:', selectedModel);

    // Clear the mold_no and cavity dropdowns
    $('#mold_no').empty().append('<option value="">Select Mold No</option>');
    $('#cavity').empty().append('<option value="">Select Cavity</option>');

    // Send AJAX request to fetch mold_no options based on the selected model
    $.ajax({
      url: '<?php echo base_url("index.php/debplans/get_mold_numbers"); ?>',
      type: 'POST',
      dataType: 'json',
      data: {model: selectedModel},
      success: function(response) {
        console.log('Mold Numbers Response:', response);
        if (response && response.length > 0) {
          // Populate mold_no options based on the response array
          $.each(response, function(index, moldNo) {
            $('#mold_no').append('<option value="' + moldNo + '">' + moldNo + '</option>');
          });
        } else {
          // If no mold_no available, display "No mold_no"
          $('#mold_no').append('<option value="">No mold number</option>');
        }
      },
      error: function() {
        // If there is an error in the AJAX request, display "No mold_no"
        $('#mold_no').append('<option value="">No mold number</option>');
      }
    });
  });

  $('#mold_no').change(function() {
    var selectedMoldNo = $(this).val();
    console.log('Selected Mold No:', selectedMoldNo);

    // Clear the cavity dropdown
    $('#cavity').empty().append('<option value="">Select Cavity</option>');

    // Send AJAX request to fetch cavity options based on the selected mold_no
    $.ajax({
      url: '<?php echo base_url("index.php/debplans/get_cavities_by_mold_number"); ?>',
      type: 'POST',
      dataType: 'json',
      data: {mold_no: selectedMoldNo},
      success: function(response) {
        console.log('Cavity Response:', response);
        if (response && response.length > 0) {
          // Populate cavity options based on the response array
          $.each(response, function(index, cavity) {
            $('#cavity').append('<option value="' + cavity + '">' + cavity + '</option>');
          });
        } else {
          // If no cavities available, display "No cavity"
          $('#cavity').append('<option value="">No cavity</option>');
        }
      },
      error: function() {
        // If there is an error in the AJAX request, display "No cavity"
        $('#cavity').append('<option value="">No cavity</option>');
      }
    });
  });
});
</script>


