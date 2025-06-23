<template>
  <div class="p-4">
    <!-- Encabezado -->
    <div class="flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
      <h1 class="titulo">Lista de Perfumes</h1>
      <router-link to="/perfumes/new">
        <Button
          label="Agregar Perfume"
          icon="pi pi-plus"
          class="boton-agregar"
        />
      </router-link>
    </div>

    <!-- Input de búsqueda -->
    <div class="mb-4 w-full md:w-30rem">
      <span class="p-input-icon-left w-full">
        
        <InputText
          v-model="searchTerm"
          placeholder="Buscar por nombre o marca..."
          class="input-bonito w-full"
          @input="onSearch"
        />
      </span>
    </div>

    <!-- Lista de perfumes -->
    <div class="flex flex-wrap gap-4 justify-content-center">
      <PerfumeCard
        v-for="perfume in perfumes"
        :key="perfume.id"
        :perfume="perfume"
        class="w-full sm:w-12 md:w-5 lg:w-3"
      />
    </div>

    <!-- Paginación -->
    <div class="flex justify-content-center align-items-center mt-4 flex-wrap gap-2">
      <Button
        label="Anterior"
        icon="pi pi-angle-left"
        class="p-button-outlined p-button-sm"
        :disabled="currentPage === 1"
        @click="changePage(currentPage - 1)"
      />

      <Button
        v-for="page in totalPages"
        :key="page"
        :label="`${page}`"
        class="p-button-sm"
        :class="{ 'p-button-primary': page === currentPage, 'p-button-outlined': page !== currentPage }"
        @click="changePage(page)"
      />

      <Button
        label="Siguiente"
        icon="pi pi-angle-right"
        iconPos="right"
        class="p-button-outlined p-button-sm"
        :disabled="currentPage === totalPages"
        @click="changePage(currentPage + 1)"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import PerfumeCard from '../components/PerfumeCard.vue';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const perfumes = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);
const searchTerm = ref('');

const fetchPerfumes = async (page = 1) => {
  try {
    const res = await axios.get('/api/perfumes', {
      params: {
        page: page,
        buscar: searchTerm.value,
      },
    });

    const pagination = res.data.data;
    perfumes.value = pagination.data ?? [];
    currentPage.value = pagination.current_page;
    totalPages.value = pagination.last_page;
  } catch (error) {
    console.error('Error al cargar perfumes:', error);
  }
};

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    fetchPerfumes(page);
  }
};

const onSearch = () => {
  fetchPerfumes(1);
};

onMounted(() => fetchPerfumes());
</script>

<style scoped>
/* Título grande y elegante */
.titulo {
  font-size: 2.5rem;
  font-weight: bold;
  color: #4b0082; /* Morado oscuro */
}

/* Botón morado con sombra y hover bonito */
.boton-agregar {
  background: linear-gradient(to right, #800080, #800080);
  color: white;
  border: none;
  font-weight: 600;
  padding: 0.5rem 1.2rem;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(130, 88, 219, 0.3);
  transition: all 0.3s ease;
}

.boton-agregar:hover {
  background: linear-gradient(to right, #800080, #800080);
  box-shadow: 0 6px 16px rgba(107, 33, 168, 0.4);
  transform: translateY(-2px);
}

/* Input con estilo moderno */
.input-bonito {
  padding: 0.6rem 1rem;
  border-radius: 8px;
  border: 1px solid #d1d5db;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  transition: border 0.3s, box-shadow 0.3s;
}

.input-bonito:focus {
  outline: none;
  border-color: #9333ea;
  box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.2);
}
</style>
