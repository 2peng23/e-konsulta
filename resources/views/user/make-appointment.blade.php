@extends('layouts.user')

@section('content')
    @include('default.appointment', compact('doctor'))
@endsection
