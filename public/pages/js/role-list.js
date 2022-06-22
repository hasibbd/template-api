$(document).ready(function () {
    $("input[type='checkbox']").change(function () {

        if ($(this).is(":checked")){
            $(this).parent().parent().next(".card-body").find(':checkbox').prop('checked', true)
        }else{
            $(this).parent().parent().next(".card-body").find(':checkbox').prop('checked', false)
        }
    });
    var base = window.location.origin;
    function loading(type,text) {
        if (type == 'on'){
            $('.load').prop("disabled",true).html('<span class="spinner-border spinner-border-sm mr-3" role="status" aria-hidden="true"></span>'+text);
        }else{
            $('.load').prop("disabled",false).text(text);
        }
    }
    function formReset(){
        $(".select2bs4").val(null).trigger('change');
        $(".select2").val(null).trigger('change');
        $('.modal').modal('hide');
        $('form').trigger("reset");
        $("formId")[0].reset()
    }

    $('#form_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on','Wait...')
        let formData = new FormData(this);
        let  my_url = base + "/role-store";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('.table').DataTable().ajax.reload();
                loading('off','Submit')
                toastr.success(data.message)
                formReset();
            },
            error: function (data) {
                loading('off','Submit')
                toastr.error(data.responseJSON.message)

            }
        });
    });
    $('#form_submit_permission').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on','Wait...')
        let formData = new FormData(this);
        let  my_url = base + "/role-permission-store";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
              //  $('.table').DataTable().ajax.reload();
                loading('off','Submit')
                toastr.success(data.message)
                formReset();
            },
            error: function (data) {
                loading('off','Submit')
                toastr.error(data.responseJSON.message)

            }
        });
    });
});
var base = window.location.origin;
function Status(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/role-status/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('.table').DataTable().ajax.reload();
            toastr.success(data.message)
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function Delete(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let  my_url = base + "/role-delete/" + id;
                $.ajax({
                    type: 'delete',
                    url: my_url,
                    success: (data) => {
                        $('.table').DataTable().ajax.reload();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message)

                    }
                });

            } else {
                swal("Your imaginary file is safe!");
            }
        });
}
function Show(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/role-show/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
            $('form').trigger("reset");
            let el = '';
             data.permission.forEach((element, index) => {
                 if (element.parent_menu === 0){
                     el += '   <div class="col-md-4">\n' +
                         '                                                          <div class="card">\n' +
                         '                                                              <div class="card-header bg-primary">\n' +
                         '                                                                  <div class="custom-control custom-checkbox">\n' +
                         '                                                                      <input type="checkbox" class="custom-control-input" id="'+element.name+'1">\n' +
                         '                                                                      <label class="custom-control-label" for="'+element.name+'1">'+element.name+'\'s all</label>\n' +
                         '                                                                  </div>\n' +
                         '                                                              </div>\n' +
                         '                                                              <div class="card-body">\n' +
                         '                                                                  <div class="custom-control custom-checkbox">\n' +
                         '                                                                      <input type="checkbox" class="custom-control-input" checked="'+element.is_checked+'" name="checked_item[]" value="'+element.id+'" id="'+element.name+'">\n' +
                         '                                                                      <label class="custom-control-label" for="'+element.name+'">'+element.name+'</label>\n' +
                         '                                                                  </div>'
                     data.permission.forEach((element2, index2) => {
                         if (parseInt(element2.parent_menu) === parseInt(element.id)){
                              el += '          <div class="custom-control custom-checkbox">\n' +
                                  '                                                                          <input type="checkbox" checked="'+element2.is_checked+'" class="custom-control-input"  name="checked_item[]" value="'+element2.id+'" id="'+element2.name+'">\n' +
                                  '                                                                          <label class="custom-control-label" for="'+element2.name+'">'+element2.name+'</label>\n' +
                                  '                                                                      </div>';
                         }
                     })
                     el += '   </div>\n' +
                         '                                                          </div>\n' +
                         '                                                      </div>';
                 }
             })
            $('#permission_block').append(el)
            $('#role').val(data.role.name)
            $('#id').val(data.role.id)
            $('#add_modal').modal('show');
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
function checkAll() {
    if ($(this).is(":checked")){
        $(this).parent().parent().next(".card-body .row .col-md-4 .card .card-header .custom-control").find(':checkbox').prop('checked', true)
    }else{
        $(this).parent().parent().next(".card-body .row .col-md-4 .card .card-header .custom-control").find(':checkbox').prop('checked', false)
    }
}
