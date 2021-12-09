<?php

namespace App\Http\Controllers;
use App\Models\Puesto;
use App\Models\Departamento;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller{
   
    public function index(){
        $data = [];
        $data['empleados'] = Empleado::all();
        return view('empleado.index', $data);
    }

    public function create(){
        $data = [];
        $data['puestos'] = Puesto::all();
        $data['departamentos'] = Departamento::all();
        return view('empleado.create', $data);
    }

    public function store(Request $request){
        $data = [];
        
        $data['message'] = 'Se ha insertado un nuevo empleado';
        $data['type'] = 'success';
        
        $rules=
            [
                "name" => "required|min:2|max:150|string",
                "apellidos"=>"required|min:2|max:250|string",
                "email"=>"required|unique:empleado,email|email:rfc",
                "telefono"=> "required|string|size:9|unique:empleado,telefono",
                "fechacontrato"=> "required|date_format:Y-m-d|before:tomorrow",
                "idpuesto"=>"required|exists:puesto,id|integer",
                "iddepartamento"=>"required|exists:departamento,id|integer",
                //nullable
            ];
        $message=[
            'name.required'=>'Debes escribir un nombre',
            'name.max' =>'No puedes escribir un nombre tan largo',
            'name.min' =>'No puedes escribir un nombre tan corto',
            'name.string'=>'Debes poner una cadena',
            
            'apellidos.required'=>'Debes escribir un apellido',
            'apellidos.max' =>'No puedes escribir un apellidos tan largo',
            'apellidos.min' =>'No puedes escribir un apellidos tan corto',
            'apellidos.string'=>'Debes poner una cadena',
            
            'email.required'=>'Debes escribir un email',
            'email.unique'=>'Ese email ya existe',
            'email.email'=>'El email no esta bien escrito',
            
            'telefono.required'=>'Debes escribir un telefono',
            'telefono.string'=>'Debes escribir una cadena',
            'telefono.size'=>'No se pueden escribir mas de 9 caracteres',
            'telefono.unique'=>'Ya existe ese numero de telefono',
            
            'fechacontrato.required'=>'Debes ecribir un fecha',
            'fechacontrato.date_format'=>'No esta bien escrita la fecha',
            'fechacontrato.before'=>'No puedes escribir una fecha del futuro',
            
            'idpuesto.required'=>'Debes escribir un id puesto',
            'idpuesto.exists'=>'No existe ese puesto',
            'idpuesto.integer'=>'Debes escribir un numero',
            
            'iddepartamento.required'=>'Debes escribir un id departamento',
            'iddepartamento.exists'=>'No existe ese departamento',
            'iddepartamento.integer'=>'Debes escribir un numero',
            
            
            ];

        $validator =Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
            return back()
                ->withInput()
                ->withErrors($validator->messages())
                ->with($data);
        }
        
        $empleado = new Empleado($request->all());
        //try {
        //dd($empleado);
            $result = $empleado->save();
        //} catch(\Exception $e) {
            //$result = false;
        //}
        if(!$result) {
            $data['message'] = 'No se ha podido insertar el empleado';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('empleado')->with($data);
    }

    public function show(Empleado $empleado){
         return view('empleado.show', ['empleado' => $empleado]);
    }

    public function edit(Empleado $empleado){
        $data = [];
        $data['puestos'] = Puesto::all();
        $data['departamentos'] = Departamento::all();
        $data['empleado'] = $empleado;
        return view('empleado.edit', $data);
    }

    public function update(Request $request, Empleado $empleado){
        $data = [];
        $rules=
            [
                "name" => "required|min:2|max:150|string",
                "apellidos"=>"required|min:2|max:250|string",
                "email"=>"required|email:rfc",
                "telefono"=> "required|string|size:9",
                "fechacontrato"=> "required|date_format:Y-m-d|before:tomorrow",
                "idpuesto"=>"required|exists:puesto,id|integer",
                "iddepartamento"=>"required|exists:departamento,id|integer",
                //nullable
            ];
        $message=[
            'name.required'=>'Debes escribir un nombre',
            'name.max' =>'No puedes escribir un nombre tan largo',
            'name.min' =>'No puedes escribir un nombre tan corto',
            'name.string'=>'Debes poner una cadena',
            
            'apellidos.required'=>'Debes escribir un apellido',
            'apellidos.max' =>'No puedes escribir un apellidos tan largo',
            'apellidos.min' =>'No puedes escribir un apellidos tan corto',
            'apellidos.string'=>'Debes poner una cadena',
            
            'email.required'=>'Debes escribir un email',
            'email.email'=>'El email no esta bien escrito',
            
            'telefono.required'=>'',
            'telefono.string'=>'Debes escribir una cadena',
            'telefono.size'=>'No se pueden escribir mas de 9 caracteres',
            
            'fechacontrato.required'=>'Debes ecribir un fecha',
            'fechacontrato.date_format'=>'No esta bien escrita la fecha',
            'fechacontrato.before'=>'No puedes escribir una fecha del futuro',
            
            'idpuesto.required'=>'Debes escribir un id puesto',
            'idpuesto.exists'=>'No existe ese puesto',
            'idpuesto.integer'=>'Debes escribir un numero',
            
            'iddepartamento.required'=>'Debes escribir un id departamento',
            'iddepartamento.exists'=>'No existe ese departamento',
            'iddepartamento.integer'=>'Debes escribir un numero',
            
            ];

        $validator =Validator::make($request->all(), $rules, $message);

        if($validator->messages()->messages()){
            return back()
                ->withInput()
                ->withErrors($validator->messages());
        }
        
        $data['message'] = 'El empleado ' . $empleado->name . ' ha sido editado correctamente.';
        $data['type'] = 'success';
        
        try {
            $result = $empleado->update($request->all());
        } catch(\Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El empleado no ha podido ser editado';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('empleado')->with($data);
    }

    public function destroy(Empleado $empleado){
        $empleado = empleado::find($empleado->id);
        $isExist = departamento::select("*")->where("jefeDep", $empleado->id)->exists(); //compruebo que el empleado a eliminar sea jefe de algun departamento
        if($isExist){
            DB::update('update departamento set jefeDep = null where jefeDep = :id', ['id' => $empleado->id]);

                    //si es jefe de algun departamento realizo un update en la tabla departamento y actualizo el id_empleado_jefe a null

        }
        $data = [];
        $data['message'] = 'El empleado ' . $empleado->name . ' ha sido borrado correctamente.';
        $data['type'] = 'success';
        try {
            $empleado->delete();
        } catch(Exception $e) {
            $data['message'] = 'El empleado ' . $empleado->name . ' no ha podido ser borrado.';
            $data['type'] = 'danger';
        }
        return redirect('empleado')->with($data);
    }
}

