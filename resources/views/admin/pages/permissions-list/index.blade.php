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
                <form action="" id="form_submit">
              <div class="row">
                  <div class="col-12">
                     <div class="card">
                         <div class="card-header bg-primary">
                             <div class="custom-control custom-checkbox">
                                 <input type="checkbox" onclick="checkAll()" class="custom-control-input" id="all">
                                 <label class="custom-control-label" for="all">Select All</label>
                             </div>
                         </div>
                         <div class="card-body">
                            <div class="row">
                                @foreach($data->where('parent_menu', 0) as $d)
                                   <div class="col-md-4">
                                       <div class="card">
                                           <div class="card-header bg-primary">
                                               <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="{{$d->name}}1">
                                                   <label class="custom-control-label" for="{{$d->name}}1">{{$d->name}}'s all</label>
                                               </div>
                                           </div>
                                           <div class="card-body">
                                               <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" name="checked_item[]" value="{{$d->id}}" id="{{$d->name}}">
                                                   <label class="custom-control-label" for="{{$d->name}}">{{$d->name}}</label>
                                               </div>
                                               @foreach($data->where('parent_menu', $d->id) as $c)
                                                   <div class="custom-control custom-checkbox">
                                                       <input type="checkbox" class="custom-control-input"  name="checked_item[]" value="{{$c->id}}" id="{{$c->name}}">
                                                       <label class="custom-control-label" for="{{$c->name}}">{{$c->name}}</label>
                                                   </div>
                                               @endforeach

                                           </div>
                                       </div>
                                   </div>
                                @endforeach
                            </div>
                         </div>
                         <div class="card-footer">
                             <button type="submit" class="btn btn-sm btn-primary">Save</button>
                         </div>
                     </div>
                  </div>
              </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
