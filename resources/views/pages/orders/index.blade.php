@extends('layouts.panel')

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Orders</h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>VÖEN</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Object Name</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->company_name }}</td>
                            <td>{{ $order->voen }}</td>
                            <td>{{ $order->full_name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->object_name }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>{{ $order->comment }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
