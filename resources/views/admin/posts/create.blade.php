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

  <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="form-group">
      <label class="text-light" for="title">Titolo</label>
      <input type="text" name="title" class="form-control" placeholder="Inserisci il titolo">
    </div>
    <div class="form-group">
      <label class="text-light" for="img">Immagine</label>
      <input class="text-light" type="file" name="img" accept="image/*" >
    </div>

    <div class="form-group">
       <label class="text-light" for="body">Body</label>
       <textarea class="form-control" name="body" rows="3"></textarea>
    </div>
    <div class="form-group">
    @foreach ($tags as $tag)
      <label class="text-light" for="tag">{{$tag->name}}</label>
      <input type="checkbox" name="tags[]" value="{{$tag->id}}">
    @endforeach
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
