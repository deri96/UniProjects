<!DOCTYPE html>
<html>
    <head>
        <title>Look! I'm CRUDding</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">

            <nav class="navbar navbar-inverse">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ URL::to('soci') }}">Sezione soci</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('soci') }}">Lista dei soci</a></li>
                    <li><a href="{{ URL::to('soci/create') }}">Aggiungi un socio</a>
                </ul>
            </nav>
            <form action="{{ route('soci.destroy', $tessera->id) }}" method="POST"></form>

            <!-- mostra di eventuali messaggi -->
            @if (session('errore'))
                <div class="alert alert-danger">{{ session('errore') }}</div>
            @else
                <div class="alert alert-success">{{ session('successo') }}</div>
            @endif


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-small btn-danger" href="{{ URL::to('soci/') }}">Torna indietro</a>
            </div>
        </div>

        </form>

        </div>
    </body>
</html>