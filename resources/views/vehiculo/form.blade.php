<!-- este formulario es para uso común de crear y editar-->

<h1> {{ $modo }} Vehículo </h1>

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
        <label for="Modelo"> Modelo</label>
        <input type="text" class="form-control" name="Modelo" value="{{ isset($vehiculo->Modelo)?$vehiculo->Modelo:old('Modelo') }}" id="Modelo">
        </div>

        <div class="form-group">
        <label for="Anyio"> Año</label>
        <input type="number" class="form-control" name="Anyio" value="{{ isset($vehiculo->Anyio)?$vehiculo->Anyio:old('Anyio') }}" id="Anyio">
        </div>

        <div class="form-group">
        <label for="Version"> Version</label>
        <input type="text" class="form-control" name="Version" value="{{ isset($vehiculo->Version)?$vehiculo->Version:old('Version') }}" id="Version">
        </div>

        <div class="form-group">
        <label for="Cilindraje"> Cilindraje</label>
        <input type="number" class="form-control" name="Cilindraje" value="{{ isset($vehiculo->Cilindraje)?$vehiculo->Cilindraje:old('Cilindraje') }}" id="Cilindraje">
        </div>

        <div class="form-group">
        <label for="Rendimiento"> Rendimiento</label>
        <input type="text" class="form-control" name="Rendimiento" value="{{ isset($vehiculo->Rendimiento)?$vehiculo->Rendimiento:old('Rendimiento') }}" id="Rendimiento">
        </div>

        <div class="form-group">
        <label for="Foto"> </label>
        @if(isset($vehiculo->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$vehiculo->Foto }}" width="100" alt="">
        @endif
        <input type="file" class="form-control" name="Foto" value="" id="Foto">
        </div>
        <br>

        <input class="btn btn-success" type="submit" value="{{ $modo }} Datos">

        <a class="btn btn-primary" href="{{ url('vehiculo/') }}"> Regresar</a> <!--enlace a index -->
    
