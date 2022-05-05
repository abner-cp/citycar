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



<a href="{{ url('marca/create') }}" class="btn btn-success" > Registrar Una Marca</a> <!--enlace a create -->
<br>
<br>

<table class="table table-dark">

    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach ( $marcas as $marca )
        <tr>
            <td>{{ $marca->id }}</td>
            <td>{{ $marca->Nombre }}</td>
            <td>
                <a href="{{ url('/marca/'.$marca->id.'/edit') }}" class="btn btn-warning"> <!-- redirige un link hacia el formulario editar con el id -->
                    Editar 
                </a>
                
                | 
                
                <form action="{{ url('/marca/'.$marca->id) }}" method="post" class="d-inline"> <!-- adjunta la id en la url -->
                 @csrf
                 {{ method_field('DELETE') }}  <!-- modifica el post por el delete -->
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Deseas borrar?')" value="Borrar">
                </form>
        
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $marcas->links() !!} <!-- pagina los resultados de la tabla -->
</div>

@endsection