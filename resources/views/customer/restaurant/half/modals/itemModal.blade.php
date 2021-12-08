<div class="modal-header" style="display: flex; flex-direction: column; justify-content: flex-end;
  min-height: 300px; background: url('{{ $Menu->image }}') no-repeat center/cover">
    <div style="position: relative; z-index: 1;">
        <h1 class="modal-title text-white" id="dish-name">{{ $Menu->name }}</h1>
        <p id="dish-desc" class="text-white">{{ $Menu->description }}</p>
    </div>
    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
      X
    </button>
</div>
<div class="modal-body">
    <div class="child-options"></div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="btn btn-primary ">Add to Cart</a>
    </div>
</div>
