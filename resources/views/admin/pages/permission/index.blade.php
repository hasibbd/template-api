@extends('admin.app.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{'dashboard'}}">Home</a></li>
                            <li class="breadcrumb-item active">User List v1</li>
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
                  <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <div class="row">
                                 <div class="col"><div class="card-title">
                                         Permission
                                     </div></div>
                                 <div class="col text-right">
                                     <button onclick="createModule(0)" class="btn btn-sm btn-primary">Add New Module</button>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body" id="permission_div">
                             <div class="row">
                                 <div class="col-3">
                                     <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                         @foreach($data->where('parent_menu', 0) as $d)
                                             @if($loop->index == 0)
                                                 <a class="nav-link active" id="v-pills-{{$d->name}}-tab" data-toggle="pill" href="#v-pills-{{$d->name}}" role="tab" aria-controls="v-pills-{{$d->name}}" aria-selected="true">{{$d->name}}</a>
                                             @else
                                                 <a class="nav-link" id="v-pills-{{$d->name}}-tab" data-toggle="pill" href="#v-pills-{{$d->name}}" role="tab" aria-controls="v-pills-{{$d->name}}" aria-selected="false">{{$d->name}}</a>
                                             @endif
                                         @endforeach
                                    </div>
                                 </div>
                                 <div class="col-9">
                                     <div class="tab-content" id="v-pills-tabContent">
                                         @foreach($data->where('parent_menu', 0) as $d)
                                             @if($loop->index == 0)
                                                 <div class="tab-pane fade show active" id="v-pills-{{$d->name}}" role="tabpanel" aria-labelledby="v-pills-{{$d->name}}-tab">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <button onclick="editModule({{$d->id}})" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Module Name"><i class="fas fa-edit"></i></button>
                                                                <button onclick="deleteModule({{$d->id}})" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Full Module"><i class="fas fa-trash-alt"></i></button>
                                                                <button onclick="createModule({{$d->id}})" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Add New Permission"><i class="far fa-plus-square"></i></button>
                                                            </div>
                                                            <div class="card-body">
                                                                <table class="table table-bordered table-sm small">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="w-75">Permission Name</th>
                                                                        <th class="w-25">Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($data->where('parent_menu', $d->id) as $c)
                                                                        <tr>
                                                                            <th>{{$c->name}}</th>
                                                                            <th>
                                                                                <button onclick="editModule({{$c->id}})" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Permission Name: {{$c->name}}"><i class="fas fa-edit"></i></button>
                                                                                <button onclick="deleteModule({{$c->id}})" class="btn btn-sm btn-danger"><i class="fas fa-ban" data-toggle="tooltip" data-placement="top" title="Delete Permission: {{$c->name}}"></i></button>
                                                                            </th>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                 </div>
                                             @else
                                                 <div class="tab-pane fade" id="v-pills-{{$d->name}}" role="tabpanel" aria-labelledby="v-pills-{{$d->name}}-tab">
                                                     <div class="card">
                                                         <div class="card-header">
                                                             <button onclick="editModule({{$d->id}})" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Module Name"><i class="fas fa-edit"></i></button>
                                                             <button onclick="deleteModule({{$d->id}})" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Full Module"><i class="fas fa-trash-alt"></i></button>
                                                             <button onclick="createModule({{$d->id}})" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Add New Permission"><i class="far fa-plus-square"></i></button>
                                                         </div>
                                                         <div class="card-body">
                                                             <table class="table table-bordered table-sm small">
                                                                 <thead>
                                                                 <tr>
                                                                     <th class="w-75">Permission Name</th>
                                                                     <th class="w-25">Action</th>
                                                                 </tr>
                                                                 </thead>
                                                                 <tbody>
                                                                 @foreach($data->where('parent_menu', $d->id) as $c)
                                                                     <tr>
                                                                         <th>{{$c->name}}</th>
                                                                         <th>
                                                                             <button onclick="editModule({{$c->id}})" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Permission Name: {{$c->name}}"><i class="fas fa-edit"></i></button>
                                                                             <button onclick="deleteModule({{$c->id}})" class="btn btn-sm btn-danger"><i class="fas fa-ban" data-toggle="tooltip" data-placement="top" title="Delete Permission: {{$c->name}}"></i></button>
                                                                         </th>
                                                                     </tr>
                                                                 @endforeach
                                                                 </tbody>
                                                             </table>
                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                         @endforeach
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                  </div>
              </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@include('admin.pages.permission.modal')
@endsection
