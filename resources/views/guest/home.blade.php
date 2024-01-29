@extends('layouts.guest')

@section('content')
<div class="container fs-5 ">
@guest
@if (Route::has('login'))

<div class="card register-login d-flex flex-column">
    <div class="card-header d-flex flex-column justify-content-center align-items-center">
        <h2>Welcome to DeliveBoo!</h2>
    </div>
    <div class="content p-2">
        <p>
            If you've found your way here, it means you're interested in having your restaurant being a part of the Deliveboo family, or perhaps you're already a valuable member of our community.
            <br />
        </p>

        <p class="mt-4">
            We extend a warm invitation for you to join us! You're more than welcome to
            <a class="fw-bold text-black" href="{{ route('register') }}">{{ __('Register') }}</a> or <a class="fw-bold text-black" href="{{ route('login') }}">{{ __('Login') }}</a> and collaborate with us!
        </p>
        @endif
        @else

            <h2>Thank you for taking the time to register and log in!</h2>
            <p class="mt-4">
                At Deliveboo, you are an essential part of our community. We truly appreciate your engagement and value your feedback. Our platform is constantly evolving, and we are open to any suggestions you may have to enhance your experience.
                <br />
                Feel free to share your thoughts, ideas, or any features you'd like to see implemented. We're here to help your restaurant grow as much as possible.
            </p>



    </div>


    @endguest
    <div class="images d-flex justify-content-center p-5">
        <img class="image logged w-25" src="/img/bg-register.png" alt="register">
    </div>

</div>
</div>

@endsection

