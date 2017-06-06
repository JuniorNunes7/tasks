@extends('layout')


@section('content')

    <div class="col-md-6 col-md-offset-3">
        <tasks
            :content=" {{ json_encode($tasks) }}" {{-- Passando para o component task --}}
        ></tasks>
    </div>

@endsection
