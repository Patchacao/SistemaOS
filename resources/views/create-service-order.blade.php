@extends('layouts.index')

@section('title', 'SistemaOS - Cadastrar OS')

@section('content')

    <div class="container-fluid">
        <div class="d-flex">
            <div class="col-4">
                <h3>Ordem de Serviço</h3>
            </div>
            <div class="col-4">
                <input type="search" name="searchOS" id="searchOS" placeholder="Escaneie o código da OS"
                    class="form-control me-2 m-auto">
            </div>
            <button class="btn btn-success btn-lg" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSelectCustomer">Cadastrar OS</button>
        </div>
        <hr class="border border-primary border-3 opacity-75">
        <div class="w-70 d-flex justify-content-center h-100"></div>

        <div class="container mb-3 py-3">
            <div class="container-customer-infos">
                <h5>Informações do Cliente</h5>
                <form action="">
                    <div class="row mb-0 g-1">
                        <div class="col-sm-2">
                            <div class="form-floating mb-1">
                                <input type="string" class="form-control" id="nameInput" placeholder="Primeiro Nome"
                                    disabled>
                                <label for="floatingInput">Primeiro Nome</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating mb-1">
                                <input type="string" class="form-control" id="last-nameInput" placeholder="Sobrenome"
                                    disabled>
                                <label for="floatingInput">Sobrenome</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating mb-1">
                                <input type="string" class="form-control" id="NickNameInput" placeholder="Apelido"
                                    disabled>
                                <label for="floatingInput">Apelido</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating mb-1">
                                <input type="string" class="form-control phone_number" id="phone-numberInput"
                                    placeholder="Sobrenome" disabled>
                                <label for="floatingInput">Telefone</label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-floating mb-1">
                                <input type="string" class="form-control CPFInput" id="CPFInput" placeholder="CPF"
                                    disabled>
                                <label for="floatingInput">CPF</label>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="collapse"
                                data-bs-target="#CollapseClientMoreInfo">Mostrar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse" id="CollapseClientMoreInfo">
                                <div class="card card-body">
                                    <div class="container">
                                        <div class="row mb-0 g-1">
                                            <div class="col-6">
                                                <div class="form-floating mb-1">
                                                    <input type="string" class="form-control" id="street-Input" disabled>
                                                    <label for="floatingInput">Rua</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-floating mb-1">
                                                    <input type="string" class="form-control" id="adress-number-Input"
                                                        disabled>
                                                    <label for="floatingInput">Número</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-floating mb-1">
                                                    <input type="string" class="form-control cepInput" id="cep-Input"
                                                        disabled>
                                                    <label for="floatingInput">Cep</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-0 g-1">
                                            <div class="col-4">
                                                <div class="form-floating mb-1">
                                                    <input type="string" class="form-control" id="neighborhood-Input"
                                                        disabled>
                                                    <label for="floatingInput">Bairro</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-1">
                                                    <input type="string" class="form-control" id="city-Input" disabled>
                                                    <label for="floatingInput">Cidade</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-floating mb-1">
                                                    <input type="adress" class="form-control" id="state-Input" disabled>
                                                    <label for="floatingInput">Estado</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <div class="container-service-info mb-2">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>Ordens de Serviço Individuais</h5>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-floating mb-1">
                            <input type="string" class="form-control" id="OS_total_price" disabled>
                            <label for="floatingInput">Preço Total</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal"
                            data-bs-target="#CreateOsiModal" aria-controls="offcanvasSelectItem">+
                        </button>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="serviceList"></div>
        </div>
    </div>
    </div>

    <x-modal-create-os />

    <!----===== Offcanvas Select Client ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSelectCustomer" data-bs-backdrop="false"
        aria-labelledby="offcanvasSelectCustomer">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSelectCustomer">Selecione o Cliente
                <a class="add-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCustomer">
                    <i class='bx bx-plus-circle'></i>
                </a>
            </h5>
            <button type="button" id="SelectClientOffcanvas" class="btn-close" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="container">
                <span>Pesquise pelo Nome:</span>
                <input type="search" name="searchClient" id="searchClient" placeholder="Digite para pesquisar"
                    class="form-control" style="text-transform:capitalize">

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

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCustomer" data-bs-backdrop="false"
        aria-labelledby="offcanvasCustomer">
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
                        <input type="tel" class="form-control phone_number client-form" name="phone_number"
                            id="phone_number" required placeholder="(00) 00000-0000">
                        <span id="phoneSearchIcon"></span>
                        <div class="form-check">
                            <input class="form-check-input client-form" type="checkbox" value="1" name="whatsapp"
                                id="whatsapp" checked>
                            <label class="form-check-label" for="flexCheckDefault">
                                Whatsapp
                            </label>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Nome*</label>
                        <input type="name" class="form-control client-form" name="name" id="name" required
                            oninput="toUpperCase(this)" placeholder="Primeiro Nome">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Sobrenome*</label>
                        <input type="name" class="form-control client-form" name="last_name" id="last_name" required
                            oninput="toUpperCase(this)" placeholder="Sobrenome">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Apelido</label>
                        <input type="name" class="form-control client-form" name="nickname" id="nickname"
                            oninput="toUpperCase(this)" placeholder="Apelido">
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">CPF</label>
                        <input type="string" class="form-control CPFInput client-form" name="cpf" id="cpf"
                            placeholder="Número do CPF">
                    </div>

                    <input type="button" class="btn btn-primary" id="openCreateAdressOffCanvas" value="Próximo">
                    <button type="button" class="btn btn-primary edit_clientBtn" style="display: none;">Editar</button>
            </form>
        </div>
    </div>
    </div>
    </div>


    <!----===== Offcanvas Create Client Adress ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="false" id="offcanvasCustomerAdress"
        aria-labelledby="offcanvasCustomerAdressLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasCustomer" id="backToCreateClientsOffcanvas">Voltar</button>
            <h5 class="offcanvas-title" id="offcanvasCustomerAdressLabel">Endereço do Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <span id="success_message-Adress"></span>

        <div class="offcanvas-body">

            <form id="createClienteAdressForm"action="/clients/Adress-create" method="post">
                <div class="container" id="adress">
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Rua</label>
                        <input type="text" class="form-control client-form" name="street" id="street"
                            oninput="toUpperCase(this)" placeholder="Nome da Rua">
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <label for="exampleFormControlInput1" class="form-label">Número</label>
                            <input type="text" class="form-control client-form" name="adress-number"
                                id="adress-number" placeholder="Número">
                        </div>
                        <div class="col-7">
                            <label for="exampleFormControlInput1" class="form-label">CEP</label>
                            <input type="text" class="form-control cepInput client-form" name="cep"
                                id="cep" placeholder="CEP">
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Complemento</label>
                        <input type="text" class="form-control client-form" name="complement" id="complement"
                            oninput="toUpperCase(this)">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Bairro</label>
                        <input type="text" class="form-control client-form" name="neighborhood" id="neighborhood"
                            oninput="toUpperCase(this)" required>
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Cidade</label>
                        <select class="form-select client-form" aria-label="Default select example" name="city"
                            id="city" required>
                            <option selected>Lima Duarte</option>
                            <option value="1">Olaria</option>
                            <option value="2">Juiz de Fora</option>
                            <option value="3">Pedro Teixeira</option>
                            <option value="4">Bom Jardim de Minas</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Estado</label>
                        <select class="form-select client-form" aria-label="Default select example" id="state"
                            required>
                            <option selected>Minas Gerais</option>
                            <option value="1">Rio de Janeiro</option>
                            <option value="2">São Paulo</option>
                            <option value="3">Espirito Santo</option>

                        </select>
                    </div>
                </div>
                <input type="button" id="create_clientBtn" class="btn btn-primary add_client" value="Cadastrar">
                <input type="button" id="update_clientBtn" class="btn btn-primary add_client" style="display: none;"
                    value="Salvar">
            </form>
            <button type="button" class="btn btn-primary edit_clientBtn" style="display: none;">Editar</button>
            <button type="button" class="btn btn-primary" id="insertClientBtn"
                onclick="InsertClientInfo ()">Próximo</button>
        </div>
    </div>

    </div>
    </div>

    <!----===== Offcanvas linked objects ===== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasObjects" data-bs-backdrop="false"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title" id="offcanvasExampleLabel">Objetos vinculados</h6>
            <button type="button" class="btn btn-success" id="btnSaveLinkedObjects"
                data-bs-dismiss="offcanvas">Salvar</button>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row-cols-auto">

                <div class="d-grid mb-1">
                    <span class="mb-2">Código do Objeto</span>
                    <input type="search" id="searchLinkedObjectNumber" placeholder="Escaneie o código"
                        class="form-control">
                </div>
                <select class="form-select mb-1" id="LinkableObjectsList" placeholder="Selecione o Objeto1" hidden>
                </select>

                <div class="d-grid gap-2">
                    <button id="addLinkedObject" type="button" class="btn btn-success" hidden> Cadastrar Objeto</button>
                </div>
                <table class="table table-hover">
                    <tbody id="LinkedObjectTable">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal  Confirm Delete-->
    <div class="modal fade" id="ConfirmItemDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja excluir esse item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <button type="button" id="deleteItemConfirmationbtn" class="btn btn-danger">Excluir</button>
                </div>
            </div>
        </div>
    </div>


@endsection
