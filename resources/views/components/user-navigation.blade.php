<nav class="bg-gray-800 p-4 text-white">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="font-bold text-xl">ReLove Bazaar</a>
        <div class="flex space-x-4">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <a href="{{ route('user.dashboard') }}" class="hover:underline">Dashboard</a>
            <a href="#" class="hover:underline">Products</a>
            <a href="#" class="hover:underline">Donation List</a>
            <a href="#" class="hover:underline">Blog</a>
            <a href="#" class="hover:underline">Contact</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        </div>
    </div>
</nav>
