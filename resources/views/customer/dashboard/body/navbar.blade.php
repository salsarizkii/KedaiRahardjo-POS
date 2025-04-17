<!-- resources/views/components/customer/navbar.blade.php -->
<nav class="fixed top-0 left-0 right-0 max-w-xl mx-auto bg-white shadow p-3 z-50">
    <div class="max-w-7xl mx-auto flex items-start">
        <!-- Logo/nama aplikasi -->
        <a href="{{ route('customer.index') }}" class="flex items-center">
            <img src="{{ asset('assets/images/icon/logo_kedai_rahardjo.svg') }}" alt="Logo" class="h-10 w-10 rounded-full">
            <div class="ml-2">
                <p class=" text-xl font-bold text-red-600">
                Kedai Rahardjo
            </p>
                <p class="text-sm text-gray-500">Larangan 01/03, Gayam, Sukoharjo</p>
            </div>
        </a>
        
    </div>
</nav>
