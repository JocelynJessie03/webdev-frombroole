@extends('layouts.app')

@section('content')

<div class="bg-white rounded-3xl p-8 border">

    <h1 class="text-3xl font-bold mb-8">
        Customers
    </h1>

    <div class="space-y-4">

        @for($i = 1; $i <= 8; $i++)

        <div class="border rounded-2xl p-5 flex justify-between items-center">

            <div class="flex items-center gap-4">

                <img
                    src="https://i.pravatar.cc/50?img={{ $i }}"
                    class="w-12 h-12 rounded-full"
                >

                <div>
                    <h3 class="font-bold">
                        Customer {{ $i }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        customer{{ $i }}@gmail.com
                    </p>
                </div>

            </div>

            <button class="text-blue-600 font-semibold">
                View
            </button>

        </div>

        @endfor

    </div>

</div>

@endsection