@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Cita #{{ $appointment->id}}</h3>
        </div>

      </div>
    </div>

    <div class="card-body">
        <ul>
            <li>
                <strong>Fecha:</strong> {{ $appointment->scheduled_date }}
            </li>

            <li>
                <strong>Hora:</strong> {{ $appointment->scheduled_time }}
            </li>
            @if ($role == 'patient')
               <li>
                    <strong>Medico:</strong> {{ $appointment->doctor->name }}
                </li>
            @elseif ($role == 'doctor')
                <li>
                    <strong>Paciente:</strong> {{ $appointment->patient->name }}
                </li>
            @endif

            <li>
                <strong>Especialidad:</strong> {{ $appointment->specialty->name }}
            </li>

            <li>
                <strong>Tipo:</strong> {{ $appointment->type }}
            </li>

            <li>
                <strong>Estado:</strong>
                @if ($appointment->status == 'Cancelada')
                    <span class="badge badge-danger">Cancelada</span>
                @else
                     <span class="badge badge-success">{{ $appointment->status }}</span>
                @endif

            </li>

        </ul>

        <div class="alert alert-warning">
            <p>Acerce de la cancelación</p>
            <ul>
                @if ($appointment->cancellation)
                <li>
                    <strong>Motivo de la Cancelación:</strong> {{ $appointment->cancellation->justification}}
                </li>
                <li>
                    <strong>Fecha de Cancelación:</strong> {{ $appointment->cancellation->created_at}}
                </li>
                @if (auth()->id() == $appointment->cancellation->canceled_by_id)
                    Tú
                @else
                    <li>
                        <strong>¿Quién canceló la cita?:</strong> {{ $appointment->cancellation->canceled_by->name}}
                    </li>
                @endif

                @else
                <li>Esta cita fue cancelada antes de su confirmación</li>
                @endif
            </ul>
        </div>
        <a href="{{route('citas.index')}}" class="btn btn-defailt">Volver</a>
    </div>
  </div>
</div>
@endsection
