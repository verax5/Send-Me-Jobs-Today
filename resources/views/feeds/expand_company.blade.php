@extends('layouts.main')
@section('content')
    {{ $company->name }}

    <form method="POST" action="{{ route('download.feed', ['company_id' => $company->id]) }}">
        Feed URL: <input name="url">
        {{ csrf_field() }}
        <button type="submit">Download</button>
    </form>
@endsection