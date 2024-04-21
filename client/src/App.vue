<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import NavbarMenu from '@/components/NavbarMenu.vue';
</script>

<template>
  <header>
    <NavbarMenu />
  </header>

  <RouterView />
</template>