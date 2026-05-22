@extends('partials.sidebar')

@section('content')

<div class="flex gap-6">

    {{-- LEFT --}}
    <div class="flex-1">

        {{-- CATEGORY --}}
        <div class="flex gap-4 mb-8 overflow-x-auto pb-2">

            <a href="{{ route('pos') }}"
               class="{{ !request('category') ? 'bg-[#7b0000] text-white' : 'bg-white border border-gray-200' }} px-7 py-3 rounded-full text-sm font-bold whitespace-nowrap transition">

                All Products

            </a>

            @foreach($categories as $category)

                <a href="{{ route('pos', ['category' => $category->id]) }}"
                   class="{{ request('category') == $category->id ? 'bg-[#7b0000] text-white' : 'bg-white border border-gray-200' }} px-7 py-3 rounded-full text-sm whitespace-nowrap transition hover:border-[#7b0000]">

                    {{ $category->category_name }}

                </a>

            @endforeach

        </div>



        {{-- PRODUCT GRID --}}
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">

            @foreach($products as $product)

                <div class="bg-white rounded-[30px] overflow-hidden border border-gray-200 shadow-sm">

                    {{-- IMAGE --}}
                    <div class="relative h-[170px] bg-gray-100">

                        @if($product->pro_image)

                            <img src="{{ asset('storage/' . $product->pro_image) }}"
                                 class="w-full h-full object-cover">

                        @else

                            <div class="flex items-center justify-center h-full text-gray-400">

                                NO IMAGE

                            </div>

                        @endif

                        <div class="absolute top-3 right-3 bg-[#eaf8ef] text-green-700 text-[11px] font-bold px-4 py-2 rounded-full">
                            Available
                        </div>

                    </div>



                    {{-- CONTENT --}}
                    <div class="p-5">

                        <p class="uppercase tracking-[3px] text-[10px] text-gray-400 font-bold mb-3">
                            {{ $product->category->category_name }}
                        </p>

                        <h3 class="text-[16px] font-black mb-6 min-h-[50px]">
                            {{ $product->pro_name }}
                        </h3>

                        <div class="flex justify-between items-end">

                            <p class="text-[#7b0000] text-[14px] font-black">
                                Rp {{ number_format($product->pro_price, 0, ',', '.') }}
                            </p>

                            <div class="text-right">

                                <p class="text-[10px] text-gray-400 uppercase font-bold">
                                    ID:
                                </p>

                                <p class="text-[11px] text-gray-400 font-bold">
                                    {{ $product->pro_ID }}
                                </p>

                            </div>

                        </div>



                        {{-- BUTTON --}}
                        <button
                            onclick="addToCart(
                                {{ $product->id }},
                                '{{ $product->pro_name }}',
                                {{ $product->pro_price }}
                            )"

                            class="w-full mt-4 bg-[#f7f5f3] hover:bg-[#7b0000] hover:text-white py-3 rounded-2xl text-[11px] font-black transition-all">

                            ADD TO ORDER

                        </button>

                    </div>

                </div>

            @endforeach

        </div>

    </div>



    {{-- RIGHT PANEL --}}
    <div class="w-[320px] bg-white rounded-[30px] border border-gray-200 shadow-sm p-6 h-fit sticky top-5">

        {{-- HEADER --}}
        <div class="mb-8">

            <h2 class="text-[28px] font-black text-[#7b0000] mb-3">
                Current Order
            </h2>

            <p class="uppercase tracking-[3px] text-[10px] text-gray-400 font-bold">
                ORDER POS
            </p>

        </div>



        {{-- CART --}}
        <div id="cart-items"></div>



        {{-- TOTAL --}}
        <div class="border-t pt-6 space-y-4">

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Subtotal
                </span>

                <span class="font-bold" id="subtotal">
                    Rp 0
                </span>

            </div>

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Tax
                </span>

                <span class="font-bold" id="tax">
                    Rp 0
                </span>

            </div>

            <div class="flex justify-between items-center">

                <span class="text-[20px] font-black">
                    Total
                </span>

                <span class="text-[#7b0000] text-[20px] font-black" id="total">
                    Rp 0
                </span>

            </div>

        </div>



        {{-- CHECKOUT --}}
        <form
            action="{{ route('checkout.preview') }}"
            method="POST"
            onsubmit="return validateCheckout()"
        >

            @csrf

            <input type="hidden" name="cart" id="cart-input">

            <button
                type="submit"
                id="checkout-btn"
                disabled
                class="w-full bg-gray-300 text-gray-500 cursor-not-allowed py-4 rounded-2xl font-black text-lg mt-8 transition">

                Checkout

            </button>

        </form>

    </div>

