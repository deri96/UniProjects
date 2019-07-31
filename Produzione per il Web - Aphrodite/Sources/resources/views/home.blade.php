@extends('layouts.pubblica')

@section('content')
    <div class="container1">

        <center><strong style="font-size: 3vw; color: #4AA02C;"><b>ASD Aphrodite<br>Benvenuto nel nostro portale web</b></strong></center><br>

        <!-- Full-width images with number text -->
        <div class="mySlides">
            <img src="Images/palestra1.jpg" width="98%">
        </div>

        <div class="mySlides">
            <img src="Images/palestra2.jpg" width="98%">
        </div>

        <div class="mySlides">
            <img src="Images/palestra3.jpg" width="98%">
        </div>

        <div class="mySlides">
            <img src="Images/palestra4.jpg" width="98%">
        </div>



        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <!-- Image text -->
        <div class="caption-container" style="margin-top: 1vh">
            <p id="caption"></p>
        </div>

        <!-- Thumbnail images -->
        <div class="row1" style="margin-top: -1.8vh">
            <div class="column1">
                <img class="demo cursor" src="Images/palestra1.jpg" style="width:93%;" onclick="currentSlide(1)" alt="IL NOSTRO CENTRO">
            </div>
            <div class="column1">
                <img class="demo cursor" src="Images/palestra2.jpg" style="width:93%;" onclick="currentSlide(2)" alt="IL NOSTRO CENTRO">
            </div>
            <div class="column1">
                <img class="demo cursor" src="Images/palestra3.jpg" style="width:93%;" onclick="currentSlide(3)" alt="IL NOSTRO CENTRO">
            </div>
            <div class="column1">
                <img class="demo cursor" src="Images/palestra4.jpg" style="width:93%;" onclick="currentSlide(4)" alt="IL NOSTRO CENTRO">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <p style="float: left; margin-left: 15vw; font-size: 3vh; color: #4AA02C;"> <strong>ORARI DI APERTURA</strong></p><br>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <p style="font-size: 3vh;  color: #4AA02C; margin-left: 18vw;"> <strong>IL NOSTRO STAFF</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left: 17vw;">
           <strong><p>Tutti i giorni<br> dalle 9:00 alle 23:00</p></strong>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-left: 55vw; margin-top: -10vh">
            <img src="Images/staff.png" width="70%">
        </div>
    </div>



@endsection