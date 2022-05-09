            <div class="mb-6">
                <div class="mb-6">
                    {!! Form::label('name', 'Nombre',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Ingrese el nombre de la persona']) !!}
                    {!! Form::text('name', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'placeholder' => 'Ingresa el nombre de la persona']) !!}

                    @error('name')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    {!! Form::label('lastname', 'Apellido',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Ingrese el apellido de la persona']) !!}
                    {!! Form::text('lastname', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'placeholder' => 'Ingresa el apellido de la persona']) !!}

                    @error('lastname')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    {!! Form::label('email', 'Correo Electrónico',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Ingrese el correo de la persona']) !!}
                    {!! Form::email('email', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'placeholder' => 'Ingresa el correo de la persona']) !!}

                    @error('email')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-6">
                    {!! Form::label('phone_number', 'Número de Teléfono',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Ingrese el teléfono de la persona']) !!}
                    {!! Form::text('phone_number', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'placeholder' => 'Ingresa el teléfono de la persona']) !!}

                    @error('phone_number')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    
                    @isset($user)
                    {!! Form::label('password', 'Clave ( este campo puede ser opcional )',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Ingrese la clave de la persona']) !!}
                    {!! Form::text('pass', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'placeholder' => 'Ingresa la clave de la persona', 'value'=>'']) !!}
                    @else
                    {!! Form::label('password', 'Clave',['class' => 'font-bold block mb-2 text-sm font-medium', 'placeholder' => 'Ingrese la clave de la persona']) !!}
                    {!! Form::text('password', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ', 'placeholder' => 'Ingresa la clave de la persona']) !!}
                    @endisset


                    @error('password')
                        <span class="font-sans text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>