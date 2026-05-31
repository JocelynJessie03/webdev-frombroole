<?php $__env->startSection('content'); ?>

<?php
    $subtotal = 0;
    foreach($cart as $item) {
        $subtotal += $item['price'] * $item['qty'];
    }
    $tax = $subtotal * 0.10;
    $total = $subtotal + $tax;
?>

<div class="max-w-6xl mx-auto">

    <div class="flex flex-col gap-8">

        
        <div class="w-full">
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                
                
                <div class="flex items-center gap-4 mb-8">
                    <a href="<?php echo e(route('pos')); ?>" class="text-gray-400 hover:text-[#7b0000] p-2 hover:bg-gray-100 rounded-full transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <h1 class="text-4xl font-black text-[#7b0000]">
                        Checkout Preview
                    </h1>
                </div>

                
                <div class="space-y-6">
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex justify-between items-center border-b pb-5">
                            <div>
                                <h2 class="font-black text-xl mb-2"><?php echo e($item['name']); ?></h2>
                                
                                <?php if(isset($item['isDrink']) && $item['isDrink']): ?>
                                    <?php
                                        $sugarText = $item['sugarLevel'] == '100' ? 'Normal Sugar' : ($item['sugarLevel'] == '50' ? 'Less Sugar (50%)' : 'No Sugar');
                                        $badgeColor = $item['sugarLevel'] == '100' ? 'bg-gray-100 text-gray-500' : 'bg-blue-50 text-blue-600';
                                    ?>
                                    <span class="text-xs font-bold <?php echo e($badgeColor); ?> px-2 py-1 rounded-md inline-block mb-2">
                                        <?php echo e($sugarText); ?>

                                    </span>
                                <?php endif; ?>
                                <p class="text-gray-400">Qty : <?php echo e($item['qty']); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-[#7b0000] text-lg">
                                    Rp <?php echo e(number_format($item['price'] * $item['qty'], 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div class="w-full">
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                <h2 class="text-2xl font-black mb-8">Payment Summary</h2>

                
                <div class="mb-8">
                    <h3 class="font-bold mb-3 text-gray-700">Customer Type</h3>
                    <div class="flex gap-4">
                        <label class="flex-1 border rounded-xl p-3 flex items-center gap-2 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="customer_type" value="regular" checked onchange="toggleCustomerType()" class="w-4 h-4 text-[#7b0000]">
                            <span class="font-bold text-sm">Regular</span>
                        </label>
                        <label class="flex-1 border rounded-xl p-3 flex items-center gap-2 cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="customer_type" value="member" onchange="toggleCustomerType()" class="w-4 h-4 text-[#7b0000]">
                            <span class="font-bold text-sm">Member</span>
                        </label>
                    </div>
                </div>

                
                <div id="member-section" class="mb-8 hidden">
                    <label class="block text-sm font-bold mb-2">Member Phone Number</label>
                    <div class="flex gap-2 mb-2">
                        <input type="text" id="phone-input" placeholder="e.g. 08123456789" 
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:border-[#7b0000]">
                        <button type="button" onclick="checkMember()" 
                                class="bg-gray-800 hover:bg-black text-white px-5 rounded-xl font-bold transition">
                            Check
                        </button>
                    </div>
                    <p id="member-alert" class="text-xs text-red-600 font-bold hidden mb-4"></p>

                    
                    <div id="member-details" class="hidden bg-gray-50 border border-gray-200 p-4 rounded-xl space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Customer Name</label>
                            <input type="text" id="member-name" readonly class="w-full bg-gray-200 border-none rounded-lg px-3 py-2 font-bold text-gray-600">
                        </div>
                        
                        <div class="bg-white border rounded-lg p-3">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-bold text-gray-500">Available Points</span>
                                <span class="font-black text-[#7b0000]" id="available-points">0 Pts</span>
                            </div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Use Points (1 Poin = Rp 1)</label>
                            <input type="number" id="input-points" min="0" value="0" oninput="calculateTotal()"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#7b0000] text-right font-bold text-lg">
                        </div>
                    </div>
                </div>

                
                <div class="space-y-4 mb-8 bg-gray-50 p-5 rounded-2xl">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="font-bold">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Tax (10%)</span>
                        <span class="font-bold">Rp <?php echo e(number_format($tax, 0, ',', '.')); ?></span>
                    </div>
                    <div class="flex justify-between text-sm text-green-600 font-bold hidden" id="discount-row">
                        <span>Points Discount</span>
                        <span id="discount-amount">- Rp 0</span>
                    </div>
                    
                    
                    <div class="flex justify-between items-center border-t border-gray-200 pt-4">
                        <span class="text-xl font-black text-gray-800">Grand Total</span>
                        
                        <div class="flex items-baseline gap-1 text-[#7b0000]">
                            <span class="text-lg font-black uppercase">Rp</span>
                            <span class="text-2xl font-black tracking-tight" id="grand-total-text">
                                <?php echo e(number_format($total, 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>

                
                <form action="<?php echo e(route('payment.process')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="cart" value="<?php echo e(json_encode($cart)); ?>">
                    <input type="hidden" name="customer_id" id="hidden_customer_id" value="">
                    <input type="hidden" name="points_used" id="hidden_points_used" value="0">

                    
                    <div class="mb-6 bg-gray-50 p-4 rounded-2xl border border-gray-200">
                        <label class="block font-black text-gray-700 text-sm mb-3 uppercase tracking-wider">Payment Method</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            
                            <label class="flex items-center gap-3 bg-white p-4 rounded-xl border border-gray-200 cursor-pointer hover:border-[#7b0000] transition">
                                <input type="radio" name="payment_method" value="cash" checked class="accent-[#7b0000] w-4 h-4">
                                <div>
                                    <span class="block font-bold text-sm text-gray-800">Cash / Tunai</span>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 bg-white p-4 rounded-xl border border-gray-200 cursor-pointer hover:border-[#7b0000] transition">
                                <input type="radio" name="payment_method" value="midtrans" class="accent-[#7b0000] w-4 h-4">
                                <div>
                                    <span class="block font-bold text-sm text-gray-800">QRIS / GoPay</span>
                                </div>
                            </label>

                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#7b0000] hover:bg-[#650000] text-white py-5 rounded-2xl font-black text-lg transition shadow-lg">
                        Process To Payment
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    const baseTotal = <?php echo e($total); ?>;
    let maxPoints = 0;

    function toggleCustomerType() {
        const type = document.querySelector('input[name="customer_type"]:checked').value;
        const memberSection = document.getElementById('member-section');
        
        if (type === 'member') {
            memberSection.classList.remove('hidden');
        } else {
            memberSection.classList.add('hidden');
            resetMemberData();
        }
    }

    function resetMemberData() {
        document.getElementById('hidden_customer_id').value = '';
        document.getElementById('member-details').classList.add('hidden');
        document.getElementById('phone-input').value = '';
        document.getElementById('input-points').value = 0;
        document.getElementById('member-alert').classList.add('hidden');
        maxPoints = 0;
        calculateTotal();
    }

    function checkMember() {
        const phone = document.getElementById('phone-input').value;
        const alertBox = document.getElementById('member-alert');
        
        if(phone === '') {
            alertBox.innerText = 'Tolong masukkan nomor telepon!';
            alertBox.classList.remove('hidden');
            return;
        }

        fetch("<?php echo e(route('check.member')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify({ phone: phone })
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                alertBox.classList.add('hidden');
                
                document.getElementById('hidden_customer_id').value = data.data.id;
                document.getElementById('member-name').value = data.data.customer_name;
                document.getElementById('available-points').innerText = data.data.member_points.toLocaleString('id-ID') + ' Pts';
                
                maxPoints = data.data.member_points;
                document.getElementById('member-details').classList.remove('hidden');
                
                document.getElementById('input-points').value = 0;
                calculateTotal();
            } else {
                alertBox.innerText = data.message;
                alertBox.classList.remove('hidden');
                document.getElementById('member-details').classList.add('hidden');
                document.getElementById('hidden_customer_id').value = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function calculateTotal() {
        let pointsInput = document.getElementById('input-points');
        let pointsToUse = parseInt(pointsInput.value) || 0;

        if(pointsToUse > maxPoints) {
            pointsToUse = maxPoints;
            pointsInput.value = maxPoints;
        }
        
        if(pointsToUse > baseTotal) {
            pointsToUse = baseTotal;
            pointsInput.value = baseTotal;
        }

        let newGrandTotal = baseTotal - pointsToUse;

        // JAVASCRIPT HANYA MENGISI ANGKA NOMINAL TANPA MARS 'Rp ' KARENA SUDAH DIWAKILI HTML ELEMEN
        document.getElementById('grand-total-text').innerText = newGrandTotal.toLocaleString('id-ID');
        document.getElementById('hidden_points_used').value = pointsToUse;

        const discountRow = document.getElementById('discount-row');
        if(pointsToUse > 0) {
            discountRow.classList.remove('hidden');
            document.getElementById('discount-amount').innerText = '- Rp ' + pointsToUse.toLocaleString('id-ID');
        } else {
            discountRow.classList.add('hidden');
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/checkout_preview.blade.php ENDPATH**/ ?>