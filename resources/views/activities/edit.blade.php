<x-app-layout>
    
    <div class="container mx-auto py-8">


        <div class="py-3 pl-3 border-b">
            <h1 class="font-bold mt-1 sm:text-slate-900 text-3xl">Editar Actividad</h1>
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
                <article x-data=" { open: true }" class="mb-5">
                    <h3 class="font-bold mt-1 sm:text-slate-900 md:text-2xl text-2xl pb-5 cursor-pointer" @click="open = !open">Notas de la Actividad</h3>
                    <div  x-show="open">
                        @foreach ($notes as $note)
                            @foreach ($notesUsers as $nu)
                                @if ($note->user_id == $nu->id)
                                    <h4><strong>{{$nu->name}} {{$nu->lastname}}</strong></h4>
                                @endif
                            @endforeach

                            <div class="bg-slate-100 p-5 border-gray-600 rounded-lg">
                                {{ $note->nota }}
                            </div>
                            <div class="my-5 border-b"></div>
                        @endforeach
                    </div>
                    <a href="{{ route('notes.create', $activity)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Agregar nota</a>
                </article>
                <article x-data=" { open: true }">
                    <h3 class="font-bold mt-1 sm:text-slate-900 md:text-2xl text-2xl pb-5 cursor-pointer" @click="open = !open">Archivos Adjuntos</h3>
                    <div  x-show="open">
                                
                        {{-- AQUI ORDENO LOS ARCHIVOS POR USUARIO --}}
                        @php
                            $cont=0;
                        @endphp
                        @foreach ($files as $file)
                            @php
                                $thearray[$cont][0] = $file->user_id;
                                $thearray[$cont][1] = $file->ruta;
                                $cont++;
                            @endphp
                        @endforeach


                        {{-- EN EL MISMO ORDEN SE MUESTRA EL NOMBRE DEL USUARIO Y SUS ARCHIVOS --}}
                        @empty ($thearray)
                            No hay archivos
                        @else
                            @php
                                sort($thearray);
                                $same = 000000000123;
                                $contadorArchivos = 1;
                                $footer = 0;
                            @endphp

                            @for ($i = 0; $i < count($thearray); $i++)
                                @if ($same != $thearray[$i][0])
                                    
                                    @php
                                        $same = $thearray[$i][0];
                                        $footer++;
                                        $contadorArchivos = 1;
                                    @endphp
                                    @if ($footer == 2)
                                        <div class="my-5 border-b"></div>

                                        @php $footer = 1; @endphp
                                    @endif
                                    @foreach ($filesUsers as $fu)
                                        @if ($thearray[$i][0] == $fu->id)
                                            <h4><strong>{{$fu->name}} {{$fu->lastname}}</strong></h4>
                                        @endif                                
                                    @endforeach
                                                                
                                @endif


                                <a href="{{Storage::url($thearray[$i][1])}}" target="_blank">Archivo{{ $contadorArchivos }}</a>
                                @php $contadorArchivos++; @endphp
                            @endfor
                        @endempty

                        <p class="mt-5">
                           <a href="{{ route('files.create', $activity) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Agregar archivos</a>
                        </p>

                    </div>
                </article>
            </div>

        </div>
    </div>


    <footer class="w-full max-w-container mx-auto border-t py-10 text-center text-sm text-gray-500 sm:flex sm:items-center sm:justify-center">
        <p>© <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> Combuexpress</p>
    </footer>


</x-app-layout>