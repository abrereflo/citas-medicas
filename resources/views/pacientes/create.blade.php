@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Nueva Paciente</h3>
        </div>
        <div class="col text-right">
          <a href="{{ route('pacientes.index')}}" class="btn btn-sm btn-default ">Cancelar y Volver</a>
        </div>
      </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all as $error)

                    {{ $error }}

                @endforeach
            </div>
         @endif

        <form action="{{ route('pacientes.store')}}" method="POST" >
            @csrf
            <div class="form-group">
                <label for="name">Nombre del Paciente</label>
                <input type="text" name="name" class="form-control" value="{{ old('name')}}">
            </div>

            <div class="form-group">
                <label for="ci">C.I.</label>
                <input type="ci" name="ci" class="form-control" value="{{ old('ci')}}">
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" name="email" class="form-control" value="{{ old('email')}}">
            </div>
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" class="form-control" value="{{ old('address')}}">
            </div>
            <div class="form-group">
                <label for="phone">Celualr</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone')}}">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="text" name="password" class="form-control" value="{{  Str::random(8) }}">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
  </div>
</div>
@endsection
