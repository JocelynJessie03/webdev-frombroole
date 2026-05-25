@extends('partials.sidebar')

@section('content')

<div class="space-y-4">

    {{-- HEADER --}}
    <div class="flex justify-between items-start">
        

        {{-- TOMBOL EXPORT CSV DIUBAH --}}
        <button onclick="exportTableToCSV('Order_History.csv')" class="bg-[#7b0000] hover:bg-[#650000] text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow transition">
            <i data-lucide="download" class="w-4 h-4"></i>
            <span class="font-semibold text-sm">
                Export CSV
            </span>
        </button>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-3 gap-3">
        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-5 border shadow-sm">
            <div class="w-9 h-9 bg-[#f7ebeb] rounded-xl flex items-center justify-center mb-3">
                <i data-lucide="receipt" class="w-4 h-4 text-[#7b0000]"></i>
            </div>
            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">Total Orders</p>
            <h2 class="text-3xl font-black">{{ number_format($stats['total'] ?? 0) }}</h2>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-5 border shadow-sm">
            <div class="w-9 h-9 bg-[#eaf8ef] rounded-xl flex items-center justify-center mb-3">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-green-600"></i>
            </div>
            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">Completed</p>
            <h2 class="text-3xl font-black">{{ number_format($stats['completed'] ?? 0) }}</h2>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-5 border shadow-sm">
            <div class="w-9 h-9 bg-[#fff6e8] rounded-xl flex items-center justify-center mb-3">
                <i data-lucide="clock-3" class="w-4 h-4 text-yellow-600"></i>
            </div>
            <p class="uppercase tracking-widest text-[10px] text-gray-400 font-bold mb-2">Pending</p>
            <h2 class="text-3xl font-black">{{ number_format($stats['pending'] ?? 0) }}</h2>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">

         {{-- SEARCH & FILTER --}}
        <div class="p-4 flex justify-between items-center border-b">
            <div class="bg-[#f7f5f3] rounded-full px-4 py-2.5 flex items-center gap-3 w-[340px]">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                <input id="searchInput" type="text" placeholder="Search order or customer..." class="bg-transparent outline-none w-full text-sm">
            </div>

            <div class="flex gap-2">
                <div class="relative flex items-center border px-4 py-2 rounded-xl gap-2 font-medium text-sm">
                    <i data-lucide="filter" class="w-4 h-4 text-gray-500"></i>
                    <select id="statusFilter" class="bg-transparent outline-none cursor-pointer appearance-none pr-4">
                        <option value="all">All Status</option>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <button class="border px-4 py-2 rounded-xl flex items-center gap-2 font-medium text-sm">
                    <i data-lucide="clock-3" class="w-4 h-4"></i>
                    Date
                </button>
            </div>
        </div>

        {{-- TABLE DATA --}}
        <table class="w-full" id="ordersTable">
            <thead class="bg-[#faf7f5]">
                <tr class="text-left text-gray-400 uppercase tracking-widest text-[10px]">
                    <th class="px-6 py-4">Order ID</th>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Items</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Payment</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 no-print">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-6 py-5 font-bold text-[#7b0000] text-lg">{{ $order->order_id }}</td>
                    <td class="px-6 py-5">
                        <h3 class="font-bold text-base">{{ $order->customer->customer_name ?? 'Guest' }}</h3>
                    </td>
                    <td class="px-6 py-5 text-sm text-gray-600">{{ $order->order_date->format('M d, H:i') }}</td>
                    <td class="px-6 py-5 text-sm font-semibold">{{ $order->total_items }} items</td>
                    <td class="px-6 py-5 text-base font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    
                    <td class="px-6 py-5 text-sm">
                        @php
                            $isCash = strtolower($order->payment_method ?? '') === 'cash';
                            $badgeClass = $isCash ? 'bg-blue-100 text-blue-700 border border-blue-200' : 'bg-purple-100 text-purple-700 border border-purple-200';
                        @endphp
                        <span class="px-3 py-1 rounded-full font-bold text-[10px] uppercase {{ $badgeClass }}">
                            {{ $order->payment_method ?? 'Unknown' }}
                        </span>
                    </td>

                    <td class="px-6 py-5">
                        @if($order->status == 'Pending')
                            <form action="{{ route('order_history.update_status', $order->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Are you sure you want to mark this order as Complete?')" class="bg-[#fff6e8] hover:bg-[#ffeccf] text-yellow-700 px-3 py-1 rounded-full inline-flex items-center gap-2 font-bold uppercase text-[10px] transition cursor-pointer">
                                    <i data-lucide="clock-3" class="w-3 h-3"></i>
                                    <span class="status-text">{{ $order->status }}</span>
                                </button>
                            </form>
                        @else
                            <div class="bg-[#dff7e5] text-green-700 px-3 py-1 rounded-full inline-flex items-center gap-2 font-bold uppercase text-[10px]">
                                <i data-lucide="check-circle-2" class="w-3 h-3"></i>
                                <span class="status-text">{{ $order->status }}</span>
                            </div>
                        @endif
                    </td>

                    <td class="px-6 py-5 no-print">
                        <div class="flex gap-3">
                            {{-- TOMBOL MATA: Selalu aktif untuk semua status --}}
                            <button title="View Receipt" onclick="openReceiptModal(this)" data-order="{{ json_encode($order) }}" class="text-[#7b0000] hover:scale-110 transition">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                            
                            {{-- TOMBOL PRINTER: Hanya aktif jika status Complete --}}
                            @if($order->status == 'Complete')
                                <button title="Download PDF" onclick="downloadReceiptPDF(this)" data-order="{{ json_encode($order) }}" class="text-[#7b0000] hover:scale-110 transition">
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </button>
                            @else
                                <button title="Print not available for pending orders" class="text-gray-300 cursor-not-allowed" disabled>
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL POPUP RECEIPT --}}
<div id="receiptModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl w-full max-w-xl overflow-hidden shadow-2xl flex flex-col max-h-[90vh]">
        <div class="p-6 border-b flex justify-between items-center bg-[#faf7f5]">
            <h2 class="text-xl font-bold">Receipt Details</h2>
            <button onclick="closeReceiptModal()" class="text-gray-400 hover:text-black">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        
        {{-- Area ini akan diisi dinamis oleh JavaScript --}}
        <div class="p-8 overflow-y-auto bg-white" id="receiptModalContent">
            </div>

        <div class="p-6 border-t bg-gray-50 flex justify-end">
            <button onclick="closeReceiptModal()" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-xl font-bold text-sm hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");
    const rows = document.querySelectorAll("tbody tr");

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase().trim();
        const statusValue = statusFilter.value.toLowerCase().trim();

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const statusCell = row.querySelector(".status-text");
            let rowStatus = statusCell ? statusCell.innerText.toLowerCase().trim() : "";
            
            if (rowStatus === 'complete') {
                rowStatus = 'completed';
            }

            const matchSearch = rowText.includes(searchValue);
            const matchStatus = (statusValue === "all" || rowStatus === statusValue);

            if (matchSearch && matchStatus) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    if (searchInput) searchInput.addEventListener("keyup", filterTable);
    if (statusFilter) statusFilter.addEventListener("change", filterTable);
});

