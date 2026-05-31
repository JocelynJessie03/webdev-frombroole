<section class="max-w-5xl mx-auto px-8 py-24">

    <h2 class="text-5xl font-black">
        Transaction History
    </h2>

    <div class="space-y-5 mt-14">

        @for($i=0;$i<4;$i++)

        <div class="bg-white rounded-3xl p-6 flex items-center justify-between">

            <div>

                <h3 class="font-black">
                    Oreo Blade Signature
                </h3>

                <p class="text-sm text-stone-500 mt-1">
                    24 May 2026
                </p>

            </div>

            <div class="text-right">

                <p class="font-black text-[#8C1717]">
                    Rp 45.000
                </p>

                <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold">
                    Completed
                </span>

            </div>

        </div>

        @endfor

    </div>

</section>