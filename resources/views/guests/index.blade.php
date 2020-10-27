@extends('layouts.app')
@section('content')
  <div class="card-group">
    <div class="row">
    @foreach ($posts as $post)

        <div class="col-sm-4 pt-3">
          <div class="card p-3">
            <img src="{{Storage::url($post->img)}}" class="card-img-top" alt="{{$post->title}}">
            <div class="card-body">
              <h5 class="card-title">{{$post->title}}</h5>
              <p class="card-text">{{Str::substr($post->body, 0, 250). '...'}}</p>
              <p class="card-text"><small class="text-muted">{{$post->user->name}}</small></p>
              <ul class="list-group list-group-horizontal">
                @forelse ($post->tags as $tag)
                  <li class="list-group-item py-0 mt-2">{{ $tag->name }}</li>
                @empty
                  <p class="mt-2">Nessun Tag</p>
                @endforelse

              </ul>
              <a href="{{route('guest.posts.show', $post->slug)}}"class="btn btn-primary mt-4" href="#">Dettagli</a>

            </div>
          </div>
        </div>
    @endforeach
    </div>
  </div>
@endsection
