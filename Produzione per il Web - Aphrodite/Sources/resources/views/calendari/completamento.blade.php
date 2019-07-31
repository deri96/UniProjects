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
                    <a class="navbar-brand" href="{{ URL::to('corsi') }}">Sezione corsi</a>
                    <a class="navbar-brand" href="{{ URL::to('pacchetti') }}">Sezione pacchetti</a>
                </div>
            </nav>

            <!-- Eventuale messaggio di errore -->
            @if (Session::has('messaggio'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <h2>SUCCESSO!</h2>
            <h3>Hai completato l'inserimento delle informazioni relative al corso. <br>
            E' stato aggiunto un pacchetto con il corso singolo per effettuare gli acquisti. <br></h3>
            <a class="btn btn-small btn-info" href="{{ URL::to('corsi/') }}">Torna alla home</a>

        </div>
    </body>
</html>