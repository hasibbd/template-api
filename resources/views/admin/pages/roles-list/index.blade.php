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
                                 <div class="col">
                                     <div class="card-title">
                                         Role
                                     </div>
                                 </div>
                                 <div class="col text-right">
                                     <button onclick="openModal()" class="btn btn-sm btn-primary">Add New Role</button>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">
                             <table class="table table-bordered table-responsive-sm w-100 table-sm" id="role_list">
                                 <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Name</th>
                                     <th>Status</th>
                                     <th width="100px">Action</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                     </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@include('admin.pages.roles-list.modal')
@endsection
