@extends('admin.app.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Role</h1>
                    </div><!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Role v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form id="menu_submit">
                  <div class="row">
                  <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <div class="row">
                                 <div class="col"><div class="card-title">
                                        {{$role->name}}'s menu
                                         <input type="hidden" value="{{$role->id}}" name="id">
                                     </div></div>
                                 <div class="col text-right">
                                     <a href="/role"  class="btn btn-sm btn-primary">Back to Role</a>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">

                             <div class="row">
                                 @foreach($menus as $m)
                                 <div class="col-md-4">
                                     <div class="form-check">
                                             <div class="form-check-inner">
                                                 <div class="custom-control mr-sm-2">
                                                     <input class="form-check-input parent-check" type="checkbox" value="{{$m['id']}}" id="menu{{$m['id']}}" name="menu[]" @if($m['is_checked']) checked @endif>
                                                     <label class="form-check-label" for="menu{{$m['id']}}" title="{{$m['url']}}">{{$m['name']}}</label>
                                                </div>
                                             </div>
                                         <ul class="sub-category active">
                                             @foreach($sub_menus as $sm)
                                                  @if($sm['menu_id'] == $m['id'])
                                                     <li>
                                                         <input class="form-check-input child-check" type="checkbox" name="sub_menu[]" id="sub_menu{{$sm['id']}}" value="{{$sm['id']}}" @if($sm['is_checked']) checked @endif>
                                                         <label class="form-check-label" title="{{$sm['url']}}" for="sub_menu{{$sm['id']}}">{{$sm['name']}}</label>
                                                     </li>
                                                 @endif
                                             @endforeach
                                         </ul>
                                     </div>
                                 </div>
                                  @endforeach
                             </div>
                             <div class="col-md-12 text-right">
                                 <button type="submit" class="btn btn-sm btn-primary">Save/Update</button>
                             </div>
                         </div>
                     </div>
                  </div>
              </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    @include('admin.pages.configure.role.modal')
@endsection
