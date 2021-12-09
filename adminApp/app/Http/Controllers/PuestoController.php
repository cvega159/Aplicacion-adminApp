<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Exception;

class PuestoController extends Controller{
   
    public function index(){
        $data = [];
        $data['puestos'] = Puesto::all();
        return view('puesto.index', $data);
    }

    public function create(){
        return view('puesto.create');
    }

    public function store(Request $request){
        $data = [];
         $rules=
            [
                "name" => "required|min:2|max:150|string",
                "min"=>"required|gte:0.01|lte:999999.99|numeric",
                "max"=>"required|gte:0.01|lte:999999.99|numeric",
                //nullable
            ];
        $message=[
            'name.required'=>'Debes escribir un nombre',
            'name.max' =>'No puedes escribir un nombre tan largo',
            'name.min' =>'No puedes escribir un nombre tan corto',
            'name.string'=>'Debes poner una cadena',
            
            'min.required'=>'Debes escribir un sueldo minimo',
            'min.gte'=>'No puede ser menor que 0,01',
            'min.lte'=>'No puede ser mayor que 999999,99',
            
            'max.required'=>'Debes escribir un sueldo maximo',
            'max.gte'=>'No puede ser menor que 0,01',
            'max.lte'=>'No puede ser mayor que 999999,99',
            
            ];

        $validator =Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
            return back()
                ->withInput()
                ->withErrors($validator->messages())
                ->with($data);
        }
        $data['message'] = 'Se ha insertado un nuevo puesto';
        $data['type'] = 'success';
        $puesto = new Puesto($request->all());
        try {
            $result = $puesto->save();
        } catch(\Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'No se ha podido insertar el puesto';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('puesto')->with($data);
    }

    public function show(Puesto $puesto){
         return view('puesto.show', ['puesto' => $puesto]);
    }

    public function edit(Puesto $puesto){
        $data = [];
        $data['puesto'] = $puesto;
        return view('puesto.edit', $data);
    }

    public function update(Request $request, Puesto $puesto){
        $data = [];
        $rules=
            [
                "name" => "required|min:2|max:150|string",
                "min"=>"required|gte:0.01|lte:999999.99|numeric",
                "max"=>"required|gte:0.01|lte:999999.99|numeric",
                //nullable
            ];
        $message=[
            'name.required'=>'Debes escribir un nombre',
            'name.max' =>'No puedes escribir un nombre tan largo',
            'name.min' =>'No puedes escribir un nombre tan corto',
            'name.string'=>'Debes poner una cadena',
            
            'min.required'=>'Debes escribir un sueldo minimo',
            'min.gte'=>'No puede ser menor que 0,01',
            'min.lte'=>'No puede ser mayor que 999999,99',
            
            'max.required'=>'Debes escribir un sueldo maximo',
            'max.gte'=>'No puede ser menor que 0,01',
            'max.lte'=>'No puede ser mayor que 999999,99',
            
            ];

        $validator =Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
            return back()
                ->withInput()
                ->withErrors($validator->messages())
                ->with($data);
        }
        $data['message'] = 'El puesto ' . $puesto->name . ' ha sido editado correctamente.';
        $data['type'] = 'success';
        try {
            $result = $puesto->update($request->all());
        } catch(\Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El puesto no ha podido ser editado';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('puesto')->with($data);
    }
    
    public function destroy(Puesto $puesto){
        $data = [];
        $data['message'] = 'El puesto ' . $puesto->name . ' ha sido borrado correctamente.';
        $data['type'] = 'success';
        try {
            $puesto->delete();
        } catch(Exception $e) {
            $data['message'] = 'El puesto ' . $puesto->name . ' no ha podido ser borrado.';
            $data['type'] = 'danger';
        }
        return redirect('puesto')->with($data);
    }
}
