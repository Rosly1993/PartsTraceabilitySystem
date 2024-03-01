<!-- Edit Line Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Edit Mold Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_model">Model</label>
                       <select type="text" class="form-control" id="edit_model" name="editModel" placeholder="Enter Line Number">
                       <option value="">Select Model</option>
                                <!-- Loop through areas and populate options -->
                                <?php foreach ($models as $model): ?>
                                    <option value="<?php echo $model['model']; ?>"><?php echo $model['model']; ?></option>
                                <?php endforeach; ?>
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_moldno">Mold Number</label>
                       <input type="text" class="form-control" id="edit_moldno" name="editMoldno" placeholder="Enter Line Number">
                   
                      
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="edit_cavity1">Cavity 1</label>
                       <input type="text" class="form-control" id="edit_cavity1" name="editCavity1" placeholder="Enter Cavity 1">
                   
                      
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_cavity2">Cavity 2</label>
                       <input type="text" class="form-control" id="edit_cavity2" name="editCavity2" placeholder="Enter Cavity 2">
                   
                      
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_cavity3">Cavity 3</label>
                       <input type="text" class="form-control" id="edit_cavity3" name="editCavity3" placeholder="Enter Cavity 3">
                   
                      
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_cavity4">Cavity 4</label>
                       <input type="text" class="form-control" id="edit_cavity4" name="editCavity4" placeholder="Enter Cavity 4">
                   
                      
                    </div>
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
