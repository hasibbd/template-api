<!-- Modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span> Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_submit" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <input type="hidden" name="id" id="id">
                          <div class="form-group ">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                          </div>
                      </div>
                      <div class="col-md-12">
                        <div class="row" id="role-view">
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h1 class=card-title>f</h1>
                                    </div>
                                    <div class="card-body">

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
