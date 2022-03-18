@extends('layouts.dishTemp')
@section('style')
<style>
html,
body {
    height: 100%;
    margin: 0;
}
</style>
@endsection
@section('content')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-{{isset($podcast)?6:12}}">
            <div class="card rounded">
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-header">
                    <h4>create podcast</h4>
                </div>
                <div class="card-body">


                    @if(isset($podcast))
                    <!-- -------------------------------- -->
                    <form method="POST" action="{{ route('podcast.update') }}" enctype="multipart/form-data">

                        <input type="hidden" id="podcast_id" name="podcast_id" value="{{$podcast->id}}">
                        @else
                        <form method="POST" action="{{ route('podcast.create') }}" enctype="multipart/form-data">
                            @endif
                            @csrf

                            <div class="m-5">
                                <!-- autocomplete="email" -->
                                <input id="titel" autocomplete="off" placeholder="Enter titel" type="text"
                                    class="form-control rounded-pill mt-5 @error('titel') is-invalid @enderror"
                                    value="{{isset($podcast)?$podcast->titel:''}}" name="titel">

                                @error('titel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                <!-- autocomplete="current-password" -->
                                <input id="desc" autocomplete="off" placeholder="Enter desc" type="text"
                                    class="form-control rounded-pill mt-5 mb-2 @error('desc') is-invalid @enderror"
                                    value="{{isset($podcast)?$podcast->desc:''}}" name="desc" required>

                                @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="row">
                                    <div class="col-6 mt-3">
                                        <label for="img">Select img</label>

                                        <input id="img" autocomplete="off" placeholder="Enter img" type="file"
                                            class="form-control rounded-pill  mb-2 @error('img') is-invalid @enderror"
                                            accept="image/png, image/jpg,image/jpeg" {{!isset($podcast)?"required":''}}
                                            name="img">

                                        @error('img')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label for="audio">Select audio</label>
                                        <input id="audio" autocomplete="off" placeholder="Enter audio" type="file"
                                            class="form-control rounded-pill mb-2 @error('audio') is-invalid @enderror"
                                            accept="audio/mp3" name="audio" {{!isset($podcast)?"required":''}}>

                                        @error('audio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn bg-rose w-100 text-white  mt-5 rounded-pill">
                                            submit
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        @if(isset($podcast))
                        <div>

                            <div class="text-center">
                                <img src="{{asset('storage/'.$podcast->imgUrl)}}" class="rounded-circle w-20 ">
                                <audio controls>
                                    <source src="{{asset('storage/'.$podcast->audioUrl)}}" type="audio/mpeg">
                                </audio>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
        </div>
        @if(isset($podcast))
        <div class="col-6">
            <div class="card rounded">
                <div class="card-header">
                    <h4>podcast Auther</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class=' thead-light table-responsive rounded'>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">comment</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach($podcast->podcastAuthor as $author)
                            <tr>
                                <th>{{$author->pivot->id}}</th>
                                <td> {{$author->name}}</td>
                                <td> {{$author->pivot->comment}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@endsection