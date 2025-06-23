<template>
  <div class="p-4">
    <div v-if="perfume && perfume.precio !== undefined" class="surface-card p-4 shadow-2 border-round max-w-screen-lg mx-auto">
      <div class="flex flex-column md:flex-row gap-4 align-items-start">
        <!-- Imagen -->
        <div class="w-full md:w-5">
          <img
            :src="perfume.imagen"
            :alt="perfume.nombre"
            class="w-full border-round shadow-1 imagen-ajustada"
          />
        </div>

        <!-- Detalles -->
        <div class="w-full md:w-7 flex flex-column gap-3">
          <h2 class="text-900 font-bold text-3xl">{{ perfume.nombre }}</h2>
          <h4 class="text-purple-600 font-semibold">{{ perfume.marca }}</h4>

          <div class="text-lg text-700">
            <p><i class="pi pi-male text-purple-500 mr-2"></i><strong>Género:</strong> {{ perfume.genero }}</p>
            <p><i class="pi pi-inbox text-purple-500 mr-2"></i><strong>Volumen:</strong> {{ perfume.volumen }}</p>
            <p><i class="pi pi-tags text-purple-500 mr-2"></i><strong>Categoría:</strong> {{ perfume.categoria?.nombre }}</p>
            <p><i class="pi pi-dollar text-purple-500 mr-2"></i><strong>Precio:</strong> ${{ perfume.precio.toFixed(2) }}</p>
            <p><i class="pi pi-bookmark text-purple-500 mr-2"></i><strong>Etiquetas:</strong> {{ perfume.etiquetas }}</p>
            <p>
              <i class="pi pi-truck text-purple-500 mr-2"></i>
              <strong>Envío Gratis:</strong>
              <span :class="perfume.envio_gratis ? 'text-green-600 font-medium' : 'text-red-600 font-medium'">
                {{ perfume.envio_gratis ? 'Sí' : 'No' }}
              </span>
            </p>
          </div>

          <!-- Botones -->
          <div class="flex flex-wrap gap-3 mt-4">
            <router-link :to="`/perfumes/${perfume.id}/edit`" class="no-underline">
              <Button label="Editar" icon="pi pi-pencil" class="p-button-outlined p-button-primary" />
            </router-link>

            <Button
              label="Eliminar"
              icon="pi pi-trash"
              class="p-button-outlined p-button-danger"
              @click="eliminarPerfume"
            />

            <router-link to="/" class="no-underline">
              <Button label="Volver" icon="pi pi-arrow-left" class="p-button-secondary" />
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <div v-else class="text-center text-700 mt-5 text-lg">
      <i class="pi pi-spin pi-spinner mr-2 text-purple-500"></i> Cargando perfume...
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import Button from 'primevue/button';

const route = useRoute();
const router = useRouter();
const perfume = ref(null);

onMounted(async () => {
  try {
    const res = await axios.get(`/api/perfumes/${route.params.id}`);
    perfume.value = res.data.data;
  } catch (error) {
    console.error('Error al cargar perfume:', error);
    perfume.value = null;
  }
});

const eliminarPerfume = async () => {
  if (confirm('¿Estás seguro de que deseas eliminar este perfume?')) {
    try {
      await axios.delete(`/api/perfumes/${perfume.value.id}`);
      alert('Perfume eliminado correctamente.');
      router.push('/perfumes');
    } catch (error) {
      console.error('Error al eliminar perfume:', error);
      alert('Error al eliminar el perfume.');
    }
  }
};
</script>

<style scoped>
.imagen-ajustada {
  max-height: 400px;
  object-fit: contain;
  width: 100%;
  aspect-ratio: auto;
  background-color: #f9f9f9;
}

.text-purple {
  color: #6f42c1;
}
</style>
