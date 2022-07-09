@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Lista de Medicos</h3>
        </div>
        <div class="col text-right">
          <a href="{{ route('doctores.create')}}" class="btn btn-sm btn-success ">Nueva Medico</a>
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


            @foreach($doctors as $doctor)
            <tr>
                <th scope="row">
                  {{ $doctor->name}}
                </th>
                <td>
                    {{ $doctor->ci}}
                </td>
                <td>
                    {{ $doctor->email}}
                  </td>
                <td>


                  <form action="{{ route('doctores.destroy', $doctor->id )}}" method="POST">
                      @csrf
                      @method('DELETE')

                    <a href="{{ route('doctores.edit', $doctor)}} " class="btn btn-sm btn-primary">Edita</a>
                    <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                  </form>

                </td>
              </tr>

            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
