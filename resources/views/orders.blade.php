@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl p-8 border">

    <h1 class="text-3xl font-bold mb-8">
        Orders
    </h1>

    <div class="space-y-4">

        @for($i = 1; $i <= 10; $i++)

        <div class="border rounded-2xl p-5 flex justify-between items-center">

            <div>
                <h3 class="font-bold">
                    Order #TRX-{{ 1000 + $i }}
                </h3>

                <p class="text-gray-500 text-sm">
                    2 Items Purchased
                </p>
            </div>

            <span class="font-bold text-blue-600">
                Rp 125.000
            </span>

        </div>

        @endfor

    </div>

</div>

@endsection