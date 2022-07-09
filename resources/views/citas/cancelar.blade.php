@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Canelar Cita</h3>
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
        <p>Estás a punto de cancelar tu cita reservada con el médico {{ $appointment->doctor->name}} (especialidad {{ $appointment->specialty->name}}) para el dia {{ $appointment->scheduled_date}}</p>
        <form action="{{ route('citas.cancel', $appointment->id )}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="justification">Por favor Cuentanos el motivo de la cancelación</label>
                <textarea required name="justification" id="justification"  rows="3" class="form-control"></textarea>
            </div>

            <button class="btn btn-danger" type="submit">Cancelar Cita</button>
            <a href="{{ route('citas.index')}}" class="btn btn-primary">Volver lista de citas sin cambio</a>
        </form>
    </div>




  </div>
</div>
@endsection
