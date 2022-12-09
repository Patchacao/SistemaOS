@extends('layouts.main')  

@section('title','SistemaOS - Início')

@section('content')
    

    

    <h1> teste css</h1>            
                @can('user_POS')

                @include('layouts.home-custom.home-userPOS')
              
                @elsecan('admin')
                    
                @include('layouts.home-custom.home-admin')

                @elsecan('user_WorkStation')

                <h1>home mecanico</h1>
                    
                @endcan
                
@endsection              
                
 