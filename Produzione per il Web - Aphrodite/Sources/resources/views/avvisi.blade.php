@extends('layouts.pubblica')

@section('content')
    <div class="container1">

        <center><strong style="font-size: 3vw; color: #4AA02C;"><b>Bacheca avvisi</b></strong></center><br>

            <!-- Eventuale messaggio di errore -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif



        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 5%">
                <table class="table table-striped table-bordered" style="font-size: 1.5vw; text-align: center;">
                    <thead>
                    <tr style="background-color: #7FE817;">
                        <th>CORSO</th>
                        <th>DATA</th>
                        <th>AVVISO</th>
                    </tr>
                    </thead>
                    <tbody style="background-color: #7FE857;">
                        @foreach($lista_eventi as $evento)
                            @if($evento->note != NULL)
                                <tr>
                                    <td>
                                        <b>{{$evento->nome}}</b>
                                    </td>
                                    <td>
                                        <b>Giorno {{date('d-m', strtotime($evento->giorno_ora))}} <br>
                                        ore {{date('H:i', strtotime($evento->giorno_ora))}}</b>
                                    </td>
                                    <td>
                                        <b>{{$evento->note}}</b>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    </body>
</html>
@endsection