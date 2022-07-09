<?php

namespace App\Http\Controllers\admin;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return view('especialidad.index', compact('specialties'));
    }

    public function create()
    {
        return view('especialidad.create');
    }

  /*   public function performValudatuin(Request $request)
    {
        $rules = [
            'name' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Es neesario ingresar un nombre',
            'name.min' => 'Como minimo el mombre de tener 3 caracteres como minimo'

        ];

        $this->validate($request, $rules, $messages);

    } */

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Es neesario ingresar un nombre',
            'name.min' => 'Como minimo el mombre de tener 3 caracteres como minimo'

        ];

        $this->validate($request, $rules, $messages);

        $specialty = new Specialty();

        $specialty->name = $request->input('name');
        $specialty->descripcion = $request->input('descripcion');

        $specialty->save();

        $notification="La especialidad se ha registrado correctamente";

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function edit(Specialty $specialty)
    {
        return view('especialidad.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {

        $rules = [
            'name' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Es neesario ingresar un nombre',
            'name.min' => 'Como minimo el mombre de tener 3 caracteres como minimo'

        ];

        $this->validate($request, $rules, $messages);


        $specialty->name = $request->input('name');
        $specialty->descripcion = $request->input('descripcion');

        $specialty->save();

        $notification="La especialidad se ha actualizado correctamente";

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function destroy(Specialty $specialty)
    {
        $deleteName = $specialty->name;
        $specialty->delete();

        $notification='La especialidad '.$deleteName.' se ha actualizado correctamente';
        return redirect('/especialidades')->with(compact('notification'));

    }

}

