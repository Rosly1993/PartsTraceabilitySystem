<!-- Add the form element with an ID -->
<?php
				$user = $this->session->userdata('user');
				extract($user);
?> 
<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form id="addItemForm" action="<?php echo base_url('models/add_model'); ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Model</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group col-12 col-md-12 col-sm-12">
          <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $fullname; ?>">
            <label for="model" class="control-label">Model</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="model" name="model" placeholder="Enter Model Here"  required autocomplete="off">
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
