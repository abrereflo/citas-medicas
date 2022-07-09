<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Specialty;

class DoctorController extends Controller
{

    public function index()
    {
        $doctors = User::Doctors()->get();
        return view('doctores.index', compact('doctors'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('doctores.create', compact('specialties') );
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'ci'=> 'nullable|min:6',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|digits:8'
        ];

        $this->validate($request,$rules);

        $user = User::create($request->only(['name','ci','email','address', 'phone']) + [
                        'role' => 'doctor',
                        'password' => bcrypt($request->input('password'))
                    ]);

        $user->specialties()->attach($request->input('specialties'));

        $notification='El médico se ha registrado correctamente.';

        return redirect('/doctores')->with(compact('notification'));
    }

    public function edit($id)
    {
        $doctor = User::Doctors()->findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctores.edit', compact('doctor', 'specialties','specialty_ids'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'ci'=> 'nullable|min:6',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|digits:8'
        ];

        $this->validate($request,$rules);

        $user = User::Doctors()->findOrFail($id);

        $data =  $request->only(['name','ci','email','address', 'phone']);
        $password =  $request->input('password');

            if($password)
            {
                $data['password'] = bcrypt($password);
            }

            /* dd($data); */
        $user->fill($data);
        $user->save(); // actualiza los datos
        $user->specialties()->sync($request->input('specialties'));

        $notification='La información del médico se ha actualizado correctamente';
        return redirect('/doctores')->with(compact('notification'));
    }

    public function destroy(User $doctor)
    {
        $doctorName  = $doctor->name;
        $doctor->delete();

        $notification='El médico '.$doctorName.' se ha eliminado correctamente';
        return redirect('/doctores')->with(compact('notification'));
    }

}
