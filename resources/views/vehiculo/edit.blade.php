@extends('layouts.app')  <!-- Layout principal-->
@section('content')      <!-- contenido de vista dentro de section-->
<div class="container">

<br>
<form action="{{ url('/vehiculo/'.$vehiculo->id) }}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }} <!-- utiliza metodo patch para llegar al controller en update -->

    @include('vehiculo.form', ['modo'=>'Editar'])  <!-- reutilizo el formulario desde form  y le asigno un modo para distingir-->

</form>
</div>
@endsection