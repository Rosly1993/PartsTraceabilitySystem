<!-- Edit Line Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal_label">Edit Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_area">Area</label>
                        <input type="text" class="form-control" id="edit_area" name="editArea" placeholder="Enter Line Number">
                    </div>
                    <div class="form-group">
                        <label for="edit_location">Location</label>
                        <select class="form-control" id="edit_location" name="editLocation">
                        <option value="" disabled>Select Area</option>
                        <option value="casting">Casting</option>
                        <option value="machining">Machining</option>

                        <!-- Loop through areas and populate options -->
                       
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
