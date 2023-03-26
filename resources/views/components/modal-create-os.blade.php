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
          <div class="container-fluid"> 
            <div class="row">
              <div class="col-sm-2">
              <button type="button" class="btn btn-secondary" id="returnBtn" style="display: none;">Voltar</button>
              </div>
              <div class="col-sm-2">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
              </div>
              <div class="col-sm-3">
              <button type="button" class="btn btn-primary" id="btnSaveServices">Adicionar</button>
              </div>
              <div class="col-sm-5">
              <div class="form-floating mb-1">
                <input type="name" class="form-control" id="total_price" disabled>
                  <label for="floatingInput">Valor Total</label>
              </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>