<a id="cart_btn_autoload" class="btn c-btn-cart" href="#0" data-toggle="modal" data-target="#cart_modal" role="button" @if(Cart::content()->isEmpty()) style="display:none;" @endif>
    <div id="cart_btn_count">
        <span  id="cart_btn_counter" class="badge ms-2 c-icon-cart">{{Cart::count()}}</span> <i class="icon_cart"></i>
    </div>
</a>
