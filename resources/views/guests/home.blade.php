@extends('layouts.app')
@section('content')
  <div class="display-4 p-5 text-center text-light">
    Benvenuto nel mio blog
  </div>
@guest
  <p class="lead text-center text-light">Guest</p>
@else
  <p class="lead text-center text-light">Il tuo nome è: {{ Auth::user()->name }}</p>
@endguest
@endsection
