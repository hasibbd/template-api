<!-- Modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span> Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group ">
                        <label for="title">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="system_admin" value="1" name="system_admin">
                        <label class="custom-control-label" for="system_admin">System Admin</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="sub_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
