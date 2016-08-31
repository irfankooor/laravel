@extends('layouts.master')
@section('content')
<h1>Domino Martabak - Order</h1>
<table class="table table-hover table-striped">
<thead>
<tr>
<th>Customer</th>
<th>Tipe</th>
<th>Jumlah</th>
<th>Alamat</th>
<th>Tanggal Order</th>
<th></th>
</tr>
</thead>
<tbody>
@foreach (App\Order::all() as $order)
<tr>
<td>{{ $order->customer }}</td>
<td>{{ $order->tipe }}</td>
<td>{{ $order->jumlah }}</td>
<td>{{ $order->alamat }}</td>
<td>{{ $order->created_at->format('M d, Y') }}</td>
<td>edit | delete</td>
</tr>
@endforeach
</tbody>
</table>
@stop
