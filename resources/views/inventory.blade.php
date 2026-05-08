@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl p-8 border">

    <h1 class="text-3xl font-bold mb-8">
        Inventory Management
    </h1>

    <table class="w-full">

        <thead>
            <tr class="border-b">
                <th class="text-left py-4">Product</th>
                <th class="text-left py-4">Stock</th>
                <th class="text-left py-4">Status</th>
            </tr>
        </thead>

        <tbody>

            @for($i = 1; $i <= 5; $i++)

            <tr class="border-b">
                <td class="py-4">Coffee Beans {{ $i }}</td>
                <td class="py-4">{{ rand(10,100) }}</td>
                <td class="py-4">
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                        In Stock
                    </span>
                </td>
            </tr>

            @endfor

        </tbody>

    </table>

</div>

@endsection