// ==========================================
// 1. FUNGSI EXPORT CSV
// ==========================================
function exportTableToCSV(filename) {
    let csv = [];
    let rows = document.querySelectorAll("#ordersTable tr");
    
    for (let i = 0; i < rows.length; i++) {
        let row = [], cols = rows[i].querySelectorAll("td, th");
        
        // Loop mengabaikan kolom terakhir (Action) agar tidak ikut ke CSV
        for (let j = 0; j < cols.length - 1; j++) {
            // Bersihkan teks dari newline agar rapi di excel
            let data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, " ").trim();
            row.push('"' + data + '"');
        }
        csv.push(row.join(","));
    }

    // Proses Download
    let csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
    let downloadLink = document.createElement("a");
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}

// ==========================================
// 2. LOGIKA GENERATE HTML UNTUK RECEIPT
// ==========================================
function generateReceiptHTML(order) {
    let itemsHtml = '';
    let totalPrice = parseInt(order.total_price) || 0;
    let subtotal = totalPrice / 1.10;
    let tax = totalPrice - subtotal;
    let items = order.items || [];

    if(items.length > 0) {
        items.forEach(item => {
            let prodName = item.product ? (item.product.pro_name || item.product.name) : 'Unknown Product';
            let qty = item.quantity || 1;
            let price = parseInt(item.price_at_purchase) || 0;
            let itemTotal = price * qty;
            
            itemsHtml += `
                <div class="flex justify-between items-center border-b pb-5 mb-5 border-gray-100">
                    <div>
                        <h3 class="font-black text-lg">${prodName}</h3>
                        <p class="text-gray-400 text-sm">Qty : ${qty}</p>
                    </div>
                    <div>
                        <p class="font-black text-[#7b0000] text-lg">Rp ${itemTotal.toLocaleString('id-ID')}</p>
                    </div>
                </div>
            `;
        });
    } else {
        itemsHtml = '<p class="text-gray-400 text-sm italic">No items found.</p>';
    }

    return `
        <div class="w-full text-left" style="font-family: sans-serif;">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h2 class="text-4xl font-black text-[#7b0000] mb-2">RECEIPT</h2>
                    <p class="text-gray-400">${order.order_id || 'TRX-UNKNOWN'}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Payment Status</p>
                    <p class="font-black text-green-600 uppercase">COMPLETE</p>
                </div>
            </div>

            <div class="space-y-6 mb-10">
                ${itemsHtml}
            </div>

            <div class="space-y-5 border-t pt-6 border-gray-200">
                <div class="flex justify-between">
                    <span class="text-gray-500">Subtotal</span>
                    <span class="font-bold">Rp ${Math.round(subtotal).toLocaleString('id-ID')}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tax</span>
                    <span class="font-bold">Rp ${Math.round(tax).toLocaleString('id-ID')}</span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-3xl font-black">Total</span>
                    <span class="text-4xl font-black text-[#7b0000]">Rp ${totalPrice.toLocaleString('id-ID')}</span>
                </div>
            </div>
        </div>
    `;
}

