<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Exception;

class DepartamentoController extends Controller{
    
    public function index(){
        $data = [];
        $data['departamentos'] = Departamento::all();
        $data['empleados'] = Empleado::all();
        return view('departamento.index', $data);
    }

    
    public function create(){
        $data = [];
        $data['empleados'] = Empleado::all();
        return view('departamento.create',$data);
    }

    public function store(Request $request){
        $data = [];
        $rules=
            [
                "name" => "required|min:2|max:150|string",
                "location"=>"required|min:2|max:350|string",
                "jefeDep"=>"exists:departamento,id|integer",
                //nullable
            ];
        $message=[
            'name.required'=>'Debes escribir un nombre',
            'name.max' =>'No puedes escribir un nombre tan largo',
            'name.min' =>'No puedes escribir un nombre tan corto',
            'name.string'=>'Debes poner una cadena',
            
            'location.required'=>'Debes escribir una localizacion',
            'location.max' =>'No puedes escribir un localizacion tan largo',
            'location.min' =>'No puedes escribir un localizacion tan corto',
            'location.string'=>'Debes poner una cadena',
            
            'jefeDep.exists'=>'No existe ese id del jefe de departamento',
            'jefeDep.integer'=>'Debes escribir un numero',
            
            ];

        $validator =Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
            return back()
                ->withInput()
                ->withErrors($validator->messages())
                ->with($data);
        }
        $data['message'] = 'Se ha insertado un nuevo departamento';
        $data['type'] = 'success';
        $departamento = new Departamento($request->all());
        //dd($departamento);
        //try {
            $result = $departamento->save();
        //} catch(\Exception $e) {
            //$result = false;
        //}
        if(!$result) {
            $data['message'] = 'No se ha podido insertar el departamento';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('departamento')->with($data);
    }

    public function show(Departamento $departamento){
        return view('departamento.show', ['departamento' => $departamento]);
    }

    public function edit(Departamento $departamento){
        $data = [];
        $data['empleados'] = Empleado::all();
        $data['departamento'] = $departamento;
        return view('departamento.edit', $data);
    }

    public function update(Request $request, Departamento $departamento){
        $data = [];
        $rules=
            [
                "name" => "required|min:2|max:150|string",
                "location"=>"required|min:2|max:350|string",
                "jefeDep"=>"required|integer",
                //nullable
            ];
        $message=[
            'name.required'=>'Debes escribir un nombre',
            'name.max' =>'No puedes escribir un nombre tan largo',
            'name.min' =>'No puedes escribir un nombre tan corto',
            'name.string'=>'Debes poner una cadena',
            
            'location.required'=>'Debes escribir una localizacion',
            'location.max' =>'No puedes escribir un localizacion tan largo',
            'location.min' =>'No puedes escribir un localizacion tan corto',
            'location.string'=>'Debes poner una cadena',
            
            'jefeDep.required'=>'Debes escribir el id del jefe de departamento',
            
            'jefeDep.integer'=>'Debes escribir un numero',
            
            ];

        $validator =Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
            return back()
                ->withInput()
                ->withErrors($validator->messages())
                ->with($data);
        }
        $data['message'] = 'El departamento ' . $departamento->name . ' ha sido editado correctamente.';
        $data['type'] = 'success';
        try {
            $result = $departamento->update($request->all());
        } catch(\Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El departamento no ha podido ser editado';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('departamento')->with($data);
    }

    public function destroy(Departamento $departamento){
        $data = [];
        $data['message'] = 'El departamento ' . $departamento->name . ' ha sido borrado correctamente.';
        $data['type'] = 'success';
        try {
            $departamento->delete();
        } catch(Exception $e) {
            $data['message'] = 'El departamento ' . $departamento->name . ' no ha podido ser borrado.';
            $data['type'] = 'danger';
        }
        return redirect('departamento')->with($data);
    }
}
