@extends('layouts.admin')

@section('content')
    <div class="custom-card register-login">

        <div class="custom-card-title">
            <h2>Your Orders</h2>
        </div>

        <div class="custom-card-content">

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Order Total</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Customer Address</th>
            <th scope="col">Customer Email</th>
            <th scope="col">Customer Phone</th>
          </tr>
        </thead>
        <tbody>

                @forelse ($orders as $order)
                    <tr>
                        <td>
                            <ul>
                                @foreach ($order->products as $product )

                                <li class="text-decoration-none list-unstyled">
                                    <span>{{$product->name}}</span> <span> : {{$product->pivot->product_quantity}}</span>
                                </li>

                 {{--
                        <span>{{$product->pivot_product_quantity}}</span> --}}


                            @endforeach
                            </ul>
                        </td>
                        <td class="d-none d-md-table-cell">{{$order->total_price}} &euro;</td>
                        <td>{{$order->customer_name}}</td>
                        <td>{{$order->customer_address}}</td>
                        <td class="d-none d-lg-table-cell">{{$order->customer_email}}</td>
                        <td>{{$order->customer_phone}}</td>
                        <td class="d-none d-lg-table-cell">{{$order->date}}</td>


                    </tr>


                @empty
                    <td>No orders yet!</td>
                @endforelse

        </tbody>
      </table>

@endsection
