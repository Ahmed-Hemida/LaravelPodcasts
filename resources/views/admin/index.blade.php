@extends('layouts.dishTemp')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html,
body {
    height: 100%;
    margin: 0;
}
</style>
@endsection
@section('content')

<section class="container w-50 mt-5">
    <div class="justify-content-center ">
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <table class="table table-hover">
            <thead class=' thead-light table-responsive rounded'>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach($podcasts as $podcast)
                <tr>
                    <th>{{$podcast->id}}</th>
                    <td> {{$podcast->titel}}</td>
                    <td> {{$podcast->desc}}</td>
                    <td><a class="btn btn-warning" href="{{route('podcast.form.view',$podcast->id)}}"><i
                                class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                   <a class="btn btn-danger"onclick="return confirm('Are you sure?')" href="{{route('podcast.delete',$podcast->id)}}"><i
                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

</section>

@endsection