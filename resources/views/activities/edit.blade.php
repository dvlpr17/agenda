<x-app-layout>
    
    <div class="container mx-auto py-8">


        <div class="py-3 pl-3 border-b">
            <h1 class="font-bold mt-1 text-lg font-semibold sm:text-slate-900 md:text-3xl text-3xl">Editar Actividad</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class=" bg-white lg:p-16 sm:p-10 p-16 ">
                {!! Form::model($activity, ['route' => ['activities.update', $activity], 'method'=>'put']) !!}
                
                {!! Form::hidden('user_id', auth()->user()->id) !!}
                

                @include('activities.partials.form')
                
                {!! Form::submit('Actualizar Actividad', ['class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center']) !!}

                {!! Form::close() !!}
                
            </div>


            <div class=" bg-white lg:p-16 sm:p-10 p-16 ">
                <h3 class="font-bold mt-1 text-lg font-semibold sm:text-slate-900 md:text-2xl text-2xl pb-5">Notas de la Actividad</h3>
                {{-- @foreach ($activity->notes as $note) --}}
                @php $contador = 0; @endphp

                @foreach ($users as $user)
                    @php $contenido[] = $user->name.' '.$user->lastname; @endphp
                @endforeach

                @foreach ($notes as $note)
                    <h4><strong>{{$contenido[$contador]}}</strong></h4>
                    <div class="bg-slate-100 p-5 border-gray-600 rounded-lg">
                            {{ $note->nota}}
                    </div>
                    @php $contador++; @endphp
                    <div class="my-5 border-b"></div>
                @endforeach
            </div>

        </div>
    </div>


    <footer class="w-full max-w-container mx-auto border-t py-10 text-center text-sm text-gray-500 sm:flex sm:items-center sm:justify-center">
        <p>© <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> Combuexpress</p>
    </footer>


</x-app-layout>