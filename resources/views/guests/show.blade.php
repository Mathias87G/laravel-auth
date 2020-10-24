@extends('layouts.app')
@section('content')
  <div class="row">


      <div class="col-sm-4 pt-3">
        <div class="card p-3">
          <img src="{{Storage::url($post->img)}}" class="card-img-top" alt="{{$post->title}}">
          <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->body}}</p>
            <p class="card-text"><small class="text-muted">{{$post->user->name}}</small></p>
            <a href="{{route('guest.posts.show', $post->slug)}}"class="btn btn-primary" href="#">Dettagli</a>
          </div>
        </div>
      </div>



  </div>

@endsection
