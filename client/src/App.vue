<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import { Button } from '@/components/ui/button';
import NavbarMenu from '@/components/NavbarMenu.vue';
import CmsLayout from './components/CmsLayout.vue';
</script>

<!-- <template>
  <header>
    <NavbarMenu />
  </header>

  <RouterView />
</template> -->

<template>
  <CmsLayout />

  <!-- Main Content Area -->
  <main class="flex-1 bg-gray-100 mt-16 md:mt-0">
    <RouterView />
  </main>
</template>