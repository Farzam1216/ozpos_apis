
            <div class="modal-header">
               <h5 class="modal-title">{{ ucwords($Menu->name) }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                              <div class="custom-control custom-radio border-bottom py-2">
                                 <input type="checkbox" id="DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}" name="" class="custom-control-input DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }} DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-{{ $GroupMenuAddon->id }}" data-group_menu_addon_id="{{ $GroupMenuAddon->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                 <label class="custom-control-label" for="DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}">
                                    {{ $MenuAddon->Addon()->get()->first()->name }}
                                    <span class="text-muted"> +{{ $MenuAddon->price }} {{ App\Models\GeneralSetting::first()->currency }}
                                    </span>
                                  </label>
                              </div>
                              <script type="text/javascript">
                                $(".DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}").change(function () {
                                   let groupMenuAddonId = $(this).data('group_menu_addon_id');
                                   let checkedCheckBox = $('.DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}-'+groupMenuAddonId+':checked');
                                   let checked = checkedCheckBox.length;
                                   let maxAllowed = $(this).data('max');

                                   if (maxAllowed == 1) {
                                      checkedCheckBox.each(function (i, obj) {
                                         $(this).prop('checked', false);
                                      });
                                      $(this).prop('checked', true);
                                   }
                                   else if (checked > maxAllowed) {
                                      $(this).prop('checked', false);
                                      return;
                                   }
                                });
                             </script>
                           @endforeach
                        @endforeach
                     </div>
                  </form>
               </div>
            </div>
            <div class="modal-footer p-0 border-0">
               <div class="col-6 m-0 p-0">
                  <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">
                     Close
                  </button>
               </div>
               <div class="col-6 m-0 p-0">
                  <button data-dismiss="modal" id="DealsMenuAddon-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}" type="button" class="btn btn-primary btn-lg btn-block DealsMenuPick-{{$DealsMenu->id}}" data-deals="{{$DealsItems->id}}" data-menu="{{$Menu->id}}" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}">
                     Pick
                  </button>
                  @section('postScript')
                     <script type="text/javascript">
                        $("#DealsMenuAddon-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}").click(function () {
                           $('#DealsMenuItems-{{ $DealsMenu->id }}-{{ $DealsItems->id }}').modal('hide');
                        });
                     </script>
                  @append
               </div>
            </div>
