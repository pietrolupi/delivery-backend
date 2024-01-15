@extends('layouts.admin')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('updated'))
        <div class="alert alert-success" role="alert">
            {{ session('updated') }}
        </div>
    @endif

    @if (session('deleted'))
        <div class="alert alert-success" role="alert">
            {{ session('deleted') }}
        </div>
    @endif
@endsection
