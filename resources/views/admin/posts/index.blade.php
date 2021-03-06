@extends('layouts.app')
@section('content')
  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif

  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <th scope="row">{{$post->id}}</th>
        <td>{{$post->title}}</td>
        <td>
          <form action="{{route('posts.edit', $post->id)}}" method="post">
            @csrf
            @method('GET')
            <button type="submit" class="btn btn-warning">Edit</button>
          </form>
        </td>
        {{-- <td> <a href="{{route('posts.edit', $post->id)}}">Edit</a> </td> --}}
        <td>
          <form action="{{route('posts.destroy', $post->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Cancella</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection
