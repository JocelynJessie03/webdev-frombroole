<?php $__env->startSection('content'); ?>

<div class="flex gap-6">

    
    <div class="flex-1">

        
        <div class="mb-6 relative">
            <input type="text" id="search-product" placeholder="Search products..." 
                   class="w-full border border-gray-200 rounded-full px-6 py-4 outline-none focus:border-[#7b0000] shadow-sm font-plain text-gray-600 pl-12 transition-all">
            
            
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute left-4 top-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        
        <div class="flex gap-4 mb-8 overflow-x-auto pb-2">
            <a href="<?php echo e(route('pos')); ?>"
               class="<?php echo e(!request('category') ? 'bg-[#7b0000] text-white' : 'bg-white border border-gray-200'); ?> px-7 py-3 rounded-full text-sm font-bold whitespace-nowrap transition">
                All Products
            </a>

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('pos', ['category' => $category->id])); ?>"
                   class="<?php echo e(request('category') == $category->id ? 'bg-[#7b0000] text-white' : 'bg-white border border-gray-200'); ?> px-7 py-3 rounded-full text-sm whitespace-nowrap transition hover:border-[#7b0000]">
                    <?php echo e($category->category_name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6" id="product-grid">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <div class="product-card bg-white rounded-[30px] overflow-hidden border border-gray-200 shadow-sm flex flex-col justify-between" 
                     data-name="<?php echo e(strtolower($product->pro_name)); ?>">
                    
                    <div>
                      
<div class="relative h-[220px] bg-gray-100 overflow-hidden">

    
    <div class="flex w-full h-full overflow-x-auto snap-x snap-mandatory scrollbar-hide">

        
        <div class="min-w-full h-full snap-center">

            <?php if($product->pro_image): ?>

                <img
                    src="<?php echo e(asset('products/' . rawurlencode($product->pro_image))); ?>"
                    class="w-full h-full object-cover"
                >

            <?php else: ?>

                <div class="flex items-center justify-center h-full text-gray-400 font-bold text-xs">
                    NO IMAGE
                </div>

            <?php endif; ?>

        </div>

    </div>



    
    <?php if($product->calculated_stock > 0): ?>

        <div class="absolute top-3 right-3 bg-[#eaf8ef] text-green-700 text-[11px] font-bold px-4 py-2 rounded-full z-10">
            Available
        </div>

    <?php else: ?>

        <div class="absolute top-3 right-3 bg-red-100 text-red-600 text-[11px] font-bold px-4 py-2 rounded-full z-10">
            Out of Stock
        </div>

    <?php endif; ?>

</div>

                        
                        <div class="p-5 pb-0">
                            <p class="uppercase tracking-[3px] text-[10px] text-gray-400 font-bold mb-2">
                                <?php echo e($product->category->category_name); ?>

                            </p>

                            <h3 class="text-[18px] font-black leading-tight mb-2 min-h-[45px]">
                                <?php echo e($product->pro_name); ?>

                            </h3>

                            
                            <div class="mb-4">
                                <?php if($product->calculated_stock > 5): ?>
                                    <span class="text-xs font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-md">
                                        Stock: <?php echo e($product->calculated_stock); ?> pcs
                                    </span>
                                <?php elseif($product->calculated_stock <= 5 && $product->calculated_stock > 0): ?>
                                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-md animate-pulse">
                                        Low Stock: <?php echo e($product->calculated_stock); ?> pcs Left
                                    </span>
                                <?php else: ?>
                                    <span class="text-xs font-bold text-red-600 bg-red-50 px-3 py-1 rounded-md">
                                        Sold Out
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="p-5 pt-0">
                        <div class="flex justify-between items-end mb-2">
                            <p class="text-[#7b0000] text-[20px] font-black">
                                Rp <?php echo e(number_format($product->pro_price, 0, ',', '.')); ?>

                            </p>
                        </div>

                        
                        <button
                            type="button"
                            onclick="addToCart(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->pro_name)); ?>', <?php echo e($product->pro_price); ?>, <?php echo e($product->calculated_stock); ?>)"
                            <?php if($product->calculated_stock <= 0): ?> disabled <?php endif; ?>
                            class="w-full mt-2 py-3 rounded-2xl text-[11px] font-black transition-all
                            <?php echo e($product->calculated_stock > 0 
                                ? 'bg-[#f7f5f3] text-black hover:bg-[#7b0000] hover:text-white cursor-pointer' 
                                : 'bg-gray-100 text-gray-400 cursor-not-allowed'); ?>">
                            ADD TO ORDER
                        </button>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        
        <div id="no-product-msg" class="hidden text-center text-gray-400 font-bold mt-10">
            No products found matching your search.
        </div>
        
    </div>

    
    <div class="w-[320px] bg-white rounded-[30px] border border-gray-200 shadow-sm p-6 h-fit sticky top-5">
        
        <div class="mb-8">
            <h2 class="text-[28px] font-black text-[#7b0000] mb-3">Current Order</h2>
            <p class="uppercase tracking-[3px] text-[10px] text-gray-400 font-bold">ORDER POS</p>
        </div>

        
        <div id="cart-items" class="max-h-[350px] overflow-y-auto pr-1"></div>

        
        <div class="border-t pt-6 space-y-4">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Subtotal</span>
                <span class="font-bold" id="subtotal">Rp 0</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Tax (10%)</span>
                <span class="font-bold" id="tax">Rp 0</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[20px] font-black">Total</span>
                <span class="text-[#7b0000] text-[20px] font-black" id="total">Rp 0</span>
            </div>
        </div>

        
        <form action="<?php echo e(route('checkout.preview')); ?>" method="POST" onsubmit="return validateCheckout()">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="cart" id="cart-input">
            <button type="submit" id="checkout-btn" disabled
                    class="w-full bg-gray-300 text-gray-500 cursor-not-allowed py-4 rounded-2xl font-black text-lg mt-8 transition-all">
                Checkout
            </button>
        </form>

    </div>
</div>

<script>
// =========================
// FITUR SEARCH (REAL-TIME)
// =========================
document.getElementById('search-product').addEventListener('input', function(e) {
    let keyword = e.target.value.toLowerCase();
    let cards = document.querySelectorAll('.product-card');
    let visibleCount = 0;

    cards.forEach(card => {
        let productName = card.getAttribute('data-name');
        if(productName.includes(keyword)) {
            card.style.display = 'flex'; // Munculkan kembali
            visibleCount++;
        } else {
            card.style.display = 'none'; // Sembunyikan
        }
    });

    // Tampilkan pesan jika tidak ada yang cocok
    let noMsg = document.getElementById('no-product-msg');
    if(visibleCount === 0) {
        noMsg.classList.remove('hidden');
    } else {
        noMsg.classList.add('hidden');
    }
});


// =========================
// LOGIKA KERANJANG KASIR
// =========================
let cart = [];

function addToCart(id, name, price, maxStock)
{
    let existing = cart.find(item => item.id === id);

    if(existing)
    {
        if(existing.qty >= maxStock) {
            alert(`Sorry, cannot add more items. Remaining raw material stock only allows ${maxStock} units for ${name}.`);
            return;
        }
        existing.qty++;
    }
    else
    {
        if(maxStock <= 0) {
            alert("This product is currently out of stock.");
            return;
        }
        cart.push({
            id,
            name,
            price,
            maxStock,
            qty: 1
        });
    }

    renderCart();
}

function increaseQty(id)
{
    let item = cart.find(item => item.id === id);

    if(item.qty >= item.maxStock) {
        alert(`Maximum limits reached. Only ${item.maxStock} units available based on ingredient stock.`);
        return;
    }

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
            <div class="flex-1 pr-2">
                <h3 class="font-black text-sm leading-tight">${item.name}</h3>
                <p class="text-[#7b0000] font-bold text-xs mt-1">
                    Rp ${item.price.toLocaleString('id-ID')}
                </p>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" onclick="decreaseQty(${item.id})"
                        class="bg-gray-200 w-7 h-7 rounded-full font-black text-xs flex items-center justify-center hover:bg-gray-300 transition">
                    -
                </button>
                <span class="font-black text-sm w-4 text-center">
                    ${item.qty}
                </span>
                <button type="button" onclick="increaseQty(${item.id})"
                        class="bg-[#7b0000] text-white w-7 h-7 rounded-full font-black text-xs flex items-center justify-center hover:bg-[#650000] transition">
                    +
                </button>
            </div>
        </div>
        `;
    });

    let tax = subtotal * 0.10;
    let total = subtotal + tax;

    document.getElementById('subtotal').innerHTML = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('tax').innerHTML = 'Rp ' + tax.toLocaleString('id-ID');
    document.getElementById('total').innerHTML = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('cart-input').value = JSON.stringify(cart);

    let checkoutBtn = document.getElementById('checkout-btn');

    if(cart.length > 0)
    {
        checkoutBtn.disabled = false;
        checkoutBtn.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
        checkoutBtn.classList.add('bg-[#7b0000]', 'text-white', 'hover:bg-[#650000]');
    }
    else
    {
        checkoutBtn.disabled = true;
        checkoutBtn.classList.remove('bg-[#7b0000]', 'text-white', 'hover:bg-[#650000]');
        checkoutBtn.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
    }
}


</script>

<style>

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Herd\webdev-frombroole\resources\views/pos.blade.php ENDPATH**/ ?>