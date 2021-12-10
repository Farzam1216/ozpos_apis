<div class="modal-header" style="display: flex; flex-direction: column; justify-content: flex-end;
  min-height: 300px; background: url('{{ $dealsMenu->image }}') no-repeat center/cover">
    <div style="position: relative; z-index: 1;">
        <h1 class="modal-title text-white" id="dish-name">{{ $dealsMenu->name }}</h1>
        <p id="dish-desc" class="text-white">{{ $dealsMenu->description }}</p>
    </div>
    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        X
    </button>
</div>
<div class="modal-body">
  <span class="float-right">
    <button class="btn btn-outline-secondary btn-sm"
      onclick="DealsMenu('{{ $dealsMenu->id }}','{{ $rest->id }}')">Edit</button>
 </span>
</div>

<style>
  div#dealMenuModal {
      width: 620px;
      left: 390px;
      top: 100px;

  }

  div#dealMenusModal {
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
