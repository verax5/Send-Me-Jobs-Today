@extends('layouts.main')
@section('content')
    <form method="POST" action="{{ route('create.company') }}">
        <input type="text" name="name">
        {{ csrf_field() }}
        <button type="submit">Create</button>
    </form>

    @foreach($companies as $c)
        <a href="{{ route('expand.company', ['company_id' => $c->id]) }}">{{ $c->name }}</a> <br>
    @endforeach
@endsection