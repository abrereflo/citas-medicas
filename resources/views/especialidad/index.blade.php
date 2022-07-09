@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Especialidades</h3>
        </div>
        <div class="col text-right">
          <a href="{{ route('especialidades.create')}}" class="btn btn-sm btn-success ">Nueva Especialidad</a>
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
            <th scope="col">Descripción</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach($specialties as $specialty)

            <tr>
                <th scope="row">
                  {{ $specialty->name}}
                </th>
                <td>
                    {{ $specialty->descripcion}}
                </td>
                <td>
                    {{ $specialty->status}}
                  </td>
                <td>


                  <form action="{{ route('especialidades.destroy', $specialty->id )}}" method="POST">
                      @csrf
                      @method('DELETE')

                    <a href="{{ route('especialidades.edit', $specialty)}} " class="btn btn-sm btn-primary">Edita</a>
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
