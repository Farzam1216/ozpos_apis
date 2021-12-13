<div class="modal-header head" style="  background:url('{{ $Menu->image }}') no-repeat center/cover">
    <div style="position: relative; z-index: 1;">
        <h1 class="modal-title text-white" id="dish-name">{{ $Menu->name }}</h1>
        <p id="dish-desc" class="text-white">{{ $Menu->description }}</p>
    </div>
    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        X
    </button>
</div>
<div class="modal-body" style="background: white;padding: 0rem !important;">
    <div class="child-options"></div>
    <div class="modal-footer">
        @if ($Menu->MenuSize()->get()->count() !== 0)
            <span class="float-right">
                <button class="btn btn-outline-secondary btn-sm"
                    onclick="MenuSize('{{ $SingleMenu->id }}','{{ $rest->id }}')">Edit</button>
            </span>
        @elseif($Menu->MenuAddon()->get()->count() !== 0)
            <span class="float-right">
                <button class="btn btn-outline-secondary btn-sm"
                    onclick="MenuAddon('{{ $SingleMenu->id }}','{{ $rest->id }}')">Edit</button>
            </span>
        @else
            <span class="float-right">
                <button class="btn btn-primary btn-sm add-cart-btn" data-vendor="{{ $rest->id }}"
                    data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}"
                    data-summary="{ 'category':'SINGLE', 'menu': [ { 'id':{{ $Menu->id }}, 'name':'{{ ucwords($Menu->name) }}', 'price':'{{ $Menu->price }}', 'addons':[] } ], 'size': null, 'total_price': '{{ $Menu->price }}' }"
                    data-price="{{ $Menu->price }}" data-quantity="1" data-image="{{ $Menu->image }}">Add</button>

            </span>
        @endif
    </div>
</div>

<style>
    .modal-header.head {
        display: grid;
        /* flex-direction: column; */
        place-items: center;
        /* justify-content: flex-end; */
        min-height: 50vh;
        line-height: 1.6;
        border-radius: 13px 13px 0 0;
        background: #00000087;
        /* padding: 85px; */
    }

    div#ItemMenus {

        left: 18rem;
        top: 5rem;
        position: fixed;
        align-content: center;
        justify-content: center;
        max-width: 100ch;

    }

    .modal {
        position: fixed !important;

    }

    div#ItemMenu {
        height: auto !important;
        background-color: transparent !important;
        min-height: -webkit-fill-available;
        max-height: -webkit-fill-available;
    }

    *,
    :after,
    :before {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-shadow: 1px 1px 1px rgb(0 0 0 / 4%);
    }

    .modal button.close {
        position: absolute;
        top: 1.5rem;
        right: 1.875rem;
        border: none;
        border-radius: 50px;
        background-color: transparent;
    }

    h1#dish-name {
        font-weight: 400;
        font-family: Poppins, sans-serif;
        line-height: 1.5;
        margin-top: 330px;
        background: #0000008a;
        padding: 6px;
        border-radius: 4px;
    }

    button.close.btn {
        padding: 6px;
        background: red;
        border-radius: 8px;
        border: 1px solid darkred;
        color: white;
    }

    #dish-desc {
        margin-bottom: 0;
        /* color: #838f9b; */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        background: #0000008a;
        padding: 6px;
        border-radius: 4px;
    }

    @media (max-width: 600px) {
        div#ItemMenus {
            left: 1rem;
            top: 5rem;
            position: fixed;
            align-content: center;
            justify-content: center;
            max-width: 60ch;
        }
    }


    @media screen and (min-width: 600px) and (max-width: 768px) {
        div#ItemMenus {
            left: 2.5rem;
            top: 5rem;
            position: fixed;
            align-content: center;
            justify-content: center;
            max-width: 75ch;
        }
    }

    @media screen and (min-width: 768px) and (max-width: 1024px) {
        div#ItemMenus {
            left: 4.5rem;
            top: 5rem;
            position: fixed;
            align-content: center;
            justify-content: center;
            max-width: 85ch;
        }
    }

    @media screen and (min-width: 1024px) {
        div#ItemMenus {
            left: 18rem;
            top: 3rem;
            position: fixed;
            align-content: center;
            justify-content: center;
            max-width: 104ch;
        }
    }

</style>
