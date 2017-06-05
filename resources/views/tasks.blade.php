@extends('layout')


@section('content')

    <tasks
        :content=" {{ json_encode($tasks) }}" {{-- Passando para o component task --}}
    ></tasks>

@endsection
