{{-- @section('custom_modals') --}}{{-- <div class="modal fade" id="HalfMenuAddon-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }}" tabindex="-1" role="dialog" aria-labelledby="HalfMenuAddonModal-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }}" aria-hidden="true" style="z-index: 1060">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content"> --}}
<script>console.log("{{ $prefix }}");</script>
<div class="modal-header">
   <h5 class="modal-title">{{ ucwords($Menu->name) }}</h5>
   <button type="button" class="close" onclick="$('#halfMenuAddons').modal('hide')" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <div class="container">
      <form>
         <div class="recepie-body">
            @foreach($MenuSize->GroupMenuAddon()->groupBy('addon_category_id')->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
               <h6 class="font-weight-bold mt-4">
                  {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                  <span class="text-muted"> ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}) </span>
               </h6>
               
               @foreach($MenuSize->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                  @php
                     if($MenuAddon->price != 0) $MenuAddon->price = $MenuAddon->price / 2;
                  @endphp
                  <div class="custom-control custom-radio border-bottom py-2">
                     <input type="checkbox" id="HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }}-{{ $GroupMenuAddon->id }}-{{$MenuAddon->id}}" name="" class="custom-control-input HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }} HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }}-{{ $GroupMenuAddon->id }}" data-group_menu_addon_id="{{ $GroupMenuAddon->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                     <label class="custom-control-label" for="HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }}-{{ $GroupMenuAddon->id }}-{{$MenuAddon->id}}">
                        {{ $MenuAddon->Addon()->get()->first()->name }}
                        <span class="text-muted"> +{{ $MenuAddon->price }} {{ App\Models\GeneralSetting::first()->currency }}
                        </span> </label>
                  </div>
               @endforeach
            @endforeach
         </div>
      </form>
   </div>
</div>
<div class="modal-footer p-0 border-0">
   <div class="col-12 m-0 p-0">
      <button onclick="$('#halfMenuAddons').modal('hide')" id="HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }}" type="button" class="btn btn-primary btn-lg btn-block">
         Pick
      </button>
   </div>
</div>{{-- </div>
      </div>
   </div>
@append --}}
