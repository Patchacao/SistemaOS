<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="selectItem">Selecione o Item:</h1>
          <h1 class="modal-title fs-5" id="selectRepair" hidden>Selecione o Reparo:</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row-cols-auto" id="itens_list"></div>
                <div id="repairList">
                    <table class="table table-hover">
                        <tbody id="RepairContent"></tbody>
                    </table>
                </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
          <button type="button" class="btn btn-primary" id="btnSaveServices">Adicionar</button>
        </div>
      </div>
    </div>
  </div>