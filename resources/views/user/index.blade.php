@extends('layout.app')

@section('content')


@isset($survey)

<div class="d-flex gap-3">
@foreach($survey as $sr)
    <a href="surveys/{{ $sr->id }}" class="alert w-full alert-primary mt-4" role="alert">
        {{ $sr->name }}
    </a>
@endforeach
</div>
@endisset
@endsection

