<template>
  <footer class="p-3 text-center text-white" style="background-color: purple;">
    <div class="container">
      <p>&copy; {{ currentYear }} Biblioteca Virtual. Todos los derechos reservados.</p>
    </div>
  </footer>
</template>

<script setup>
const currentYear = new Date().getFullYear();
</script>


