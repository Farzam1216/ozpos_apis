<div class="modal-header head" style=" background: url('{{ $HalfNHalfMenu->image }}') no-repeat center/cover">
    <div style="position: relative; z-index: 1;">
        <h1 class="modal-title text-white" id="dish-name">{{ $HalfNHalfMenu->name }}</h1>
        <p id="dish-desc" class="text-white">{{ $HalfNHalfMenu->description }}</p>
    </div>
    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        X
    </button>
</div>
<div class="modal-body">
  <span class="float-right">
    <button class="btn btn-outline-secondary btn-sm"
        onclick="HalfNHalfMenu('{{ $HalfNHalfMenu->id }}','{{ $rest->id }}')">Edit</button>
</span>
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

  }


  div#halfNHalfMenuModals {
        left: 18rem;
        top: 5rem;
        position: fixed;
        align-content: center;
        justify-content: center;
        max-width: 100ch;

  }

  div#halfNHalfMenuModal {
      height: auto !important;
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
  }

  button.close.btn {
      padding: 6px;
      background: red;
      border-radius: 8px;
      border: 1px solid darkred;
      color: white;
  }

</style>
