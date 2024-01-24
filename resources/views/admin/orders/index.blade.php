@extends('layouts.admin')

@section('content')
    <h1>INDEX ORDERS</h1>

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
                <td>{{$order->date}}</td>
                <td>{{$order->total_price}}</td>
                <td>{{$order->customer_name}}</td>
                <td>{{$order->customer_address}}</td>
                <td>{{$order->customer_email}}</td>
                <td>{{$order->customer_phone}}</td>

                <td>
                    <ul>
                        @foreach ($order->products as $product )

                        <li class="text-decoration-none list-unstyled">
                            <span><strong>{{$product->name}}</strong></span> <span> : {{$product->pivot->product_quantity}}</span>
                        </li>

                 {{--
                        <span>{{$product->pivot_product_quantity}}</span> --}}


                    @endforeach
                    </ul>
                </td>

            </tr>


        @empty
            <td>No orders yet!</td>
        @endforelse

        </tbody>
      </table>

@endsection
