@extends('layouts.admin')

@section('content')
<div class="home">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1 class= m-5>Welcome to DeliveBoo</h1>
        <div class="d-xl-flex align-items-center gap-5 p-5">
            <div class="px-5">
                <h3 class="subtitle pb-3" >Get ready to embark on a delicious journey <br> with Deliveboo!</h3>
                <h5>We're here to make your dining experience a breeze. From hometown favorites to exotic cuisines, our diverse selection is just a tap away.</h5>
                <p>Why settle for ordinary when you can have extraordinary? Explore our app, place your order, and let the flavors come to you. Fast, reliable, and always satisfying – that's Deliveboo!</p>
            </div>
            <div class=" image px-5">
                <img class="w-100 h-100 object-fit-cover rounded-5" src="/img/deliveryman.png" alt="logo">
            </div>
        </div>
        <div class="beta d-xl-flex align-items-center gap-5 p-5">
            <div class="image px-5 d-flex align-items-center justify-content-center mb-3">
                <img class="w-50 h-100 object-fit-cover" src="/img/Cheatboo-fam.png" alt="logo">
            </div>
            <div class="text px-5">
                <h3 class="subtitle pb-3" >Meet Cheetboo & his family</h3>
                <h5>Cheetboo and his family are our friendly cheetah mascot, they  will be around the page helping you and delivering your food with lightning speed! Imagine the thrill of a swift cheetah at your doorstep, ensuring your meals are served fresh and fast.</h5>
                <p>Swift, friendly, and reliable – that's the Cheetboo family promise!</p>
            </div>
        </div>
        <div class=" comitments d-flex justify-content-center align-items-center gap-5 p-5 ">
            <div class="text px-5 mx-xl-5">
                <h3 class="subtitle pb-3" >Deliveboo's Comitments</h3>
                <h5>At Deliveboo, we're more than a delivery service; we're your foodie ally dedicated to elevating your dining adventures. Our commitment is simple and straightforward:</h5>
                <ul class="list-unstyled lh-lg ">
                    <li>🌮 <strong>Flavorful Variety:</strong> Discover diverse flavors from local favorites.</li>
                    <li>🚀 <strong>Swift & Hot Deliveries:</strong> Enjoy prompt and piping-hot meals, delivered with speed.</li>
                    <li>💖 <strong>Local Love:</strong> Support community chefs and businesses with every order.</li>
                    <li>😊 <strong>User-Friendly Experience:</strong> Navigate our platform effortlessly for a seamless journey.</li>
                    <li>🍔 <strong>Quality Assurance:</strong> Indulge in high-quality, satisfying meals crafted with care.</li>
                    <li>💳 <strong>Transparent Transactions:</strong> Trust in secure and transparent dealings.</li>
                </ul>
                <p class="text-center">Experience joy in every bite with Deliveboo – where commitment meets culinary magic! 🍽️✨</p>
            </div>
        </div>
    </div>
</div>

@endsection
