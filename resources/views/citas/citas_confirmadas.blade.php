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
        {{--   <th scope="col">Estado</th> --}}
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>


          @foreach($confirmedAppointment as $appointment)
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
             {{--    <td>
                  {{ $appointment->status}}
                </td> --}}
                <td>
                    <a class="btn btn-sm btn-danger" title="Cancelar Cita" href="{{ route('citas.showcancel', $appointment->id)}}" >Cancelar cita</a>
                </td>
            </tr>

          @endforeach
      </tbody>
    </table>
  </div>

  <div class="card-body">
    {{ $confirmedAppointment->links() }}
</div>
