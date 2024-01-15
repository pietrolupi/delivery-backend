@extends('layouts.admin')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1>prodotto creato</h1>

    </div>
@endsection
