@extends('layouts.guest')

@section('content')
<div class="container fs-5">
@guest
@if (Route::has('login'))
<p class="m-0">
    Welcome! If you've found your way here, it means you're interested in having your restaurant being a part of the Deliveboo family, or perhaps you're already a valuable member of our community.
    <br />
</p>
<p class="mt-4">
    We extend a warm invitation for you to join us! You're more than welcome to
    <a class="fw-bold text-black" href="{{ route('register') }}">{{ __('register') }}</a> / <a class="fw-bold text-black" href="{{ route('login') }}">{{ __('login') }}</a> and collaborate with us!
</p>
@endif
@else
<p>
    Thank you for taking the time to register and log in! At Deliveboo, you are an essential part of our community. We truly appreciate your engagement and value your feedback. Our platform is constantly evolving, and we are open to any suggestions you may have to enhance your experience.
    <br />
    Feel free to share your thoughts, ideas, or any features you'd like to see implemented. We're here to help your restaurant grow as much as possible.
</p>

@endguest
</div>
@endsection

