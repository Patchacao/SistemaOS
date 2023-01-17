@extends('layouts.index')

@section('title', 'SistemaOS - Cadastrar OS')

@section('content')

    <div class="container-fluid">
        <div class="row mb-0 g-1">
            <div class="col-4">
                <h3>Ordem de Serviço</h3>
            </div>
        
            <div class="col-2">
                <a class="add-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCustomer">
                    <i class='bx bx-plus-circle'></i>
                </a>
            </div>  
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
                                <input type="name" class="form-control" id="first-name" placeholder="Primeiro Nome" disabled>
                                <label for="floatingInput">Primeiro Nome</label>
                            </div>
                            
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="name" class="form-control" id="last-name" placeholder="Sobrenome" disabled>
                                <label for="floatingInput">Sobrenome</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating mb-1">
                                <input type="name" class="form-control" id="last-name" placeholder="Sobrenome" disabled>
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

    <!----===== Offcanvas Select Customer ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCustomer" aria-labelledby="offcanvasCustomer">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Dados do Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
            <div class="row">
                <div class="col-4">
                    <a class="add-icon" data-bs-toggle="#" data-bs-target="#">
                        <i class='bx bx-search'></i>
                        <span class="mg-text">Pesquisar</span>
                    </a>
                </div>

                <div class="col-4">
                    <a class="add-icon" data-bs-toggle="#" data-bs-target="#">
                        <i class='bx bx-save'></i>
                        <span class="mg-text">Salvar</span>
                    </a>
                </div>
            </div>
        <div class="offcanvas-body">
            
                <div class="row-cols-auto">
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Telefone*</label>
                        <input type="phonenumber" class="form-control" id="cellphone" placeholder="Número do Telefone">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="whatsapp">
                            <label class="form-check-label" for="flexCheckDefault">
                            Whatsapp
                            </label>
                        </div>
                    </div>
                        <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Nome*</label>
                        <input type="name" class="form-control" id="name" placeholder="Primeiro Nome">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Sobrenome*</label>
                        <input type="name" class="form-control" id="last_name" placeholder="Sobrenome">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Apelido</label>
                        <input type="name" class="form-control" id="nickname" placeholder="Apelido">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">CPF</label>
                        <input type="string" class="form-control" id="cpf" placeholder="Número do CPF">
                    </div>
                
                    <button onclick="customer.salvarCliente()" type="submit" class="btn btn-success btn-lg" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Próximo
                    </button>
                </div>
            
        </div>
    </div>

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

    <script src="/build/assets/createSO.js"></script>
@endsection
