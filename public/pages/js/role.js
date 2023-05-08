$(document).ready(function () {
    $("#role-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/role",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'system_admin', name: 'system_admin'},
            {data: 'status', name: 'status'},
            {data: 'm-action', name: 'm-action'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
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
    $('#menu_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        loading('on','Wait...')
        let formData = new FormData(this);
        let  my_url = base + "/role-menu-store";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
               // $('.table').DataTable().ajax.reload();
                loading('off','Submit')
                toastr.success(data.message)
              //  formReset();
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
            $('#id').val(data.data.id);
            $('#name').val(data.data.name);
            $('#system_admin').prop('checked',data.data.is_sys_admin);
            $('#add_modal').modal('show');
        },
        error: function (data) {
            toastr.error(data.responseJSON.message)

        }
    });
}
function previewFile(input){
    console.log(input)
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
function AddNew() {
    $('form').trigger("reset");
    $('#id').val(null);
    $('#add_modal').modal('show')
}
$('.parent-check').on('click', function () {
   if ($(this).is(':checked')){
       $(this).parent().parent().next('ul').children('li').children('.child-check').prop('checked', true)
   }else{
       $(this).parent().parent().next('ul').children('li').children('.child-check').prop('checked', false)
   }
})
$('.child-check').on('click', function () {
    if ($(this).is(':checked')){
        $(this).parent().parent().prev().children().children('.parent-check').prop('checked', true)
    }
})
