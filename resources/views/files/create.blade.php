<x-app-layout>
    <div class="mx-auto max-w-2xl">

        <div class="py-3 pl-3 border-b">
            <h1 class="font-bold mt-1 sm:text-slate-900 text-3xl">Agregar Archivos</h1>
        </div>

        <div class="grid grid-cols-1">
            <div class=" bg-white lg:p-16 sm:p-10 p-16 ">
                {!! Form::open(['route' => 'files.store']) !!}

                {!! Form::hidden('user_id', auth()->user()->id) !!}
                {!! Form::hidden('activity_id', $activity->id) !!}

                <div class="mb-6">
                    <div class="mb-6">
                        {!! Form::label('nota', 'Agrega los archivos',['class' => 'font-bold block mb-2 text-sm font-medium']) !!}
                        {!! Form::textarea('nota', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'rows'=>'6']) !!}

                        @error('nota')
                            <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                {!! Form::submit('Guardar archivos', ['class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center']) !!}
                    <a href="{{ route('activities.edit', $activity) }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancelar</a>
                {!! Form::close() !!}
                
            </div>
        </div>

    </div>

    <footer class="w-full max-w-container mx-auto border-t py-10 text-center text-sm text-gray-500 sm:flex sm:items-center sm:justify-center">
        <p>© <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> Combuexpress</p>
    </footer>


</x-app-layout>