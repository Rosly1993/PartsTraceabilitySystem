<!-- Edit Line Modal -->
<?php
				$user = $this->session->userdata('user');
				extract($user);
?> 
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Edit Line</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                <input type="hidden" id="edit_id" name="id">
                <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $fullname; ?>">
                    <div class="form-group">
                        <label for="edit_lines">Line Number</label>
                        <input type="text" class="form-control" id="edit_lines" name="editLine" placeholder="Enter Line Number" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_area_id">Area</label>
                        <select class="form-control" id="edit_area_id" name="editArea" required>
                        <option value="" disabled>Select Area</option>
                        <!-- Loop through areas and populate options -->
                        <?php foreach ($areas as $area): ?>
                        <option value="<?php echo $area['id']; ?>"><?php echo $area['area']; ?></option>
                        <?php endforeach; ?>
                        </select>

                            <!-- Options will be dynamically populated using JavaScript or fetched from the server -->
                       
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateChangesBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>
