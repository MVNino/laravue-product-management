<template>
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center">
                    <span class="text-xl font-bold">CMS Logo</span>
                </div>
                <div class="flex items-center">
                    <!-- Add your header content here -->
                    <a href="#" class="text-gray-700 hover:text-gray-900 px-3 py-2">Dashboard</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 px-3 py-2">Profile</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 px-3 py-2">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="bg-gray-800 text-gray-300 w-64 h-full">
        <div class="h-full flex flex-col justify-between">
            <div class="px-4 py-6">
                <h2 class="text-lg font-semibold uppercase">Menu</h2>
                <ul class="mt-6">
                    <li class="hover:bg-gray-700 rounded-lg px-2 py-1">
                        <a href="#" class="block">Dashboard</a>
                    </li>
                    <li class="hover:bg-gray-700 rounded-lg px-2 py-1">
                        <a href="#" class="block">Posts</a>
                    </li>
                    <li class="hover:bg-gray-700 rounded-lg px-2 py-1">
                        <a href="#" class="block">Pages</a>
                    </li>
                    <!-- Add more menu items as needed -->
                </ul>
            </div>
            <!-- Footer -->
            <div class="text-center pb-6">
                <p class="text-sm">&copy; 2024 CMS Company</p>
            </div>
        </div>
    </aside>
</template>