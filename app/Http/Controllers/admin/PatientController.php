<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{

    public function index()
    {
        $patients = User::Patients()->paginate(5);
        return view('pacientes.index', compact('patients'));
    }

    public function create()
    {

        return view('pacientes.create');
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

        User::create($request->only(['name','ci','email','address', 'phone']) + [
                        'role' => 'patient',
                        'password' => bcrypt($request->input('password'))
                    ]);


        $notification='El paciente se ha registrado correctamente.';

        return redirect('/pacientes')->with(compact('notification'));

    }

    public function edit(User $patient)
    {
        return view('pacientes.edit', compact('patient'));
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

        $user = User::Patients()->findOrFail($id);

        $data =  $request->only(['name','ci','email','address', 'phone']);
        $password =  $request->input('password');

            if($password)
            {
                $data['password'] = bcrypt($password);
            }

            /* dd($data); */
        $user->fill($data);
        $user->save(); // actualiza los datos

        $notification='La información del paciente se ha actualizado correctamente';
        return redirect('/pacientes')->with(compact('notification'));
    }

    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient->delete();

        $notification='El paciente '.$patientName.' se ha actualizado correctamente';
        return redirect('/pacientes')->with(compact('notification'));
    }
}
