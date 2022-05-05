<!-- este formulario es para uso común de crear y editar-->

<h1> {{ $modo }} Marca </h1>

<!-- el if muestra los errores proveniente desde las validades del controller-->
@if(count($errors)>0)

         <div class="alert alert-primary" role="alert">
       <ul>          
         @foreach($errors->all() as $error)
           <li> {{ $error }} </li>   <!-- muestra los msjs de errores en una lista-->
         @endforeach   
       </ul>     
        </div>
@endif

        <div class="form-group">
        <label for="Nombre"> Nombre</label>
        <input type="text" class="form-control" name="Nombre" value="{{ isset($marca->Nombre)?$marca->Nombre:old('Nombre') }}" id="Nombre">
        </div>
        <br>

        <input class="btn btn-success" type="submit" value="{{ $modo }} Datos">

        <a class="btn btn-primary" href="{{ url('marca/') }}"> Regresar</a> <!--enlace a index -->
    
