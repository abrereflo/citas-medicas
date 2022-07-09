<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
         {{--  <th scope="col">Descripción</th> --}}
          <th scope="col">Especialidad</th>
         {{--  <th scope="col">Medico</th> --}}
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
    {{--       <th scope="col">Tipo</th> --}}
          <th scope="col">Estado</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
          @foreach($oldAppointments as $appointment)
          <tr>
           {{--    <th scope="row">
                {{ $appointment->description}}
              </th> --}}
              <td>
                  {{ $appointment->specialty->name}}
              </td>
           {{--    <td>
                  {{ $appointment->doctor->name}}
              </td> --}}
              <td>
                  {{ $appointment->scheduled_date}}
                </td>
                <td>
                  {{ $appointment->scheduled_time_12}}
                </td>
               {{--  <td>
                  {{ $appointment->type}}
                </td> --}}
                <td>
                  {{ $appointment->status}}
                </td>

                <td>
                    <a href="{{route('citas.show',$appointment->id)}}" class="btn btn-primary btn-sm">Ver </a>
                </td>
            </tr>

          @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-body">
      {{ $oldAppointments->links() }}
  </div>
