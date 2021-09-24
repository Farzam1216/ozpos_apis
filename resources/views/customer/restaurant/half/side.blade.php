<div id="Half-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}" class="tab-pane fade @if($prefix=='First') show in active @endif ">
   @foreach($HalfNHalfMenu->ItemCategory()->get()->first()->SingleMenuItemCategory()->get() as $SingleMenuItemCategoryIDX=>$SingleMenuItemCategory)
      
      @php
         $SingleMenu = $SingleMenuItemCategory->SingleMenu()->get()->first();
         $Menu = $SingleMenu->Menu()->get()->first();
         $MenuSize = $Menu->MenuSize()->where('item_size_id', $ItemSize->id )->get()->first();
         $Menu = App\Models\Menu::where('id', $MenuSize->menu_id )->get()->first();
         
         if($MenuSize->price != 0) $MenuSize->price = $MenuSize->price / 2;
      @endphp
   
      @section('postScript')
         <script type="text/javascript">
            $("#HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}").click(function () {
               var button = $("#CartAddHalf{{ $HalfNHalfMenu->id }}");
               var data = JSON.parse(JSON.stringify(button.data('summary')));

               if (data.Size.ID != {{ $ItemSize->id }}) {
                  data.MenuFirst = null;
                  data.MenuSecond = null;
                  data.Size.ID = {{ $ItemSize->id }};
                  data.Size.Name = "{{ $ItemSize->name }}";
                  button.data('summary', data);

                  var dataID = "2-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}";
                  button.data('id', dataID);
               }

               data["Menu{{$prefix}}"] = {};
               data["Menu{{$prefix}}"].ID = "{{ $Menu->id }}";
               data["Menu{{$prefix}}"].DataID = "{{ $Menu->id }}";
               data["Menu{{$prefix}}"].Name = "{{ ucwords($Menu->name) }}";
               data["Menu{{$prefix}}"].Price = {{ $MenuSize->price }};
               data["Menu{{$prefix}}"].TotalPrice = {{ $MenuSize->price }};
               data["Menu{{$prefix}}"].Addons = [];

               $('.HalfMenuSize-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}:checked').each(function (i, obj) {
                  data["Menu{{$prefix}}"].Addons.push({
                     "ID": $(this).data('id'),
                     "Name": $(this).data('name'),
                     "Price": $(this).data('price')
                  });
                  data["Menu{{$prefix}}"].TotalPrice += $(this).data('price');
                  data["Menu{{$prefix}}"].DataID += "-"+$(this).data('id');
               });

               button.data('summary', data);

               @if($prefix == 'First')
                  if (data.MenuSecond == null)
                  {
                     button.data('price', data.MenuFirst.TotalPrice);
                     button.data('id', "2-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}_"+data["Menu{{$prefix}}"].DataID+"_");
                  }
               @elseif($prefix == 'Second')
                  if (data.MenuFirst == null)
                  {
                     button.data('price', data.MenuFirst.TotalPrice);
                     button.data('id', "2-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}__"+data["Menu{{$prefix}}"].DataID);
                  }
               @endif
               
               if (data.MenuFirst != null && data.MenuSecond != null)
               {
                  button.data('price', data.MenuFirst.TotalPrice + data.MenuSecond.TotalPrice);
                  button.data('id', "2-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}_"+data.MenuFirst.DataID+"_"+data.MenuSecond.DataID);
               }
               
               console.log(button.data());
               console.log();
            });
         </script>
      @append
      
      <div>
         <div class="p-3 border-bottom menu-list">
            
            <span class="float-right">
               <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#HalfAddon-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}">ADD</button>
            </span>
            
            @section('custom_modals')
               <div class="modal fade" id="HalfAddon-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}" tabindex="-1" role="dialog" aria-labelledby="HalfAddonModal-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}" aria-hidden="true" style="z-index: 1060">
                  <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Extras</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <div class="container">
                              <form>
                                 <div class="recepie-body">
                                    @foreach($MenuSize->GroupMenuAddon()->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
                                       <h6 class="font-weight-bold mt-4">
                                          {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                          <span class="text-muted"> ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}) </span>
                                       </h6>
                                       
                                       @foreach($MenuSize->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                          @php
                                             if($MenuAddon->price != 0) $MenuAddon->price = $MenuAddon->price / 2;
                                          @endphp
                                          <div class="custom-control custom-radio border-bottom py-2">
                                             <input type="checkbox" id="HalfCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}-{{ $MenuAddon->id }}" name="" class="custom-control-input HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }} HalfMenuSize-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                             <label class="custom-control-label" for="HalfCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}-{{$MenuAddon->id}}">
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
                              <button id="HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}" type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">
                                 Apply
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            @append
            
            <div class="media">
               <img src="{{ $Menu->image }}" alt="askbootstrap" class="mr-3 rounded-pill ">
               <div class="media-body">
                  <h6 class="mb-1">{{ ucwords($Menu->name) }}
                     @if($Menu->price == NULL)
                        <span class="badge badge-danger">Customizable</span>
                     @endif
                  </h6>
                  @if($Menu->price != NULL)
                     <p class="text-muted mb-0">{{ $Menu->price }} {{ App\Models\GeneralSetting::first()->currency }}</p>
                  @endif
               </div>
            </div>
         </div>
      </div>
   @endforeach
</div>