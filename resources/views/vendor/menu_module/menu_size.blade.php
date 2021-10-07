@php
  $title = 'Menu Size';
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
          <div class="breadcrumb-item">{{ $title }}</div>
        </div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">{ $title }} Management</h2>
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
              <th>Price - Discount Price</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($MenuSize as $idx=>$item)
              <tr>
                <td>
                  <input name="id[]" value="{{$item->id}}" id="{{$item->id}}" data-id="{{ $item->id }}" class="sub_chk" type="checkbox"/>
                  <label for="{{$item->id}}"></label>
                </td>
                <td>{{ $idx+1 }}</td>
                <td>{{$item->ItemSize->name}}</td>
                <td>
                  @if($item->display_discount_price !== null)
                    <span style="text-decoration: line-through">{{ $currency_symbol }} {{$item->display_price}}</span> - {{ $currency_symbol }} {{$item->display_discount_price}}
                  @else
                    {{ $currency_symbol }} {{ $item->display_price }}
                  @endif
                </td>
                <td>
                  <button type="button" onclick="updateData('vendor/menu_size',{{$item->id}})" class="btn btn-primary" data-toggle="modal" data-target="#edit_modal">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                  <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('vendor/menu_size',{{ $item->id }},'{{ $title }}')">
                    <i class="fas fa-trash"></i> </a>
                  <a href="{{ url('vendor/menu_addon/'.$item->id) }}" class="btn btn-info btn-action mr-1" data-toggle="tooltip" data-original-title="Menu Size Addons">
                    <i class="fas fa-utensils"></i>
                  </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <input type="button" value="Delete selected" onclick="deleteSelectionData('vendor/menu_size/selection_destroy','{{ $title }}')" class="btn btn-primary">
        </div>
      </div>
    </div>

  </section>

  <div class="modal right fade" id="insert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form class="container-fuild" action="{{ url('vendor/menu_size') }}" method="post" enctype="multipart/form-data">
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

              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="image" accept=".png, .jpg, .jpeg, .svg"
                         id="customFileLang1" lang="en">
                  <label class="custom-file-label" for="customFileLang1">{{__('Select file')}}</label>
                </div>
                @error('image')
                <span class="custom_error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
              </div>

              <label class="form-control-label">Name<span class="text-danger">&nbsp;*</span></label>
              <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="{{ $title }} Name" required value="{{ old('name') }}">
              @error('name')
              <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
              @enderror

              <label class="form-control-label">Description<span class="text-danger">&nbsp;*</span></label>
              <input class="form-control @error('description') is-invalid @enderror" name="description" type="text" placeholder="{{ $title }} Description" required value="{{ old('description') }}">
              @error('description')
              <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
              @enderror


              <input type="checkbox" id="has_size" name="has_size">
              <label for="has_size">Has Size</label>

              <script type="application/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                  let hasSizeCheckbox = document.getElementById('has_size');

                  hasSizeCheckbox.addEventListener('change', function(event)
                  {
                    if (event.target.checked) {
                      document.getElementById("prices").style.display = "none";
                      document.getElementById("display_price").value = "";
                      document.getElementById("display_discount_price").value = "";
                    }
                    else {
                      document.getElementById("prices").style.display = "block";
                    }
                  });
                }, false);
              </script>

              <div id="prices">
                <label class="form-control-label">Price</label>
                <input class="form-control @error('display_price') is-invalid @enderror" id="display_price" name="display_price" type="text" placeholder="{{ $title }} Price" value="{{ old('display_price') }}">
                @error('display_price')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror

                <label class="form-control-label">Discount Price</label>
                <input class="form-control @error('display_discount_price') is-invalid @enderror" id="display_discount_price" name="display_discount_price" type="text" placeholder="{{ $title }} Max" value="{{ old('display_discount_price') }}">
                @error('display_discount_price')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
              </div>

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

            <div class="text-center">
              <img src="" id="update_image" width="200" height="200" class="rounded-lg p-2"/>
            </div>
            <div class="form-group mt-3">
              <div class="custom-file">
                <input type="file" class="populate custom-file-input" name="image" accept=".png, .jpg, .jpeg, .svg"
                       id="customFileLang" lang="en">
                <label class="custom-file-label" for="customFileLang">{{__('Select file')}}</label>
              </div>
              @error('image')
              <span class="custom_error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-control-label">Name<span class="text-danger">&nbsp;*</span></label>
              <input class="populate form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="{{ $title }} Name" required value="{{ old('name') }}">
              @error('name')
              <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
              @enderror

              <label class="form-control-label">Description<span class="text-danger">&nbsp;*</span></label>
              <input class="populate form-control @error('description') is-invalid @enderror" name="description" type="text" placeholder="{{ $title }} Description" required value="{{ old('description') }}">
              @error('description')
              <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
              @enderror


              <input type="checkbox" id="update_has_size" name="update_has_size">
              <label for="update_has_size">Has Size</label>

              <script type="application/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                  let hasSizeCheckbox = document.getElementById('update_has_size');

                  hasSizeCheckbox.addEventListener('change', function(event)
                  {
                    if (event.target.checked) {
                      document.getElementById("update_prices").style.display = "none";
                      document.getElementById("update_display_price").value = "";
                      document.getElementById("update_display_discount_price").value = "";
                    }
                    else {
                      document.getElementById("update_prices").style.display = "block";
                    }
                  });
                }, false);
              </script>

              <div id="update_prices">
                <label class="form-control-label">Price</label>
                <input class="populate form-control @error('display_price') is-invalid @enderror" id="update_display_price" name="display_price" type="text" placeholder="{{ $title }} Price" value="{{ old('display_price') }}">
                @error('display_price')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror

                <label class="form-control-label">Discount Price</label>
                <input class="populate form-control @error('display_discount_price') is-invalid @enderror" id="update_display_discount_price" name="display_discount_price" type="text" placeholder="{{ $title }} Max" value="{{ old('display_discount_price') }}">
                @error('display_discount_price')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
              </div>

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
