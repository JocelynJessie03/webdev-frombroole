@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-3xl p-8 border">
        <h3 class="text-gray-500 mb-2">Revenue</h3>
        <p class="text-4xl font-bold text-blue-600">Rp 42M</p>
    </div>

    <div class="bg-white rounded-3xl p-8 border">
        <h3 class="text-gray-500 mb-2">Orders</h3>
        <p class="text-4xl font-bold text-blue-600">1,250</p>
    </div>

    <div class="bg-white rounded-3xl p-8 border">
        <h3 class="text-gray-500 mb-2">Customers</h3>
        <p class="text-4xl font-bold text-blue-600">420</p>
    </div>

</div>

@endsection