@extends('layouts.privata')

@section('content')

            <div class="jumbotron text-center" >
                <h1>Stampa delle informazioni<br> sul giorno {{date('d-m H:i', strtotime($giorno_ora))}}</h1>

                @if($lista_info == NULL)
                    Nessun corso impostato<br>

                @else
                    <table class="table table-striped table-bordered">

                        <thead style="background-color: #3f9ae5; color: white">
                        <tr>
                            <td>SALA</td>
                            <td>CORSO</td>
                            <td>NOTE</td>
                        </tr>
                        </thead>
                        <tbody  style="background-color: #3bb9ff;">
                            @foreach ($lista_info as $info)
                                <form action="{{route('calendari.destroy', $info->id)}}" method="POST">
                                <tr>
                                    <td>
                                        @foreach($lista_sale as $sala)
                                            @if($sala->id == $info->sala_id)
                                                {{ $sala->nome }}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($lista_corsi as $corso)
                                            @if($corso->id == $info->corso_id)
                                                {{ $corso->nome }}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $info->note }}
                                    </td>
                                    <!--<td>
                                        <a class="btn btn-small btn-success" style="background-color: #1f6fb2" href="{{ URL::to('calendari/' . $info->id . '/edit') }}">Modifica il settaggio</a>
                                    </td>-->
                                    <td>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-small btn-danger" >Rimuovi il settaggio</button>
                                    </td>
                                </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>


                @endif
                <br>
                <a class="btn btn-small btn-primary" href="{{ URL::to('calendari/') }}">Torna alla lista</a>
                @if ($inseribile == true)
                    <a class="btn btn-small btn-primary" href="{{ route('aggiunta_settaggio', $giorno_ora) }}">Aggiungi un settaggio</a>
                @else

                @endif

            </div>
 @endsection