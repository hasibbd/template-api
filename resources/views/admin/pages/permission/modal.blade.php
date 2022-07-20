<!-- Modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_submit" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">
                          <input type="hidden" name="id" id="id">
                          <input type="hidden" name="parent_id" id="parent_id">
                          <div class="form-group ">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                          </div>
                          <div class="form-group ">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
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
