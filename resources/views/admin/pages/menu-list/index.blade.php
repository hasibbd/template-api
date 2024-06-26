@extends('admin.app.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Menu Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{'dashboard'}}">Home</a></li>
                            <li class="breadcrumb-item active">Menu Setting</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header"><h5 class="float-left">Menu</h5>
                                <div class="float-right">
                                    <button id="btnReload" type="button" class="btn btn-outline-secondary">
                                        <i class="fa fa-play"></i> Load Data</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul id="myEditor" class="sortableLists list-group">
                                </ul>
                            </div>
                            <div class="card-footer">
                                <button type="button" id="menuSave" class="btn btn-success"><i class="fas fa-plus"></i> Save</button>
                            </div>
                        </div>
                      {{--  <p>Click the Output button to execute the function <code>getString();</code></p>
                        <div class="card">
                            <div class="card-header">JSON Output
                                <div class="float-right">
                                    <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Output</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group"><textarea id="out" class="form-control" cols="50" rows="10"></textarea>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                    <div class="col-md-4">
                        <div class="card border-primary mb-3">
                            <div class="card-header bg-primary text-white">Edit item</div>
                            <div class="card-body">
                                <form id="frmEdit" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="text">Text</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                            <div class="input-group-append">
                                                <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="icon" class="item-menu">
                                    </div>
                                    <div class="form-group">
                                        <label for="href">URL</label>
                                        <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Target</label>
                                        <select name="target" id="target" class="form-control item-menu">
                                            <option value="_self">Self</option>
                                            <option value="_blank">Blank</option>
                                            <option value="_top">Top</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Tooltip</label>
                                        <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                                <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@section('script')
    <script>

        jQuery(document).ready(function () {
            loadMenu()
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
                loadMenu()
                // editor.setData(arrayjson);
            });
            function loadMenu(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var  my_url = "/get-menu-list";
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
                })
            }
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
        });

    </script>
@endsection
