<div>
   @foreach($MenuCategory->DealsMenu()->get() as $DealsMenuIDX=>$DealsMenu)
      <div class="p-3 border-bottom menu-list">
         <span class="float-right">
            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#DealsMenu-{{ $DealsMenu->id }}">Edit</button>
         </span>
   
         @include('customer.restaurant.deals.modals.index')
         
         <div class="media">
            <img src="{{ $DealsMenu->image }}" alt="" class="mr-3 rounded-pill ">
            <div class="media-body">
               <h6 class="mb-1">{{ ucwords($DealsMenu->name) }}
                  <span class="badge badge-danger">Customizable Deals</span>
               </h6>
               @if($DealsMenu->price !== NULL)
                  @if($DealsMenu->display_discount_price === NULL)
                     <p class="text-muted mb-0">
                        {{ $DealsMenu->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                     </p>
                  @else
                     <p class="text-muted mb-0">
                        <span class="text-decoration-overline">
                           {{ $DealsMenu->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                        </span>
                        &ensp;
                        {{ $DealsMenu->display_discount_price }} {{ App\Models\GeneralSetting::first()->currency }}
                     </p>
                  @endif
               @endif
            </div>
         </div>
      </div>
   @endforeach
</div>