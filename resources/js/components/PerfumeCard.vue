<template>
  <div class="surface-card shadow-1 border-round p-3 flex flex-column h-full card-alta">
    <!-- Imagen -->
    <router-link :to="`/perfumes/${perfume.id}`">
    <img
  :src="perfume.imagen"
  :alt="perfume.nombre"
  class="w-full border-round-top"
  style="height: 45%; object-fit: cover;"
/>

    </router-link>

    <!-- Detalles -->
    <div class="pt-3 flex flex-column gap-3 flex-grow-1">
      <!-- Marca -->
      <span class="text-xs text-600 font-semibold uppercase tracking-widest">{{ perfume.marca }}</span>

      <!-- Nombre -->
      <router-link
        :to="`/perfumes/${perfume.id}`"
        class="text-purple-700 font-bold text-lg no-underline hover:underline"
      >
        {{ perfume.nombre }}
      </router-link>

      <!-- Detalles con iconos -->
      <div class="flex flex-wrap gap-4 mt-2 text-sm text-700">
        <div class="flex align-items-center gap-2">
          <i class="pi pi-male text-purple-500"></i>
          <span><strong>Género:</strong> {{ perfume.genero }}</span>
        </div>
        <div class="flex align-items-center gap-2">
          <i class="pi pi-inbox text-purple-500"></i>
          <span><strong>Volumen:</strong> {{ perfume.volumen }}</span>
        </div>
        <div class="flex align-items-center gap-2">
          <i class="pi pi-tags text-purple-500"></i>
          <span><strong>Categoría:</strong> {{ perfume.categoria.nombre }}</span>
        </div>
      </div>

      <!-- Precio -->
      <span class="text-lg text-green-600 font-bold mt-auto">${{ perfume.precio.toFixed(2) }}</span>

      <!-- Botón Ver más -->
<router-link :to="`/perfumes/${perfume.id}`" class="mt-4 flex justify-content-center">
  <Button
    label="Ver más"
   
    iconPos="right"
    class="boton-lindo"
  />
</router-link>


    </div>
  </div>
</template>

<script setup>
defineProps(['perfume']);
import Button from 'primevue/button';
</script>

<style scoped>
.card-alta {
  min-height: 700px; 
}

.tracking-widest {
  letter-spacing: 0.1em;
}

.boton-lindo {
  background: linear-gradient(to right, #800080, #800080); /* Gradiente morado */
  color: white;
  border: none;
  border-radius: 999px; /* forma totalmente redondeada */
  padding: 0.6rem 1.5rem;
  font-weight: 600;
  box-shadow: 0 4px 12px rgba(130, 88, 219, 0.3);
  transition: all 0.3s ease;
}

.boton-lindo:hover {
  background: linear-gradient(to right, #800080, #800080); /* Hover más intenso */
  box-shadow: 0 6px 16px rgba(107, 33, 168, 0.4);
  transform: translateY(-2px);
}



</style>
