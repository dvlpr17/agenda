            <div class="mb-6">
                <div class="mb-6">
                    {!! Form::label('concept', 'Concepto',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Ingrese el concepto de la Actividad']) !!}
                    {!! Form::text('concept', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'placeholder' => 'Ingresa el Concepto de la Actividad']) !!}

                    @error('concept')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    {!! Form::label('description', 'Descripción',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Ingrese la descripción de la Actividad']) !!}
                    {!! Form::textarea('description', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'placeholder' => 'Ingresa la Descripcion de la Actividad', 'rows'=>'6']) !!}

                    @error('description')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    {!! Form::label('date_petition', 'Fecha de Petición',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Fecha de petición']) !!}
                    {!! Form::date('date_petition', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ']) !!}

                    @error('date_petition')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    {!! Form::label('deadline', 'Fecha de Limite',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Fecha de limite']) !!}
                    {!! Form::date('deadline', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ']) !!}

                    @error('deadline')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    {!! Form::label('date_entry', 'Fecha de Entrada',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Fecha de entrada']) !!}
                    {!! Form::date('date_entry', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ']) !!}

                    @error('date_entry')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    {!! Form::label('status', 'Estado de la actividad',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Estado de la actividad']) !!}
                    {!! Form::select('status',['Caduca' => 'Caduca', 'En Proceso' => 'En Proceso', 'Concluida' => 'Concluida'], null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ']) !!}

                    @error('status')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                
            </div>