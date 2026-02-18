
<script>
    async function eliminar(params) {
        //alert(params)
        fetch('/user/destroy/'+params)
        .then(data => location.reload());



    }
</script>
<table>
    <tr>
        @php
            $llave = true;
        @endphp
        @foreach ($resulset[0] as $key =>$item)
            @foreach ($item as $key2 =>$item2)
            <td></td>
                    @if ($llave)


                        @foreach (array_keys($item) as $key3 =>$item3)
                            <th style="border:1px solid red">
                                {{$item3}}
                            </th>
                        @endforeach
                        @php
                            $llave = false;
                        @endphp
                    @endif

            @endforeach

        @endforeach
    </tr>



        @foreach ($resulset[0] as $key =>$item)
            <tr>

                @foreach ($item as $key2 =>$item2)

                    @if ($key2 ==="user_id")
                        <td>
                            <button onclick="eliminar( {{$item2}})">Eliminar</button>
                        </td>
                    @endif


                            {{--  --}}

                        {{--  @foreach ($item2 as $key3 =>$item3) --}}
                            @if ($key2 ==="user_cuest_episodio")
                                <td style="border:1px solid red;background-color:{{empty($item2) ? 'purple':'white'}}">
                            @else
                                <td style="border:1px solid red;background-color:{{empty($item2) ? 'red':'white'}}">
                            @endif
                                    @if (empty($item2))
                                        <div style="color:white">
                                            VACIO
                                        </div>
                                    @endif
                                    @if ($key2 ==="user_id")
                                        {{$item2}}
                                    @endif
                                    @if ($key2 ==="user_cuest_direction")
                                        @foreach ($item2 as $item3)
                                            <div>
                                                {{$item3->cat_estado_id}}
                                            </div>
                                            <div>
                                                {{$item3->cat_municipio_id}}
                                            </div>

                                            <div>
                                                {{$item3->description}}
                                            </div>
                                            <div>
                                                {{$item3->domicilio}}
                                            </div>


                                        @endforeach

                                    @endif
                                    @if ($key2 ==="user_type")
                                        @foreach ($item2 as $item3)
                                            <div>
                                                {{$item3->cat_user_type_id}}
                                            </div>

                                        @endforeach
                                    @endif
                                    {{-- @if ($key2 ==="user_cuest_evolucion")
                                        @foreach ($item2 as $item3)
                                            <div>
                                                {{$item3->value}}
                                            </div>
                                            <hr>
                                        @endforeach
                                    @endif --}}
                                    @if ($key2 ==="user_cuest_imp_diagn")
                                        @foreach ($item2 as $item3)
                                            <div>
                                                {{$item3->value}}
                                            </div>

                                        @endforeach
                                    @endif
                                    @if ($key2 ==="user")
                                        @foreach ($item2 as $item3)
                                            <div>
                                                {{$item3->email}}
                                            </div>
                                            <div>
                                                {{$item3->password}}
                                            </div>
                                            <div>
                                                {{$item3->created_at}}
                                            </div>
                                        @endforeach

                                    @endif
                                    @if ($key2 ==="user_profile")
                                        @foreach ($item2 as $item3)
                                            <div>
                                                {{$item3->nacionalidad}}
                                            </div>
                                            <div>
                                                {{$item3->nombres}} {{$item3->apellidos}}
                                            </div>

                                            <div>
                                                {{$item3->genero}}
                                            </div>
                                            <div>
                                                {{$item3->telefono_movil}}
                                            </div>
                                            <div>
                                                {{$item3->cedula}}
                                            </div>

                                        @endforeach
                                    @endif
                                    @if ($key2 ==="user_cuest_episodio")
                                        @if (!empty($item2))
                                            @foreach ($item2 as $item3)
                                                <div>
                                                    {{$item3->ingreso}}
                                                </div>
                                                <div>
                                                    {{$item3->egreso}}
                                                </div>
                                                <div>
                                                    {{$item3->active}}
                                                </div>

                                                <hr>
                                            @endforeach
                                        @else
                                            <div style="color:white">
                                                NO TIENE
                                            </div>

                                        @endif

                                    @endif
                                  {{--



                                     --}}
                                   {{--  @if ($key2 ==="examen_fisico")
                                        @foreach ($item2 as $item3)
                                            <div>
                                                {{$item3}}
                                            </div>
                                        @endforeach
                                    @endif
 --}}
                                </td>
                        {{--  @endforeach --}}



                @endforeach
            </tr>
        @endforeach

</table>

