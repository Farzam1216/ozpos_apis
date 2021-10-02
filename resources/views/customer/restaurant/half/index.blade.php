<div>
   @foreach($MenuCategory->HalfNHalfMenu()->get() as $HalfNHalfMenuIDX=>$HalfNHalfMenu)
      <div class="p-3 border-bottom menu-list">
         <span class="float-right">
            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#HalfMenu-{{ $HalfNHalfMenu->id }}">Edit</button>
         </span>
         
         @include('customer.restaurant.half.modals.index')
         
         <div class="media">
            <img src="{{ $HalfNHalfMenu->image }}" alt="" class="mr-3 rounded-pill ">
            <div class="media-body">
               <h6 class="mb-1">{{ ucwords($HalfNHalfMenu->name) }}
                  <span class="badge badge-danger">Customizable</span>
               </h6>
            </div>
         </div>
      </div>
   @endforeach
</div>