<!-- Modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span> Role Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_submit_permission" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <input type="hidden" name="id" id="id">
                          <div class="form-group ">
                              <label for="title">Role Mame</label>
                              <input type="text" class="form-control" id="role" name="role" placeholder="Role Name" required>
                          </div>
                      </div>
                      <div class="col-md-12">
                              <div class="row">
                                  <div class="col-12">
                                      <div class="card">
                                          <div class="card-header bg-primary">
                                              <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="all">
                                                  <label class="custom-control-label" for="all">Select All</label>
                                              </div>
                                          </div>
                                          <div class="card-body">
                                              <div class="row" id="permission_block">

                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                      </div>
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
