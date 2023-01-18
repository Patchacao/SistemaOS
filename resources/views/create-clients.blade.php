@extends('layouts.index')

@section('title', 'SistemaOS - Cadastrar OS')

@section('content')

@if ($errors->any())
    
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
    
@endif

<form action="/clients/create" method="post">
    @csrf
    <div class="container-fluid">
        <div class="row mb-0 g-1">
            <div class="col-4">
                <h3>Cadastrar Cliente</h3>
            </div> 
        </div>
            <hr class="border border-primary border-3 opacity-75">
            <div class="w-70 d-flex justify-content-center h-100"></div> 

            <div class="row mb-1 g-1">
                <div class="col-4">
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Telefone*</label>
                        <input type="phonenumber" class="form-control" name="phone_number" placeholder="Pesquisar Número do Telefone">
                    </div>
                </div> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0"  name="whatsapp" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                        Whatsapp
                        </label>
                    </div>   
                    
               
            </div>    

            
            <div class="row mb-1 g-1">
                <div class="col-4">
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Nome*</label>
                        <input type="name" class="form-control" name="name" placeholder="Primeiro Nome">
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Apelido</label>
                        <input type="name" class="form-control" name="nickname" placeholder="Apelido">
                    </div>
                </div> 
                <div class="col-4">       
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">Sobrenome*</label>
                        <input type="name" class="form-control" name="last_name" placeholder="Sobrenome">
                    </div> 
                    <div class="mb-1">
                        <label for="exampleFormControlInput1" class="form-label">CPF</label>
                        <input type="string" class="form-control" name="cpf" placeholder="Número do CPF">
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Salvar">
    </div>
</form>          
            @endsection    

        