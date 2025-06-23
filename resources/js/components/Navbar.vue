<template>
  <nav class="p-3" style="background-color: purple;">
    <div class="container flex justify-content-between align-items-center">
      <a href="/" class="text-white text-xl font-bold no-underline">Perfumes Wongs</a>

      <div class="flex gap-2">
        <router-link to="/" class="p-button p-button-outlined p-button-sm p-button-text-white">Perfumes</router-link>
        <router-link to="/categorias" class="p-button p-button-outlined p-button-sm p-button-text-white">Categorias</router-link>
      </div>
    </div>
  </nav>
</template>

<script setup>
</script>

<style scoped>
.p-button-text-white {
  color: white !important;
  border-color: white !important;
}

.p-button-text-white:hover {
  background-color: rgba(255, 255, 255, 0.2) !important;
}
</style>
