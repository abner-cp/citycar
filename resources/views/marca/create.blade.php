@extends('layouts.app')  <!-- Layout principal-->
@section('content')      <!-- contenido de vista dentro de section-->
<div class="container">

<form action="{{ url('/marca') }}" method="post" enctype="multipart/form-data">
@csrf

@include('marca.form', ['modo'=>'Crear'])  <!-- reutilizo el formulario desde form  y le asigno un modo para distingir-->
</form>
</div>
@endsection