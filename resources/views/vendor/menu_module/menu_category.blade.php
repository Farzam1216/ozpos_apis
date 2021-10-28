@php
   $title = 'Menu Category';
@endphp
@extends('layouts.app',['activePage' => 'vendor_menu_category'])

@section('title',$title)

@section('content')
   
   <section class="section">
      @if (Session::has('msg'))
         <script>
            var msg = "<?php echo Session::get('msg'); ?>"
            $(window).on('load', function () {
               iziToast.success({
                  message: msg,
                  position: 'topRight'
               });
            });
         </script>
      @endif
      
      @if (old('old_value') == "add")
         <script type="text/javascript">
            $(function () {
               $('#insert_modal').modal();
               $('#insert_modal').addClass('show');
            });
         </script>
      @endif
      
      @if (old('old_value') == "update")
         <script type="text/javascript">
            window.onload = () => {
               document.querySelector('[data-target="#edit_modal"]').click();
            }
         </script>
      @endif
      
      <div class="section-header">
         <h1>{{ $title }}</h1>
         <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="{{ url('vendor/vendor_home') }}">{{__('Dashboard')}}</a>
               </div>
               <div class="breadcrumb-item">{{ $title }}</div>
            </div>
         </div>
      </div>
      
      <div class="section-body">
         <h2 class="section-title">{{ $title }} Management</h2>
         {{--         <p class="section-lead">{{__('Add, and categorize the menu adding sub-menus. (Add,Edit & Manage Menu Categories )')}}</p>--}}
         <div class="card">
            <div class="card-header">
               <div class="w-100">
                  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#insert_modal">Add
                  </button>
               </div>
            </div>
            <div class="card-body">
               <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                     <th>
                        <input name="select_all" value="1" id="master" type="checkbox"/> <label for="master"></label>
                     </th>
                     <th>SR.</th>
                     <th>Name</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($MenuCategory as $idx=>$item)
                     <tr>
                        <td>
                           <input name="id[]" value="{{$item->id}}" id="{{$item->id}}" data-id="{{ $item->id }}" class="sub_chk" type="checkbox"/>
                           <label for="{{$item->id}}"></label>
                        </td>
                        <td>{{ $idx+1 }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{ ($item->status == 1) ? "enabled" : "disabled" }}</td>
                        <td>
                           <button type="button" onclick="updateData('vendor/menu_category',{{$item->id}})" class="btn btn-primary" data-toggle="modal" data-target="#edit_modal">
                              <i class="fas fa-pencil-alt"></i>
                           </button>
                           <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('vendor/menu_category',{{ $item->id }},'{{ $title }}')">
                              <i class="fas fa-trash"></i> </a>
   
                           @if($item->type === 'SINGLE')
                              <a href="{{ url('vendor/single_menu/'.$item->id) }}" class="btn btn-warning btn-action mr-1" data-toggle="tooltip" data-original-title="Single Menu">
                                 <i class="fas fa-boxes"></i>
                              </a>
                           @elseif($item->type === 'HALF_N_HALF')
                              <a href="{{ url('vendor/half_n_half_menu/'.$item->id) }}" class="btn btn-info btn-action mr-1" data-toggle="tooltip" data-original-title="Half N Half Menu">
                                 <i class="fas fa-utensils"></i>
                              </a>
                           @elseif($item->type === 'DEALS')
                              <a href="{{ url('vendor/deals_menu/'.$item->id) }}" class="btn btn-success btn-action mr-1" data-toggle="tooltip" data-original-title="Deals">
                                 <i class="fas fa-utensils"></i>
                              </a>
                           @endif
                        </td>
                     </tr>
                  @endforeach
                  </tbody>
               </table>
            </div>
            <div class="card-footer">
               <input type="button" value="Delete selected" onclick="deleteSelectionData('vendor/menu_category/selection_destroy','{{ $title }}')" class="btn btn-primary">
            </div>
         </div>
      </div>
   
   </section>
   
   <div class="modal right fade" id="insert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form class="container-fuild" action="{{ url('vendor/menu_category') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="old_value" value="add">
               <input type="hidden" name="vendor_id" value="{{ $Vendor->id }}">
               <div class="modal-header">
                  <h5 class="text-primary">Add</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label class="form-control-label">Name<span class="text-danger">&nbsp;*</span></label>
                     <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="{{ $title }} Name" required value="{{ old('name') }}">
                     @error('name')
                     <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <input class="form-control @error('status') is-invalid @enderror" id="status" name="status" type="checkbox" placeholder="{{ $title }} Status">
                     <label for="status" class="form-control-label">Status<span class="text-danger">&nbsp;*</span></label>
                     @error('status')
                     <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label class="form-control-label">Type<span class="text-danger">&nbsp;*</span></label>
                     <select class="populate form-control @error('type') is-invalid @enderror" name="type" >
                        <option value="SINGLE" {{ (old('type') == 'SINGLE') ? 'selected' : null }}>Single</option>
                        <option value="HALF_N_HALF" {{ (old('type') == 'HALF_N_HALF') ? 'selected' : null }}>Half n half</option>
                        <option value="DEALS" {{ (old('type') == 'DEALS') ? 'selected' : null }}>Deals</option>
                     </select>
                     @error('type')
                     <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                     @enderror
                  </div>
                  
                  <hr class="my-3">
                  
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                     <input type="submit" value="{{__('Save')}}" class="btn btn-primary">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   
   <div class="modal right fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form class="container-fuild" id="update_form" method="post" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               <input type="hidden" name="old_value" value="update">
               <input type="hidden" name="vendor_id" value="{{ $Vendor->id }}">
               <div class="modal-header">
                  <h5 class="text-primary">Update</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label class="form-control-label">Name<span class="text-danger">&nbsp;*</span></label>
                     <input class="populate form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="{{ $title }} Name" required value="{{ old('name') }}">
                     @error('name')
                     <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <input class="populate form-control @error('status') is-invalid @enderror" id="update_status" name="status" type="checkbox" placeholder="{{ $title }} Status" @if(old('status') == 1)  checked @endif >
                     <label for="update_status" class="form-control-label">Status</label>
                     @error('status')
                     <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label class="form-control-label">Type<span class="text-danger">&nbsp;*</span></label>
                     <select class="populate form-control @error('type') is-invalid @enderror" id="update_type" name="type" >
                        <option value="SINGLE" {{ (old('type') == 'SINGLE') ? 'selected' : null }}>Single</option>
                        <option value="HALF_N_HALF" {{ (old('type') == 'HALF_N_HALF') ? 'selected' : null }}>Half n half</option>
                        <option value="DEALS" {{ (old('type') == 'DEALS') ? 'selected' : null }}>Deals</option>
                     </select>
                     @error('type')
                     <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                     @enderror
                  </div>
                  
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                     <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>

@endsection
