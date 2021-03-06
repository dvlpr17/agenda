<x-app-layout>
    
    <div class="container mx-auto py-8">

        <div class="max-w-6xl mx-auto grid grid-cols-1 py-3 pl-3 border-b">
            <h1 class="font-bold mt-1 sm:text-slate-900 text-3xl">Listado de actividades</h1>
        </div>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

        <div class="max-w-6xl mx-auto pt-4">

            <div class="col-md-12 pb-5">
                @can('Activities.create')
                    <a href="{{ route('activities.create') }}" class="btn btn-success"> Agregar </a>
                @endcan
            </div>

            <table id="ListaActividades" class="table table-striped bg-white" style="width:100%">
                <thead>
                    <tr>
                        <th>Número de registro</th>
                        <th>Concepto</th>
                        <th>Fecha de Petición</th>
                        <th>Fecha Limite</th>
                        <th>Fecha de Entrega</th>
                        <th>Estado de la tarea</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)

                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->concept }}</td>
                            <td>{{ $activity->date_petition }}</td>
                            <td>{{ $activity->deadline }}</td>
                            <td>{{ $activity->date_entry }}</td>
                            <td>{{ $activity->status }}</td>
                            <td>
                                <a href="{{ route('activities.edit', $activity) }}" class="btn btn-primary btn-sm"> Editar </a>
                            </td>
                            <td>
                                @can('Activities.destroy')
                                    <form action="{{route('activities.destroy', $activity)}}" method="POST" class="formulario-eliminar">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    <footer class="w-full max-w-container mx-auto border-t py-10 text-center text-sm text-gray-500 sm:flex sm:items-center sm:justify-center">
        <p>© <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> Combuexpress</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ListaActividades').DataTable({
                // "pageLength":   100,
                scrollY:        "500px",
                scrollX:        true,
                scrollCollapse: true,
                "order": [[0, 'desc']],

                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }

            });
        } );        
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        
        $(".formulario-eliminar").submit(function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Se va a eliminar el registro',
                text: "Al borrar se eleminaran los archivos y notas de la actividad",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Borrar'
                }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    // 'Registro borrado',
                    // 'La actividad junto con las notas y archivos fueron borrados',
                    // 'Continuar'
                    // )
                    this.submit();
                }
            })        

        });
        
    </script>
</x-app-layout>



