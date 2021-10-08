@php
  $title = 'Menu Addon';
  $GeneralSetting = App\Models\GeneralSetting::first();
  $currency_symbol = $GeneralSetting->currency_symbol;
@endphp

@extends('layouts.app',['activePage' => 'vendor_menu'])

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
          <div class="breadcrumb-item active"><a href="{{ url('vendor/vendor_home') }}">{{__('Dashboard')}}</a></div>
          <div class="breadcrumb-item active"><a href="{{ url('vendor/menu') }}">Menu</a></div>
           @if($menu_size_id !== null)
              <div class="breadcrumb-item active"><a href="{{ url('vendor/menu_size/'.$menu_id) }}">Menu Size</a></div>
           @endif
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
              <th>Price</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($MenuAddon as $idx=>$item)
              <tr>
                <td>
                  <input name="id[]" value="{{$item->id}}" id="{{$item->id}}" data-id="{{ $item->id }}" class="sub_chk" type="checkbox"/>
                  <label for="{{$item->id}}"></label>
                </td>
                <td>{{ $idx+1 }}</td>
                <td>{{ $item->Addon->name }}</td>
                <td>{{ $currency_symbol }} {{ $item->price }}</td>
                <td>
                  <button type="button" onclick="updateData('vendor/menu_addon',{{$item->id}})" class="btn btn-primary" data-toggle="modal" data-target="#edit_modal">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                  <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('vendor/menu_addon',{{ $item->id }},'{{ $title }}')">
                    <i class="fas fa-trash"></i> </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <input type="button" value="Delete selected" onclick="deleteSelectionData('vendor/menu_addon/selection_destroy','{{ $title }}')" class="btn btn-primary">
        </div>
      </div>
    </div>

  </section>

  <div class="modal right fade" id="insert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form class="container-fuild" action="{{ url('vendor/menu_addon') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="old_value" value="add">
          <input type="hidden" name="vendor_id" value="{{ $Vendor->id }}">
          <input type="hidden" name="menu_id" value="{{ $menu_id }}">
          <input type="hidden" name="menu_size_id" value="{{ $menu_size_id }}">
          <div class="modal-header">
            <h5 class="text-primary">Add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="form-control-label">Addon<span class="text-danger">&nbsp;*</span></label>
              <select class="form-control @error('addon_id') is-invalid @enderror" name="addon_id">
                @foreach(App\Models\Addon::where('vendor_id', $Vendor->id)->get() as $Addon)
                  <option value="{{ $Addon->id }}" @if(old('addon_id') === $Addon->id) selected @endif >{{ $Addon->name }}</option>
                @endforeach
              </select>
              @error('addon_id')
              <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-control-label">Price<span class="text-danger">&nbsp;*</span></label>
              <input class="form-control @error('price') is-invalid @enderror" name="price" type="text" placeholder="{{ $title }} Price" required value="{{ old('price') }}">
              @error('price')
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
          <input type="hidden" name="menu_id" value="{{ $menu_id }}">
          <input type="hidden" name="menu_size_id" value="{{ $menu_size_id }}">
          <div class="modal-header">
            <h5 class="text-primary">Update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="form-control-label">Addon<span class="text-danger">&nbsp;*</span></label>
              <select class="populate form-control @error('addon_id') is-invalid @enderror" name="addon_id">
                @foreach(App\Models\Addon::where('vendor_id', $Vendor->id)->get() as $Addon)
                  <option value="{{ $Addon->id }}" @if(old('addon_id') === $Addon->id) selected @endif >{{ $Addon->name }}</option>
                @endforeach
              </select>
              @error('addon_id')
              <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-control-label">Price<span class="text-danger">&nbsp;*</span></label>
              <input class="populate form-control @error('price') is-invalid @enderror" name="price" type="text" placeholder="{{ $title }} Price" required value="{{ old('price') }}">
              @error('price')
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
