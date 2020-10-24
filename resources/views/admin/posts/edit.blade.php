@extends('layouts.app')
@section('content')
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <form action="{{route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <img src="{{ asset('storage/' . $post->img)}}" alt="{{$post->slug}}"width="300px">

    <div class="form-group">
      <label class="text-light" for="title">Titolo</label>
      <input type="text" name="title" class="form-control" value="{{$post->title}}">
    </div>
    <div class="form-group">
      <label class="text-light" for="img">Immagine</label>
      <input class="text-light" type="file" name="img" accept="image/*" >
    </div>

    <div class="form-group">
       <label class="text-light" for="body">Body</label>
       <textarea class="form-control" name="body"  rows="3">{{$post->body}}</textarea>
    </div>
    <div class="form-group">
      @foreach ($tags as $tag)
        <label class="text-light" for="tag"> {{$tag->name}} </label>
        <input type="checkbox" name="tags[]" value=" {{$tag->id}} " {{($post->tags->contains($tag->id) ? 'checked' : '')}}>
      @endforeach
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
