<div class="min-h-screen bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center mb-8">
            <div>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide">Products area</p>
                <h1 class="text-3xl font-bold text-gray-800">Available Products</h1>
                <p class="text-gray-600 mt-1">Welcome, {{ auth()->user()->name }}</p>
            </div>
            <div class="flex items-center gap-3">
                @if (auth()->user()?->role === 'admin')
                    <a href="/users"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        Users
                    </a>
                @endif
                <form action="/logout" method="POST">
                    {{-- @csrf --}}
                    <button type="submit"
                        class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="flex flex-wrap gap-5">
            @foreach ($products as $product)
                <x-product-card :name="$product['name']" :price="$product['price']" />
            @endforeach
        </div>
    </div>
</div>
