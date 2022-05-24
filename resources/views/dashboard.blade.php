<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome /> --}}
                
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4">

                    <div class="flex justify-center">
                        <div class="justify-start h-56 grid grid-cols-1 content-center ">
                            <h1 class="mt-8 text-2xl">Bienvenido a la aplicación agenda</h1>
                            <p class="mt-6 text-gray-500">A continuación el estado de las actividades</p>
                        </div>
                    </div>

                    <div class="mt-6 text-gray-500 flex justify-center ">
                        <div class="flex-initial ">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>


                
            </div>
        </div>
    </div>

    
    <footer class="w-full max-w-container mx-auto border-t py-10 text-center text-sm text-gray-500 sm:flex sm:items-center sm:justify-center">
        <p>© <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> Combuexpress</p>
    </footer>

    <form id="dataChart" action="{{route('extra.all')}}" action="POST">
        @csrf
        <input type="hidden" value="aksjdlka" name="id">
    </form>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script>

    
    var En_Proceso=0;
    var Concluida=0;
    var Caduca=0;
    var valores = [];
    $(document).ready(function(){
        $.ajax({
            url:'all',
            method:'post',
            data:$("#dataChart").serialize()
        }).done(function (res){
            var arreglo = JSON.parse(res);
            for(var x=0; x<arreglo.length;x++){
                if(arreglo[x].status == "En Proceso"){
                    En_Proceso++;
                }
                if(arreglo[x].status == "Concluida"){
                    Concluida++;
                }
                if(arreglo[x].status == "Caduca"){
                    Caduca++;
                }
            }
            graficar();
        });
    });

    function graficar(){

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Concluida', 'En Proceso', 'Caduca'],
                datasets: [{
                    label: "# de",
                    data: [Concluida, En_Proceso, Caduca],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: { legend: false, },
                scales: { y: { beginAtZero: true } },
            }
        });


    }

    
    </script>


</x-app-layout>

