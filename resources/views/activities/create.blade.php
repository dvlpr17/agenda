<x-app-layout>
    
    <div class="container mx-auto py-8">


        <div class="max-w-2xl mx-auto grid grid-cols-1 py-3 pl-3 border-b">
            <h1 class="font-bold mt-1 text-lg font-semibold sm:text-slate-900 md:text-3xl text-3xl">Agregar Actividad</h1>
        </div>

        <!-- component -->
        <!-- This is an example component -->
        <div class="max-w-2xl mx-auto bg-white p-16">

            {!! Form::open(['route' => 'activities.store']) !!}

            {!! Form::hidden('user_id', auth()->user()->id) !!}
            
            <div class="mb-6">
                <div class="mb-6">
                    {!! Form::label('concept', 'Concepto',['class' => 'font-bold block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300', 'placeholder' => 'Ingrese el concepto de la Actividad']) !!}
                    {!! Form::text('concept', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500', 'placeholder' => 'Ingresa el Concepto de la Actividad']) !!}

                    @error('concept')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    {!! Form::label('description', 'Descripción',['class' => 'font-bold block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300', 'placeholder' => 'Ingrese la descripción de la Actividad']) !!}
                    {!! Form::textarea('description', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500', 'placeholder' => 'Ingresa la Descripcion de la Actividad', 'rows'=>'6']) !!}

                    @error('description')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    {!! Form::label('date_petition', 'Fecha de Petición',['class' => 'font-bold block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300', 'placeholder' => 'Fecha de petición']) !!}
                    {!! Form::date('date_petition', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}

                    @error('date_petition')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    {!! Form::label('deadline', 'Fecha de Limite',['class' => 'font-bold block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300', 'placeholder' => 'Fecha de limite']) !!}
                    {!! Form::date('deadline', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}

                    @error('deadline')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    {!! Form::label('date_entry', 'Fecha de Entrada',['class' => 'font-bold block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300', 'placeholder' => 'Fecha de entrada']) !!}
                    {!! Form::date('date_entry', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}

                    @error('date_entry')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    {!! Form::label('status', 'Estado de la actividad',['class' => 'font-bold block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300', 'placeholder' => 'Estado de la actividad']) !!}
                    {!! Form::select('status',['Caduca' => 'Caduca', 'En Proceso' => 'En Proceso', 'Concluida' => 'Concluida'], null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}

                    @error('status')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                
            </div>

            
            {!! Form::submit('Agregar Actividad', ['class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800']) !!}

            {!! Form::close() !!}

            
        </div>



    </div>
    
    <footer class="w-full max-w-container mx-auto border-t py-10 text-center text-sm text-gray-500 sm:flex sm:items-center sm:justify-center">
        <p>© <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> Combuexpress</p>
    </footer>


</x-app-layout>