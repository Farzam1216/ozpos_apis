<div>
   @foreach($MenuCategory->SingleMenu()->get() as $SingleMenuIDX=>$SingleMenu)
      @php
         /** @var mixed $SingleMenu */
         $Menu = $SingleMenu->Menu()->get()->first();
      @endphp
      <div class="p-3 border-bottom menu-list">
         @if($Menu->MenuSize()->get()->count() !== 0)
            <span class="float-right">
               <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#SingleMenu-{{ $SingleMenu->id }}">Edit</button>
            </span>
            @include('customer.restaurant.single.modals.sizes')
         @elseif($Menu->MenuAddon()->get()->count() !== 0)
            <span class="float-right">
               <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#SingleMenu-{{ $SingleMenu->id }}">Edit</button>
            </span>
            @include('customer.restaurant.single.modals.addons')
         @else
            <span class="float-right">
               <button class="btn btn-primary btn-sm add-cart-btn" data-vendor="{{ $rest->id }}" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}" data-summary="summary 2" data-price="{{ $Menu->price }}" data-quantity="1" data-image="{{ $Menu->image }}">Add</button>
            </span>
         @endif
         <div class="media">
            <img src="{{ $Menu->image }}" alt="" class="mr-3 rounded-pill ">
            <div class="media-body">
               <h6 class="mb-1">{{ ucwords($Menu->name) }}
                  @if($Menu->price === NULL)
                     <span class="badge badge-danger">Customizable</span>
                  @endif
               </h6>
               @if($Menu->price !== NULL)
                  @if($Menu->display_discount_price === NULL)
                     <p class="text-muted mb-0">
                        {{ $Menu->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                     </p>
                  @else
                     <p class="text-muted mb-0">
                        <span class="text-decoration-overline">
                           {{ $Menu->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                        </span> &ensp;
                        {{ $Menu->display_discount_price }} {{ App\Models\GeneralSetting::first()->currency }}
                     </p>
                  @endif
               @endif
            </div>
         </div>
      </div>
   @endforeach
</div>
