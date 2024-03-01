<?php
				$user = $this->session->userdata('user');
				extract($user);
?> 
<!-- Edit Line Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Edit Model</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                <input type="hidden" id="edit_id" name="id">
                <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $fullname; ?>">
                    <div class="form-group">
                        <label for="edit_model">Model</label>
                        <input type="text" class="form-control" id="edit_model" name="editModel" placeholder="Enter Line Number">
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
