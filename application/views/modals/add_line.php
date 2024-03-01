<!-- Add the form element with an ID -->
<?php
				$user = $this->session->userdata('user');
				extract($user);
?> 
<div class="modal fade" id="add_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="addItemForm"> <!-- Add the form element here -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Line</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $fullname; ?>">
          <div class="form-group col-12 col-md-12 col-sm-12">
            <label for="lines" class="control-label">Line Number</label><span style="color:red">*</span>
            <input type="text" class="form-control input-lg" id="lines" name="lines" placeholder="Enter Line Number Here"  required autocomplete="off">
          </div>
          <div class="form-group col-12 col-md-12 col-sm-12">
            <label for="area_id" class="control-label">Area</label><span style="color:red">*</span>
            <select type="text" class="form-control input-lg" id="area_id" name="area_id" placeholder="Enter description Name Here"  required autocomplete="off">
           
           <option value="">Select Area</option>
            <!-- Loop through areas and populate options -->
            <?php foreach ($areas as $area): ?>
            <option value="<?php echo $area['id']; ?>"><?php echo $area['area']; ?></option>
            <?php endforeach; ?>

            </select>
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
