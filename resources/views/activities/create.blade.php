<x-app-layout>
    
    <div class="container mx-auto py-8">


        <div class="max-w-2xl mx-auto grid grid-cols-1 py-3 pl-3 border-b">
            <h1 class=" mt-1 font-semibold sm:text-slate-900 text-3xl">Agregar Actividad</h1>
        </div>

        <div class="max-w-2xl mx-auto bg-white p-16">

            {!! Form::open(['route' => 'activities.store']) !!}

            {!! Form::hidden('user_id', auth()->user()->id) !!}
            

            @include('activities.partials.form')
            
            {!! Form::submit('Agregar Actividad', ['class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center']) !!}

            {!! Form::close() !!}

            
        </div>



    </div>
    
    <footer class="w-full max-w-container mx-auto border-t py-10 text-center text-sm text-gray-500 sm:flex sm:items-center sm:justify-center">
        <p>© <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> Combuexpress</p>
    </footer>


</x-app-layout>