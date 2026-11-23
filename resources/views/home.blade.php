<x-layouts.auth-layout subtitle="Home">

    @if(session()->has('success'))
        <div class="bg-green-800 text-white p-2 rounded-lg w-full mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="main-card">
        lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
        laborum.
    </div>

    <script>
        setTimeout(function () {
            const successMessage = document.querySelector('.bg-green-800');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 4000);
    </script>
</x-layouts.auth-layout>