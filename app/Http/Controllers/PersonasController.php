<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Http\Request;

class PersonasController extends Controller
{
    
    public function index()
    {
        //pagina de inicio
        $datos= Personas::orderBy('paterno', 'desc')->paginate(3);
        return view('inicio', compact('datos'));
    }

    
    public function create()
    {
        //formulario donde agrego datos
        return view('agregar');
    }

    
    public function store(Request $request)
    {
        //guardar datos en la base de datos
        $personas= new Personas();
        $personas->paterno = $request->post('paterno');
        $personas->materno = $request->post('materno');
        $personas->nombre = $request->post('nombre');
        $personas->fecha_nacimiento = $request->post('fecha_nacimiento');
        $personas->save();

        return redirect()->route("personas.index")->with("success","Agregado con exito!");
        
    }

   
    public function show($id)
    {
        //obtener registro de la tabla
        $personas= Personas::find($id);
        return view("eliminar", compact('personas'));
    }

    
    public function edit($id)
    {
        //traer datos que se van a editar
        //y los pone en el formulario
        $personas= Personas::find($id);
        return view("actualizar", compact('personas'));
        
    }

    
    public function update(Request $request, $id)
    {
        //actualiza los datos en la DB
        $personas= Personas::find($id);
        $personas->paterno = $request->post('paterno');
        $personas->materno = $request->post('materno');
        $personas->nombre = $request->post('nombre');
        $personas->fecha_nacimiento = $request->post('fecha_nacimiento');
        $personas->save();

        return redirect()->route("personas.index")->with("success","Actualizado con éxito!");

    }

    
    public function destroy($id)
    {
        $personas = Personas::find($id);
        $personas->delete();
        
        return redirect()->route("personas.index")->with("success","Eliminado con éxito");
    }
}
