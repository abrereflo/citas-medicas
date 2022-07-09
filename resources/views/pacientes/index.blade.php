@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Paciente</h3>
        </div>
        <div class="col text-right">
          <a href="{{ route('pacientes.create')}}" class="btn btn-sm btn-success ">Nueva Paciente</a>
        </div>
      </div>
    </div>
    <div class="card-body">
        @if (session('notification'))
            <div class="alert alert-success" role="alert">
                {{ session('notification')}}
            </div>
        @endif
    </div>
    <div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">C.I.</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>


            @foreach($patients as $patient)
            <tr>
                <th scope="row">
                  {{ $patient->name}}
                </th>
                <td>
                    {{ $patient->ci}}
                </td>
                <td>
                    {{ $patient->email}}
                  </td>
                <td>


                  <form action="{{ route('pacientes.destroy', $patient->id )}}" method="POST">
                      @csrf
                      @method('DELETE')

                    <a href="{{ route('pacientes.edit', $patient)}} " class="btn btn-sm btn-primary">Edita</a>
                    <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                  </form>

                </td>
              </tr>

            @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-body">
        {{ $patients->links() }}
    </div>

  </div>
</div>
@endsection
