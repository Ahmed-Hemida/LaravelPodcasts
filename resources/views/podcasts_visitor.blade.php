@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body,
html {
    background: #100f1e;
}

.head {
    width: 100%;
    height: 20%;
    background-image: linear-gradient(rgba(48, 48, 48, 0.795), #fbd0db00);
    color: white;
}

.main-mune {

    /* float: right; */
    height: 100%;
    list-style-type: none;
    display: inline;
    margin: 70px;
}

.main-mune ul li {
    height: 100%;
    display: inline;
    margin: 30px;


}

.bottom-bord {
    padding-bottom: 10px;
    border: none;
    border-bottom: 5px solid #ffc107;
}

.first-section {
    max-width: 100%;
    height: 500px;
    background-image: url("https://cdn.podu.me/img/resources/shows/cover/site/153.jpg?updated_at=2022-03-1002:30:06)");
    background-repeat: no-repeat;
    /* background-size: contain; */
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    background-position: center;
}

input {
    background-color: transparent;
    color: #ffc107;
}

.cover-img {
    margin-top: -40px;
    margin-top: -40px;


    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    background-position: center;

}

.full-border {
    border: 5px solid #ffc107;
}
.titte,.desc{text-align:right;}

/* ::placeholder {
  color:#ffc107!important;
} */
</style>
@endsection
@section('content')


<section class="first-section">
    <div class="head">
        <div class="main-mune">
            <ul>
                <li class="">
                    <img src="https://podu.me/img/logo_podu.png" class="w-10">
                </li>
                <li class="bottom-bord">Home</li>
                <li> <a class=" text-white" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li>
                    <input id="titel" autocomplete="off" placeholder="search" type="search"
                        class=" rounded-pill w-25 h-75 p-3 bg-0 border border-warning">
                </li>
            </ul>
        </div>
    </div>

</section>
<section class="container">
    <div class="row">
        <div class="col-3">
            <img src="https://cdn.podu.me/img/resources/shows/profile/153.jpg?updated_at=2022-03-1002:30:06"
                class="w-50 cover-img full-border">
        </div>
        <div class="col-9">
            <div>
                @foreach($podcasts as $podcast)
                <div class="row m-3">
                    <div class="col-3">
                        <img class="w-50" src="{{asset('storage/'.$podcast->imgUrl)}}">

                    </div>
                    <div class="col-6  text-right ">
                        <div class="fs-4 text-white titte">
                           {{$podcast->titel}}
                        </div>
                        <div class="fs-12 text-white desc">
                        {{$podcast->desc}}
                        </div>

                    </div>
                    <div class="col-2 ml-3">
                       <a class="btn btn-dark mt-3">
                       <i class="fa fa-heart-o" aria-hidden="true"></i>

                       </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</section>

@endsection