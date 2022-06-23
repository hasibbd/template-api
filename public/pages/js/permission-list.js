$(document).ready(function () {

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
        let  my_url = base + "/permission-store";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                loading('off','Submit')
                toastr.success(data.message)
                $("#permission_div").load(location.href + " #permission_div");
                $('.modal').modal('hide')
                setTimeout(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                    $('#v-pills-'+data.parent.name+'-tab').addClass('active')
                }, 2000);
            },
            error: function (data) {
                loading('off','Submit')
                toastr.error(data.responseJSON.message)

            }
        });
    });
});
var base = window.location.origin;
function editModule(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let  my_url = base + "/permission-show/" + id;
    $.ajax({
        type: 'get',
        url: my_url,
        success: (data) => {
           $('#id').val(data.data.id)
           $('#parent_id').val(data.data.parent_menu)
           $('#name').val(data.data.name)
           $('#title').val(data.data.title)
           $('#mdl_ttl').text('Edit Data')
            $('.modal').modal('show')
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function deleteModule(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let  my_url = base + "/permission-delete/" + id;
            $.ajax({
                type: 'delete',
                url: my_url,
                success: (data) => {
                    $("#permission_div").load(location.href + " #permission_div");
                    $('[data-toggle="tooltip"]').tooltip()
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                },
                error: function (data) {
                    toastr.error(data.responseJSON.message)

                }
            });
        }
    })
}
function createModule(id) {
    $('#parent_id').val(id)
    $('#id').val(null)
    $('#name').val(null)
    $('#title').val(null)
    if (id == 0){
    $('#mdl_ttl').text('Add New Module')
    }else{
        $('#mdl_ttl').text('Add New Permission')
    }
    $('.modal').modal('show')
}

