<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //envía los resultados de la bd hacía el index 
         $datos['marcas']= Marca::paginate(3);
         return view('marca/index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('marca/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //recibe datos desde la vista por metodo post

        //arreglo donde se intenta validar que vengan los datos desde el form
        $campos=[
            'Nombre'=>'required|string|max:50',
 
        ];
        //mensaje de error cuando no vengan los datos desde form
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        //valida lo que venga desde la req y muestra los mensajes
        $this->validate($request, $campos,$mensaje); 


        //$datosMarca = request()->all();
        $datosMarca = request()->except('_token');  //saca el token csrf

        Marca::insert($datosMarca);  //guarda en BD
       // return response()-> json($datosVehiculo);
       return redirect('marca')->with('mensaje', 'Marca registrada exitosamente!'); //redirige a index y agrega un msj de exito


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //cambie el argumento-objeto por el ID
    {
            //
            $marca= Marca::findOrFail($id);  //busco por id
            return view('marca.edit', compact('marca') );  //retornamos a la vista con los datos del vehiculo
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //arreglo donde se intenta validar que vengan los datos desde el form
        $campos=[
            'Nombre'=>'required|string|max:50',
          
        ];
        //mensaje de error cuando no vengan los datos desde form
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        //valida lo que venga desde la req y muestra los mensajes
        $this->validate($request, $campos,$mensaje); 

        
        $datosMarca = request()->except(['_token', '_method']);  //saca el token csrf y el method

        Marca::where('id', '=', $id)->update($datosMarca); //compara la id con la bd, si coincide, acutaliza los datos
        $marca= Marca::findOrFail($id);  //busco por id
        return redirect('marca')->with('mensaje', 'Marca modificada exitosamente!'); //redirige a index y agrega un msj de exito

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
              //
              $marca= Marca::findOrFail($id);  //busco por id

              Vehiculo::destroy($id);   //borra registro en bd 
      
              return redirect('marca')->with('mensaje', 'MARCA borrada exitosamente!'); //redirige a index y agrega un msj de exito
    }

}