// ==========================================
// 3. FUNGSI BUKA MODAL RECEIPT (MATA)
// ==========================================
function openReceiptModal(btn) {
    try {
        const orderData = JSON.parse(btn.getAttribute('data-order'));
        const modalContent = document.getElementById('receiptModalContent');
        
        modalContent.innerHTML = generateReceiptHTML(orderData);
        document.getElementById('receiptModal').classList.remove('hidden');
    } catch(e) {
        console.error("Gagal membaca data order", e);
        alert("Terjadi kesalahan saat memuat struk.");
    }
}

function closeReceiptModal() {
    document.getElementById('receiptModal').classList.add('hidden');
}

window.onclick = function(event) {
    const modal = document.getElementById('receiptModal');
    if (event.target == modal) {
        closeReceiptModal();
    }
}

// ==========================================
// 4. FUNGSI DOWNLOAD PDF / PRINT (NATIVE JAVASCRIPT)
// ==========================================
function downloadReceiptPDF(btn) {
    try {
        const orderData = JSON.parse(btn.getAttribute('data-order'));
        const receiptHTML = generateReceiptHTML(orderData);
        
        // Buka tab/jendela baru khusus untuk area print
        const printWindow = window.open('', '_blank', 'width=800,height=600');
        
        // Tulis struktur HTML murni ke dalam jendela baru
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Receipt_${orderData.order_id}</title>
                <script src="https://cdn.tailwindcss.com"><\/script>
                <style>
                    /* Styling khusus saat masuk ke kertas PDF/Printer */
                    @media print {
                        body { 
                            padding: 20px; 
                            -webkit-print-color-adjust: exact; 
                            color-adjust: exact;
                        }
                        /* Menghilangkan header/footer link bawaan Chrome */
                        @page { size: auto; margin: 0mm; }
                    }
                </style>
            </head>
            <body class="p-8 max-w-md mx-auto">
                ${receiptHTML}
                
                <script>
                    // Beri waktu 1 detik agar Tailwind selesai merapikan CSS, lalu print
                    setTimeout(function() {
                        window.print();
                        window.close(); // Tab akan otomatis tertutup setelah selesai diprint/disave
                    }, 1000);
                <\/script>
            </body>
            </html>
        `);
        
        printWindow.document.close();

    } catch(e) {
        console.error("Gagal mencetak struk", e);
        alert("Terjadi kesalahan saat menyiapkan struk.");
    }
}
</script>

@endsection