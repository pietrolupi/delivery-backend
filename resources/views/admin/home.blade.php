@extends('layouts.admin')

@section('content')
<div class="home">
    <h1 class= m-5>Welcome in DeliveBoo</h1>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex align-items-center gap-5 p-5">
            <div class="w-50 text-center px-5">
                <h3 class="subtitle pb-3" >Get ready to embark on a delicious journey with Deliveboo!</h3>
                <h4>We're here to make your dining experience a breeze. From hometown favorites to exotic cuisines, our diverse selection is just a tap away.</h4>
                <h4>Why settle for ordinary when you can have extraordinary? Explore our app, place your order, and let the flavors come to you. Fast, reliable, and always satisfying – that's Deliveboo!</h4>
            </div>
            <div class="image w-50 px-5">
                <img class="w-100 h-100 object-fit-cover rounded-5" src="/img/deliveryman.png" alt="logo">
            </div>
        </div>
        <div class="beta d-flex align-items-center gap-5 p-5">
            <div class="image w-50 px-5 d-flex align-items-center justify-content-center">
                <img class="w-75 h-100 object-fit-cover" src="/img/Cheatboo-fam.png" alt="logo">
            </div>
            <div class="text w-50 text-center px-5">
                <h3 class="subtitle pb-3" > - Meet Cheetboo & his family -</h3>
                <h4>Cheetboo and his family are our friendly cheetah mascot, they  will be around the page helping you and delivering your food with lightning speed! Imagine the thrill of a swift cheetah at your doorstep, ensuring your meals are served fresh and fast.</h4>
                <h4>Swift, friendly, and reliable – that's the Cheetboo family promise!</h4>
            </div>
        </div>
        <div class="d-flex align-items-center gap-5 p-5 w-50">
            <div class="text text-center px-5">
                <h3 class="subtitle pb-3" >Deviveboo's Comitments</h3>
                <h4>At Deliveboo, we're more than a delivery service; we're your foodie ally dedicated to elevating your dining adventures. Our commitment is simple and straightforward:</h4>
                <ul class="list-unstyled">
                    <li>🌮 <strong>Flavorful Variety:</strong> Discover diverse flavors from local favorites.</li>
                    <li>🚀 <strong>Swift & Hot Deliveries:</strong> Enjoy prompt and piping-hot meals, delivered with speed.</li>
                    <li>💖 <strong>Local Love:</strong> Support community chefs and businesses with every order.</li>
                    <li>😊 <strong>User-Friendly Experience:</strong> Navigate our platform effortlessly for a seamless journey.</li>
                    <li>🍔 <strong>Quality Assurance:</strong> Indulge in high-quality, satisfying meals crafted with care.</li>
                    <li>💳 <strong>Transparent Transactions:</strong> Trust in secure and transparent dealings.</li>
                </ul>
                <p>Experience joy in every bite with Deliveboo – where commitment meets culinary magic! 🍽️✨</p>
            </div>
        </div>
    </div>
</div>

@endsection
