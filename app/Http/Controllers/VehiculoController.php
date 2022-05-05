<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //envía los resultados de la bd hacía el index 
        $datos['vehiculos']= Vehiculo::paginate(1);
        return view('vehiculo/index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vehiculo/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //recibe datos desde la vista por metodo post

        //arreglo donde se intenta validar que vengan los datos desde el form
        $campos=[
            'Modelo'=>'required|string|max:50',
           // 'Marca'=>'required|string|max:50',
            'Anyio'=>'required|integer|max:5000',
            'Version'=>'required|string|max:50',
            'Cilindraje'=>'required|integer|max:10000',
            'Rendimiento'=>'required|string|max:50',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        //mensaje de error cuando no vengan los datos desde form
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];
        //valida lo que venga desde la req y muestra los mensajes
        $this->validate($request, $campos,$mensaje); 


        //$datosVehiculo = request()->all();
        $datosVehiculo = request()->except('_token');  //saca el token csrf

        if($request->hasFile('Foto')){
            $datosVehiculo['Foto']= $request->file('Foto')->store('uploads', 'public'); //cambia nombre foto y guarda en carpteta uploads
        }
        Vehiculo::insert($datosVehiculo);  //guarda en BD
       // return response()-> json($datosVehiculo);
       return redirect('vehiculo')->with('mensaje', 'Vehículo guardado exitosamente!'); //redirige a index y agrega un msj de exito
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //cambie el argumento-objeto por el ID
    {
        //
        $vehiculo= Vehiculo::findOrFail($id);  //busco por id
        return view('vehiculo.edit', compact('vehiculo') );  //retornamos a la vista con los datos del vehiculo
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //arreglo donde se intenta validar que vengan los datos desde el form
        $campos=[
            'Modelo'=>'required|string|max:50',
           // 'Marca'=>'required|string|max:50',
            'Anyio'=>'required|integer|max:5000',
            'Version'=>'required|string|max:50',
            'Cilindraje'=>'required|integer|max:10000',
            'Rendimiento'=>'required|string|max:50',
          
        ];
        //mensaje de error cuando no vengan los datos desde form
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        
        if($request->hasFile('Foto')){
           $campos= ['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
           $mensaje=['Foto.required'=>'La foto es requerida'];
        }


        //valida lo que venga desde la req y muestra los mensajes
        $this->validate($request, $campos,$mensaje); 

        
        $datosVehiculo = request()->except(['_token', '_method']);  //saca el token csrf y el method

        if($request->hasFile('Foto')){
            $vehiculo= Vehiculo::findOrFail($id);  //busco por id
            Storage::delete('public/'.$vehiculo->Foto); //como viene una nueva foto, entonces elimino la anterior
            $datosVehiculo['Foto']= $request->file('Foto')->store('uploads', 'public'); //cambia nombre nueva foto y la guarda en carpteta uploads
        } 

        Vehiculo::where('id', '=', $id)->update($datosVehiculo); //compara la id con la bd, si coincide, acutaliza los datos
        $vehiculo= Vehiculo::findOrFail($id);  //busco por id
        //return view('vehiculo.edit', compact('vehiculo') );  //retornamos a la vista con los datos del vehiculo
        return redirect('vehiculo')->with('mensaje', 'Vehículo modificado exitosamente!'); //redirige a index y agrega un msj de exito


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //cambie el argumento-objeto por el ID
    {
        //
        $vehiculo= Vehiculo::findOrFail($id);  //busco por id

        if( Storage::delete('public/'.$vehiculo->Foto) ){    //intenta borrar la foto en la carpeta public
        Vehiculo::destroy($id);   //borra registro en bd
        }

        return redirect('vehiculo')->with('mensaje', 'Vehículo borrado exitosamente!'); //redirige a index y agrega un msj de exito
    }

}
