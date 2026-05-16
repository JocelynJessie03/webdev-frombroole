@extends('partials.sidebar')

@section('content')

<div class="space-y-4">

    {{-- HEADER --}}
    <div class="flex justify-between items-start">

        <div>

            <h1 class="text-3xl font-black text-[#1b1b1b] mb-1">
                Customer Directory
            </h1>

            <p class="text-gray-500 text-sm">
                Manage your customer relationships and loyalty programs.
            </p>

        </div>

        <button class="bg-[#7b0000] hover:bg-[#650000] text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow">

            <i data-lucide="user-plus" class="w-4 h-4"></i>

            <span class="font-semibold text-sm">
                Add New Customer
            </span>

        </button>

    </div>



    {{-- MEMBERSHIP STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- GOLD --}}
    <div class="bg-[#fff9e9] border border-[#f6e7a8] rounded-2xl p-5 text-center flex flex-col items-center justify-center">
        <i data-lucide="star" class="w-5 h-5 text-yellow-600 mb-3"></i>
        <p class="uppercase tracking-widest text-[10px] font-bold text-yellow-700 mb-2">
            Gold Members
        </p>
        <h2 class="text-3xl font-black text-yellow-700">{{ $goldCount }}</h2>
    </div>

    {{-- SILVER --}}
    <div class="bg-[#f5f5f5] border rounded-2xl p-5 text-center flex flex-col items-center justify-center">
        <i data-lucide="star" class="w-5 h-5 text-gray-600 mb-3"></i>
        <p class="uppercase tracking-widest text-[10px] font-bold text-gray-600 mb-2">
            Silver Members
        </p>
        <h2 class="text-3xl font-black text-gray-700">{{ $silverCount }}</h2>
    </div>

    {{-- BRONZE --}}
    <div class="bg-[#fff5ec] border border-[#ffd8b5] rounded-2xl p-5 text-center flex flex-col items-center justify-center">
        <i data-lucide="star" class="w-5 h-5 text-orange-600 mb-3"></i>
        <p class="uppercase tracking-widest text-[10px] font-bold text-orange-600 mb-2">
            Bronze Members
        </p>
        <h2 class="text-3xl font-black text-orange-600">{{ $bronzeCount }}</h2>
    </div>

    </div>



    {{-- TABLE --}}
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">

        {{-- SEARCH --}}
        <div class="p-4 flex justify-between items-center border-b">

            <div class="bg-[#f7f5f3] rounded-full px-4 py-2.5 flex items-center gap-3 w-[360px]">

                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>

                <input
                    type="text"
                    placeholder="Search customer..."
                    class="bg-transparent outline-none w-full text-sm"
                >

            </div>


            <div class="flex gap-2">

                <button class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm">

                    <i data-lucide="trending-up" class="w-4 h-4"></i>

                    Top Spenders

                </button>


                <button class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm">

                    <i data-lucide="star" class="w-4 h-4"></i>

                    Tier Filter

                </button>

            </div>

        </div>



        {{-- TABLE --}}
        <table class="w-full">

            <thead class="bg-[#faf7f5]">

                <tr class="text-left text-gray-400 uppercase tracking-widest text-[10px]">

                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Contact</th>
                    <th class="px-6 py-4">Total Spend</th>
                    <th class="px-6 py-4">Visits</th>
                    <th class="px-6 py-4">Loyalty Points</th>
                    <th class="px-6 py-4">Tier</th>
                    <th class="px-6 py-4">Action</th>

                </tr>

            </thead>


            <tbody>

                
                @foreach($customers as $customer)
