
jQuery(document).ready(function ($){
    var base = window.location.origin;
    // menu items
    var arrayjson = [{"href":"http://home.com","icon":"fas fa-home","text":"Home", "target": "_top", "title": "My Home"},{"icon":"fas fa-chart-bar","text":"Opcion2"},{"icon":"fas fa-bell","text":"Opcion3"},{"icon":"fas fa-crop","text":"Opcion4"},{"icon":"fas fa-flask","text":"Opcion5"},{"icon":"fas fa-map-marker","text":"Opcion6"},{"icon":"fas fa-search","text":"Opcion7","children":[{"icon":"fas fa-plug","text":"Opcion7-1","children":[{"icon":"fas fa-filter","text":"Opcion7-1-1"}]}]}];
    // icon picker options
    var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
    // sortable list options
    var sortableListOptions = {
        placeholderCss: {'background-color': "#cccccc"}
    };

    var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
    editor.setForm($('#frmEdit'));
    editor.setUpdateButton($('#btnUpdate'));
    $('#btnReload').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var  my_url = base + "/get-menu-list";
        $.ajax({
            type: 'get',
            url: my_url,
            success: (data) => {
                console.log(data.data)
                editor.setData(data.data);
                toastr.success(data.message)
            },
            error: function (data) {
                toastr.error(data.responseJSON.message)

            }
        });
        // editor.setData(arrayjson);
    });

    $('#btnOutput').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var  my_url = base + "/user-forget";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                toastr.success(data.message)
            },
            error: function (data) {
                toastr.error(data.responseJSON.message)

            }
        });
        var str = editor.getString();
        $("#out").text(str);
    });
    $('#menuSave').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var str = editor.getString();
        var  my_url = base + "/menu-store";
        $.ajax({
            type: 'post',
            url: my_url,
            data: {
                menu_data: JSON.parse(str)
            },
            success: (data) => {
                toastr.success(data.message)
            },
            error: function (data) {
                toastr.error(data.responseJSON.message)

            }
        });
        var str = editor.getString();
        $("#out").text(str);
    });

    $("#btnUpdate").click(function(){
        editor.update();
    });

    $('#btnAdd').click(function(){
        editor.add();
    });
    /* ====================================== */

    /** PAGE ELEMENTS **/
    $('[data-toggle="tooltip"]').tooltip();
    $.getJSON( "https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function( data ) {
        $('#btnStars').html(data.stargazers_count);
        $('#btnForks').html(data.forks_count);
    });
    $('#btnReload').click();
});
