@extends('layouts.corsi')

@section('content_corsi')

    <!-- Eventuale messaggio di errore -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <h1><center>Calendario delle lezioni</center></h1>

            <table class="table table-striped table-bordered">
                <tr>
                @for ($giorno = 0; $giorno < 7; $giorno++)
                    <th style="background-color: #3f9ae5; color: white"><center>GIORNO<br> {{date('d-m', strtotime('+' .$giorno .'days'))}}</center></th>
                @endfor
                </tr>


                @for ($ora = 9; $ora < 23; $ora ++)
                    <tr>
                    @for ($giorno = 0; $giorno < 7; $giorno++)
                        <td style="background-color: #3bb9ff;">
                            <center>
                                <form action="{{route('calendari.show', date('Y-m-d', strtotime('+' .$giorno .'days')) ."_" .$ora .":00:00")}}" method="GET">
                                    <button type="submit" class="btn btn-small btn-block" style="background-color: #3bb9ff"><b>Ora {{$ora}}:00</b></button>
                                </form>
                            </center>
                        </td>
                    @endfor
                    </tr>
                    @endfor

            </table>


        </div>

@endsection