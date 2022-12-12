 @extends('layouts.index')

@section('title','SistemaOS - Ordens de serviço')

@section('content')

<div>
    <h3>Ordens de Serviço</h3>
    <hr class="border border-primary border-3 opacity-75">
</div>

<table class="table">
    <thead>
      <tr class="table-primary">
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>
@endsection