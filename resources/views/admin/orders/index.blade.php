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
        @dd($order)
            <td>{{$order->date}}</td>
            <td>{{$order->total_price}}</td>
            <td>{{$order->customer_name}}</td>
            <td>{{$order->customer_address}}</td>
            <td>{{$order->customer_email}}</td>
            <td>{{$order->customer_phone}}</td>

            @foreach ($order->products as $product )
                <p>{{$product->name}}</p>
            @endforeach

        @empty
            <td>No orders yet!</td>
        @endforelse

        </tbody>
      </table>

@endsection
