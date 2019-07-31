@extends('layouts.privata')

@section('content')

    <center>
        <a class="btn btn-primary" style="background-color: #1f6fd2" href="{{ URL::to('corsi') }}">Sezione corsi</a>
        <a class="btn btn-primary" style="background-color: #1f6fd2" href="{{ URL::to('pacchetti') }}">Sezione pacchetti</a>
        <a class="btn btn-primary" style="background-color: #1f6fd2" href="{{ URL::to('calendari') }}">Sezione calendari</a>
        <a class="btn btn-primary" style="background-color: #1f6fd2" href="{{ URL::to('discipline') }}">Sezione discipline</a>
        <br><br></center>

    @yield('content_corsi')
@endsection