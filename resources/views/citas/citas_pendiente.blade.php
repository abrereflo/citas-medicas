<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Descripción</th>
          <th scope="col">Especialidad</th>
          @if ($role == 'patient')
                <th scope="col">Medico</th>
            @elseif ($role == 'doctor')
                <th scope="col">Paciente</th>
            @endif
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
          <th scope="col">Tipo</th>
          {{-- <th scope="col">Estado</th> --}}
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>


          @foreach($pendingAppointments as $appointment)
          <tr>
              <th scope="row">
                {{ $appointment->description}}
              </th>
              <td>
                  {{ $appointment->specialty->name}}
              </td>
              @if ($role == 'patient')
                    <td>
                        {{ $appointment->doctor->name}}
                    </td>
                @elseif ($role == 'doctor')
                    <td>
                        {{ $appointment->patient->name}}
                    </td>
                @endif
              <td>
                  {{ $appointment->scheduled_date}}
                </td>
                <td>
                  {{ $appointment->scheduled_time_12}}
                </td>
                <td>
                  {{ $appointment->type}}
                </td>
               {{--  <td>
                  {{ $appointment->status}}
                </td> --}}
                <td>
                    @if ($role == 'doctor')
                        <form action="{{ route('citas.confirmar', $appointment->id )}}" method="POST" class="d-inlene-block">
                            @csrf
                            <button class="btn btn-sm btn-success " type="submit" data-toggle="tooltip" title="Confirmar Cita"><i class="ni ni-check-bold"></i></button>
                        </form>
                    @endif
                    <form action="{{ route('citas.cancel', $appointment->id )}}" method="POST" class="d-inlene-block">
                        @csrf
                        <button class="btn btn-sm btn-danger" type="submit" data-toggle="tooltip" title="Cancelar Cita"><i class="ni ni-fat-delete"></i></button>
                    </form>
                </td>
            </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-body">
    {{ $pendingAppointments->links() }}
</div>
