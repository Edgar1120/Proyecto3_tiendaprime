<template>
  <div class="flex flex-column min-h-screen">
    <HeaderComponent />

    <main class="flex-grow-1 p-4">
      <router-view />
    </main>

    <FooterComponent />
  </div>
</template>

<script setup>
import HeaderComponent from './components/Navbar.vue';
import FooterComponent from './components/Footer.vue';
</script>

<style>
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
</style>
