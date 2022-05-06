@extends('layouts.app')  <!-- Layout principal-->
@section('content')      <!-- contenido de vista dentro de section-->

<div class="container">


    @if(Session::has('mensaje')) <!-- si existe un mensaje desde el controlado, entonces lo muestra--->
     <div class="alert alert-success alert-dismissible" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <!-- para poder cerrar el msj de exito en la vista-->
        <span aria-hidden="true">&times;</span>
        </button>
     </div>
    @endif      



<a href="{{ url('vehiculo/create') }}" class="btn btn-success" > Registrar Un Vehículo</a> <!--enlace a create -->
<br>
<br>

<table class="table table-dark">

    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Año</th>
            <th>Version</th>
            <th>Cilindraje</th>
            <th>Rendimiento</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach ( $vehiculos as $vehiculo )
        <tr>
            <td>{{ $vehiculo->id }}</td>

            <td>
               <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$vehiculo->Foto }}" width="100" alt="">
            </td>

            <td>{{ $vehiculo->Modelo }}</td>
            <td>{{ $vehiculo->marca->Nombre }}</td>
            <td>{{ $vehiculo->Anyio }}</td>
            <td>{{ $vehiculo->Version }}</td>
            <td>{{ $vehiculo->Cilindraje }}</td>
            <td>{{ $vehiculo->Rendimiento }}</td>
            <td>
                <a href="{{ url('/vehiculo/'.$vehiculo->id.'/edit') }}" class="btn btn-warning"> <!-- redirige un link hacia el formulario editar con el id -->
                    Editar 
                </a>
                
                | 
                
                <form action="{{ url('/vehiculo/'.$vehiculo->id) }}" method="post" class="d-inline"> <!-- adjunta la id en la url -->
                 @csrf
                 {{ method_field('DELETE') }}  <!-- modifica el post por el delete -->
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Deseas borrar?')" value="Borrar">
                </form>
                    
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $vehiculos->links() !!} <!-- pagina los resultados de la tabla -->
</div>

@endsection