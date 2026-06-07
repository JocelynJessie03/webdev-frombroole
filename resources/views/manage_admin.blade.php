@extends('partials.sidebar')

@section('content')

<div class="space-y-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    @endif

    {{-- HEADER WITH BUTTON --}}
    <div class="flex justify-end mb-4">
        <button onclick="openModal('create')" class="bg-[#7b0000] hover:bg-[#8d0000] text-white px-5 py-2 rounded-xl flex items-center gap-2 font-medium transition shadow-sm">
            <i data-lucide="plus-circle" class="w-5 h-5"></i>
            <span>Add Admin</span>
        </button>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#faf7f5]">
                <tr class="text-left text-gray-400 uppercase tracking-widest text-[10px]">
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Username</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($admins as $admin)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-6 py-5 font-bold">{{ $admin->name }}</td>
                    <td class="px-6 py-5 text-gray-600">{{ $admin->username }}</td>
                    <td class="px-6 py-5 text-gray-600">{{ $admin->email }}</td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1 text-xs font-bold uppercase rounded-full {{ $admin->role === 'super_admin' ? 'bg-[#fff2c9] text-yellow-700' : 'bg-gray-200 text-gray-700' }}">
                            {{ str_replace('_', ' ', $admin->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-5 flex gap-3">
                        <button onclick="openModal('edit', {{ $admin->toJson() }})" class="text-blue-500 hover:text-blue-700" title="Edit">
                            <i data-lucide="edit" class="w-5 h-5"></i>
                        </button>
                        <form action="{{ route('manage_admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL --}}
<div id="adminModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl flex flex-col">
        <div class="p-6 border-b flex justify-between items-center bg-[#faf7f5]">
            <div>
                <h2 class="text-xl font-bold" id="modalTitle">Add Admin</h2>
            </div>
            <button onclick="closeModal()" class="text-gray-400 hover:text-black">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <form id="adminForm" method="POST" action="{{ route('manage_admin.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Name</label>
                <input type="text" name="name" id="name" required class="w-full border rounded-xl px-3 py-2 focus:outline-[#7b0000]">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Username</label>
                <input type="text" name="username" id="username" required class="w-full border rounded-xl px-3 py-2 focus:outline-[#7b0000]">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Email</label>
                <input type="email" name="email" id="email" required class="w-full border rounded-xl px-3 py-2 focus:outline-[#7b0000]">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Password</label>
                <input type="password" name="password" id="password" class="w-full border rounded-xl px-3 py-2 focus:outline-[#7b0000]" placeholder="Leave blank to keep current password">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Role</label>
                <select name="role" id="role" required class="w-full border rounded-xl px-3 py-2 focus:outline-[#7b0000]">
                    <option value="admin">Admin</option>
                    <option value="super_admin">Super Admin</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-[#7b0000] hover:bg-[#8d0000] text-white font-bold py-3 rounded-xl transition mt-4">
                Save
            </button>
        </form>
    </div>
</div>

<script>
function openModal(mode, data = null) {
    const modal = document.getElementById('adminModal');
    const form = document.getElementById('adminForm');
    const title = document.getElementById('modalTitle');
    const methodInput = document.getElementById('formMethod');
    const passwordInput = document.getElementById('password');

    if (mode === 'edit' && data) {
        title.innerText = 'Edit Admin';
        form.action = `/manage-admin/${data.id}`;
        methodInput.value = 'PUT';
        
        document.getElementById('name').value = data.name;
        document.getElementById('username').value = data.username;
        document.getElementById('email').value = data.email;
        document.getElementById('role').value = data.role;
        passwordInput.required = false;
        passwordInput.placeholder = "Leave blank to keep current password";
    } else {
        title.innerText = 'Add Admin';
        form.action = '{{ route("manage_admin.store") }}';
        methodInput.value = 'POST';
        
        form.reset();
        passwordInput.required = true;
        passwordInput.placeholder = "";
    }

    modal.classList.remove('hidden');
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

function closeModal() {
    document.getElementById('adminModal').classList.add('hidden');
}

window.onclick = function(event) {
    const modal = document.getElementById('adminModal');
    if (event.target == modal) {
        closeModal();
    }
}
</script>

@endsection
