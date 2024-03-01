<?php
				$user = $this->session->userdata('user');
				extract($user);
?> 


<!-- Add the form element with an ID -->
<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="addItemForm"> <!-- Add the form element here -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" class="form-control input-lg" id="user_data" name="user_data" value="<?php echo $fullname; ?>">
          <div class="form-group col-12 col-md-12 col-sm-12">
            <label for="item" class="control-label">Item</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="item" name="item" placeholder="Enter Item Name Here" onkeyup="this.value = this.value.toUpperCase()" required autocomplete="off">
          </div>
          <div class="form-group col-12 col-md-12 col-sm-12">
            <label for="description" class="control-label">Description</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="description" name="description" placeholder="Enter description Name Here" onkeyup="this.value = this.value.toUpperCase()" required autocomplete="off">
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
