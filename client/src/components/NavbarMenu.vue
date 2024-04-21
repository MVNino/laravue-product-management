<script setup lang="ts">
import {
    NavigationMenuLink,
} from '@/components/ui/navigation-menu'
</script>

<template>
    <nav class="bg-gray-800 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="text-white text-xl font-semibold">LaraVue - Product CMS</a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <NavigationMenuLink href="/" class="text-gray-300 hover:text-white">Home</NavigationMenuLink>
                <NavigationMenuLink href="/login" class="text-gray-300 hover:text-white">Login</NavigationMenuLink>
            </div>
            <div class="md:hidden">
                <!-- Mobile menu button -->
                <button class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</template>