</div>



<script>

let cart = [];

function addToCart(id, name, price)
{
    let existing = cart.find(item => item.id === id);

    if(existing)
    {
        existing.qty++;
    }
    else
    {
        cart.push({
            id,
            name,
            price,
            qty: 1
        });
    }

    renderCart();
}



function increaseQty(id)
{
    let item = cart.find(item => item.id === id);

    item.qty++;

    renderCart();
}



function decreaseQty(id)
{
    let item = cart.find(item => item.id === id);

    item.qty--;

    if(item.qty <= 0)
    {
        cart = cart.filter(item => item.id !== id);
    }

    renderCart();
}



function validateCheckout()
{
    if(cart.length === 0)
    {
        alert("You haven't added any product");

        return false;
    }

    return true;
}



function renderCart()
{
    let cartContainer = document.getElementById('cart-items');

    cartContainer.innerHTML = '';

    let subtotal = 0;

    cart.forEach(item => {

        subtotal += item.price * item.qty;

        cartContainer.innerHTML += `

        <div class="flex justify-between items-center mb-5 border-b pb-4">

            <div class="flex-1">

                <h3 class="font-black text-sm">
                    ${item.name}
                </h3>

                <p class="text-[#7b0000] font-bold text-sm">
                    Rp ${item.price.toLocaleString('id-ID')}
                </p>

            </div>

            <div class="flex items-center gap-3">

                <button
                    type="button"
                    onclick="decreaseQty(${item.id})"
                    class="bg-gray-200 w-8 h-8 rounded-full font-black">

                    -

                </button>

                <span class="font-black">
                    ${item.qty}
                </span>

                <button
                    type="button"
                    onclick="increaseQty(${item.id})"
                    class="bg-[#7b0000] text-white w-8 h-8 rounded-full font-black">

                    +

                </button>

            </div>

        </div>

        `;
    });

    let tax = subtotal * 0.10;

    let total = subtotal + tax;

    document.getElementById('subtotal').innerHTML =
        'Rp ' + subtotal.toLocaleString('id-ID');

    document.getElementById('tax').innerHTML =
        'Rp ' + tax.toLocaleString('id-ID');

    document.getElementById('total').innerHTML =
        'Rp ' + total.toLocaleString('id-ID');

    document.getElementById('cart-input').value =
        JSON.stringify(cart);



    let checkoutBtn = document.getElementById('checkout-btn');

    if(cart.length > 0)
    {
        checkoutBtn.disabled = false;

        checkoutBtn.classList.remove(
            'bg-gray-300',
            'text-gray-500',
            'cursor-not-allowed'
        );

        checkoutBtn.classList.add(
            'bg-[#7b0000]',
            'text-white',
            'hover:bg-[#650000]'
        );
    }
    else
    {
        checkoutBtn.disabled = true;

        checkoutBtn.classList.remove(
            'bg-[#7b0000]',
            'text-white',
            'hover:bg-[#650000]'
        );

        checkoutBtn.classList.add(
            'bg-gray-300',
            'text-gray-500',
            'cursor-not-allowed'
        );
    }
}

</script>

@endsection