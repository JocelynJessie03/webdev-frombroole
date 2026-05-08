@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl p-8 border">

    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold">
            Point Of Sale
        </h1>

        <button class="bg-blue-600 text-white px-5 py-3 rounded-xl">
            Checkout
        </button>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @for($i = 1; $i <= 6; $i++)

        <div class="border rounded-2xl p-5">

            <div class="h-40 bg-gray-100 rounded-xl mb-4"></div>

            <h3 class="font-bold text-lg mb-2">
                Coffee Product {{ $i }}
            </h3>

            <p class="text-gray-500 mb-4">
                Premium coffee beans.
            </p>

            <div class="flex justify-between items-center">

                <span class="font-bold text-blue-600">
                    Rp 50.000
                </span>

                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Add
                </button>

            </div>

        </div>

        @endfor

    </div>

</div>

@endsection