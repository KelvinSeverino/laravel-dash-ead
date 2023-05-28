@extends('admin.layouts.app')

@section('title', 'Usuários')

@section('content')

@foreach ($users as $key => $user)
    {{ $user->name }}
@endforeach

@endsection
