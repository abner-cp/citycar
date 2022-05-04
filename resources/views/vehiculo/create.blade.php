@extends('layouts.app')  <!-- Layout principal-->
@section('content')      <!-- contenido de vista dentro de section-->
<div class="container">

<form action="{{ url('/vehiculo') }}" method="post" enctype="multipart/form-data">
@csrf

@include('vehiculo.form', ['modo'=>'Crear'])  <!-- reutilizo el formulario desde form  y le asigno un modo para distingir-->
</form>
</div>
@endsection