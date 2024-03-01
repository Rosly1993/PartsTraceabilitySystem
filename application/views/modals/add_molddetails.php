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
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Mold Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control input-lg" id="userdata" name="userdata" value="<?php echo $fullname; ?>">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="model" class="control-label">Model</label><span style="color:red">*</span>
                            <select type="text" class="form-control input-lg" id="model" name="model" placeholder="Enter description Name Here" required autocomplete="off">
                                <option value="">Select Model</option>
                                <!-- Loop through areas and populate options -->
                                <?php foreach ($models as $model): ?>
                                    <option value="<?php echo $model['model']; ?>"><?php echo $model['model']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mold_no" class="control-label">Mold Number</label><span style="color:red">*</span>
                            <input type="number" style="height: 38px" class="form-control input-lg" id="mold_no" name="mold_no" placeholder="Enter Mold Number Here" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cavity_no" class="control-label">Number of Cavity</label><span style="color:red">*</span>
                            <select type="text" style="height: 38px" class="form-control input-lg" id="cavity_no" name="cavity_no" required autocomplete="off" onchange="showHideCavityFields()">
                                <option value="">Select Number of Cavity</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row" id="cavity_fields">
                        <!-- Cavity fields will be dynamically shown/hidden here -->
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

<script>
   function showHideCavityFields() {
    var cavity_no = document.getElementById("cavity_no").value;
    var cavity_fields = document.getElementById("cavity_fields");
    
    // Clear previous cavity fields
    cavity_fields.innerHTML = "";
    
    // Show cavity fields if cavity number is not empty
    if (cavity_no.trim() !== "") {
        // Show cavity fields based on selected cavity number
        for (var i = 1; i <= cavity_no; i++) {
            var label = document.createElement("label");
            label.setAttribute("for", "cavity" + i);
            label.innerText = "Cavity" + i;
            label.classList.add("control-label");
            label.innerHTML += "<span style='color:red'>*</span>";
            
            var input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("style", "height: 38px");
            input.classList.add("form-control", "input-lg");
            input.setAttribute("id", "cavity" + i);
            input.setAttribute("name", "cavity" + i);
            input.setAttribute("placeholder", "Cavity" + i);
            input.setAttribute("required", "required"); // Always add required attribute
            
            input.setAttribute("autocomplete", "off");
            
            var div = document.createElement("div");
            div.classList.add("form-group", "col-md-3");
            div.appendChild(label);
            div.appendChild(input);
            
            cavity_fields.appendChild(div);
        }
    }
}


</script>