<tr class="border-t hover:bg-gray-50 transition">
    {{-- CUSTOMER --}}
    <td class="px-6 py-5">
        <div class="flex items-center gap-3">
            {{-- Karena di migration tidak ada kolom image, kita gunakan UI Avatars sebagai fallback --}}
            <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->customer_name) }}&background=random" 
                 class="w-12 h-12 rounded-xl object-cover">
            <div>
                <h3 class="font-bold text-base">{{ $customer->customer_name }}</h3>
                <span class="text-[10px] text-gray-400 font-mono">{{ $customer->customer_ID }}</span>
            </div>
        </div>
    </td>

    {{-- CONTACT --}}
    <td class="px-6 py-5">
        <div class="space-y-1 text-sm text-gray-600">
            <div class="flex items-center gap-2"><i data-lucide="mail" class="w-4 h-4"></i> {{ $customer->email }}</div>
            <div class="flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4"></i> {{ $customer->phone }}</div>
        </div>
    </td>

    {{-- TOTAL SPEND --}}
    <td class="px-6 py-5">
        <h3 class="font-bold text-lg">Rp {{ number_format($customer->total_spend, 0, ',', '.') }}</h3>
    </td>

    {{-- VISITS (Jika belum ada kolom visits di migration, bisa di-count dari relasi orders) --}}
    <td class="px-6 py-5">
        <div class="font-semibold text-sm">
            {{ $customer->orders->count() }} visits
        </div>
    </td>

    {{-- LOYALTY POINTS --}}
    <td class="px-6 py-5">
        <div class="flex items-center gap-3">
            <div class="w-24 h-2 bg-gray-100 rounded-full overflow-hidden">
                {{-- Progress bar: asumsikan 5000 pts adalah target --}}
                <div class="bg-[#7f876e] h-full rounded-full" style="width: {{ min(($customer->member_points / 5000) * 100, 100) }}%"></div>
            </div>
            <span class="text-sm font-semibold text-[#7f876e]">
                {{ $customer->member_points }} pts
            </span>
        </div>
    </td>

    {{-- TIER --}}
    <td class="px-6 py-5">
        @php
            $tierStyles = [
                'Gold' => 'bg-[#fff2c9] text-yellow-700',
                'Silver' => 'bg-gray-100 text-gray-600',
                'Bronze' => 'bg-[#ffe7d1] text-orange-700',
            ];
            $style = $tierStyles[$customer->tier] ?? 'bg-gray-100 text-gray-600';
        @endphp
        <div class="{{ $style }} px-4 py-1 rounded-full text-xs font-bold inline-block uppercase">
            {{ $customer->tier }}
        </div>
    </td>

    {{-- ACTION --}}
    <td class="px-6 py-5">
        <div class="flex gap-3 text-[#7b0000]">
            {{-- Mengirim data name ke fungsi modal --}}
            <button onclick="openHistory('{{ $customer->customer_name }}')" class="hover:scale-110 transition">
                <i data-lucide="history" class="w-4 h-4"></i>
            </button>
            <button class="hover:scale-110 transition">
                <i data-lucide="ellipsis" class="w-4 h-4"></i>
            </button>
        </div>
    </td>
</tr>
@endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
{{-- MODAL HISTORY --}}
<div id="historyModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl">
        {{-- Modal Header --}}
        <div class="p-6 border-b flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold">Transaction History</h2>
                <p class="text-sm text-gray-500" id="modalCustomerName"></p>
            </div>
            <button onclick="closeHistory()" class="text-gray-400 hover:text-black">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        {{-- Modal Body (List Transaksi) --}}
        <div class="p-6 max-h-[400px] overflow-y-auto space-y-4">
            {{-- Contoh Item Transaksi --}}
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl">
                <div>
                    <p class="font-bold text-sm">Sea Salt Butterscotch Coffee</p>
                    <p class="text-xs text-gray-400">12 May 2026 • 14:20</p>
                </div>
                <p class="font-black text-[#7b0000]">Rp 35.000</p>
            </div>

            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl">
                <div>
                    <p class="font-bold text-sm">Oreo Cheesecake</p>
                    <p class="text-xs text-gray-400">10 May 2026 • 11:05</p>
                </div>
                <p class="font-black text-[#7b0000]">Rp 45.000</p>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="p-6 border-t bg-gray-50 flex justify-end">
            <button onclick="closeHistory()" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-xl font-bold text-sm">
                Close
            </button>
        </div>
    </div>
</div>

{{-- SCRIPT SEDERHANA --}}
<script>
    function openHistory(name) {
        document.getElementById('modalCustomerName').innerText = "Viewing transactions for " + name;
        document.getElementById('historyModal').classList.remove('hidden');
    }

    function closeHistory() {
        document.getElementById('historyModal').classList.add('hidden');
    }

    // Menutup modal jika klik di luar area modal
    window.onclick = function(event) {
        const modal = document.getElementById('historyModal');
        if (event.target == modal) {
            closeHistory();
        }
    }
</script>