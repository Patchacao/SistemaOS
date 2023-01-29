@extends('layouts.index')

@section('title', 'SistemaOS - Cadastrar OS')

@section('content')

    <div class="container-fluid">
        <div class="d-flex">
            <div class="col-4">
                <h3>Ordem de Serviço</h3>
            </div>
            <div class="col-4">
                <input type="search" name="searchOS" id="searchOS"
                placeholder="Escaneie o código da OS" class="form-control me-2 m-auto">
             </div>
              
                <button  class="btn btn-success btn-lg" 
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasSelectCustomer">Cadastrar OS</button>
            
               
        </div>
            <hr class="border border-primary border-3 opacity-75">
            <div class="w-70 d-flex justify-content-center h-100"></div> 
               
        <div class="container mb-3 py-3">
            <div class="container-customer-infos">
                <h5>Informações do Cliente</h5>
                <form action="">
                    <div class="row mb-0 g-1">
                        <div class="col-sm-3">
                            <div class="form-floating mb-1">
                                <input type="name" class="form-control" id="nameInput" placeholder="Primeiro Nome" disabled>
                                <label for="floatingInput">Primeiro Nome</label>
                            </div>
                            
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="name" class="form-control" id="last-nameInput" placeholder="Sobrenome" disabled>
                                <label for="floatingInput">Sobrenome</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating mb-1">
                                <input type="name" class="form-control" id="phone-numberInput" placeholder="Sobrenome" disabled>
                                <label for="floatingInput">Telefone</label>
                            </div>
                        </div>
                    </div>

                    
                </form>
            </div>
            <div class="container-service-info">
                <div class="row">
                    <div class="col-5">
                        <h5>Ordens de Serviço Individuais</h5>
                    </div>
                    <div class="col-7">
                        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Adicionar Ordem de Serviço
                            Individual </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----===== Offcanvas Select Client ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSelectCustomer" aria-labelledby="offcanvasSelectCustomer">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Selecione o Cliente
                <a class="add-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCustomer">
                    <i class='bx bx-plus-circle'></i>
                </a>
            </h5>
            <button type="button" id="SelectClientOffcanvas" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      
        <div class="offcanvas-body">
            <div class="container">
                <span>Pesquise pelo Nome:</span>
                <input type="search" name="searchClient" id="searchClient"
                placeholder="Digite para pesquisar" class="form-control"
                style="text-transform:capitalize">

                <table class="table table-hover">
                    <tbody id="searchContent">
                    </tbody>
                </table>
                <span id="noClientFound"></span>
                <button id="createClienteBtn" class="btn btn-success btn-lg" style="display: none;"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasCustomer">Cadastrar Novo Cliente</button>
                <div class="paginacao">
                  
                </div>
            </div>
        </div>
    </div>

    <!----===== Offcanvas Create Client ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCustomer" aria-labelledby="offcanvasCustomer">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Dados do Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      
    <span id="success_message"></span>

    <div class="offcanvas-body">
            
            <form id="createClienteForm"action="/clients/create" method="post">
                @csrf
                <div class="row-cols-auto">
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Telefone*</label>
                        <input type="tel" class="form-control" name="phone_number" id="phone_number" required placeholder="(00) 00000-0000">
                        <span id="phoneSearchIcon"></span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="whatsapp" id="whatsapp" checked>
                            <label class="form-check-label" for="flexCheckDefault">
                            Whatsapp
                            </label>
                        </div>
                    </div>
                        <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Nome*</label>
                        <input type="name" class="form-control" name="name" id="name" required 
                        oninput="toUpperCase(this)" placeholder="Primeiro Nome">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Sobrenome*</label>
                        <input type="name" class="form-control" name="last_name" id="last_name" required 
                        oninput="toUpperCase(this)" placeholder="Sobrenome">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Apelido</label>
                        <input type="name" class="form-control" name="nickname" id="nickname" 
                        oninput="toUpperCase(this)" placeholder="Apelido">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">CPF</label>
                        <input type="string" class="form-control" name="cpf" id="cpf" placeholder="Número do CPF">
                    </div>
                
                    <input type="submit" class="btn btn-primary add_client" value="Salvar" >
                </div>
            </form> 
            
        </div>
    </div>

    <div class="toast bg-success text-white fade" id="createClientToast" 
    style="position: absolute; top: 10px; right: 10px;">
        <div class="d-flex">
            <div class="toast-body">
            Cliente cadastrado com sucesso!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" 
            data-bs-dismiss="toast"
            ></button>
        </div>
    </div>
    <!----===== Offcanvas Create Client ===== 
    <div class="toast" id="createClientToast" 
    style="position: absolute; top: 10px; right: 10px;" aria-live="assertive" aria-atomic="true">
        <div class="d-flex text-bg-success border-0">
          <div class="toast-body">
            Cliente salvo com sucesso!
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
-->
    <!----===== Offcanvas Select item ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Selecione o item:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row-cols-auto">


                <div class="card-inner p-3 d-flex flex-column align-items-center" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasObjects">
                    
                    <div class="text-center mg-text"> <span class="mg-text">Leiteira</span> </div>
                </div>
                <div class="card-inner p-3 d-flex flex-column align-items-center">
                    <div class="text-center mg-text"> <span class="mg-text">Caçarola</span> </div>
                </div>
                <div class="card-inner p-3 d-flex flex-column align-items-center">
                    <div class="text-center mg-text"> <span class="mg-text">Panela de Pressão</span> </div>
                </div>
            </div>
        </div>
    </div>

    <!----===== Offcanvas linked objects ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasObjects" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title" id="offcanvasExampleLabel">Existem Objetos vinculados?</h6>
            <button type="button" class="btn btn-success" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRepair">Não</button>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row-cols-auto">

                <div class="form-floating mb-1">
                    <input type="text" class="form-control" id="object-barcode" placeholder="Código do Objeto">
                    <label for="floatingInput">Código do Objeto</label>
                </div>
                <select class="form-select mb-1" id="object" aria-label="Default select example">
                    <option selected>Selecione o Objeto</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                  <div class="d-grid gap-2">
                    <button type="button" class="btn btn-success"> Cadastrar Objeto</button>
                </div>
            </div>
        </div>
    </div>

    <!----===== Offcanvas Select Repair ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRepair" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title" id="offcanvasExampleLabel">Ordem de serviço Individual</h6>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row-cols-auto">

                <div class="form-floating mb-1">
                    <input type="name" class="form-control" id="first-name" placeholder="Código do Objeto">
                    <label for="floatingInput">Código do Objeto</label>
                </div>
                <div class="form-floating mb-1">
                    <input type="name" class="form-control" id="first-name" placeholder="Código do Objeto">
                    <label for="floatingInput">Tipo do Objeto</label>
                </div>
                
                  <div class="d-grid gap-2">
                    <button type="button" class="btn btn-success"> Cadastrar Objeto</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
   
    @endsection
