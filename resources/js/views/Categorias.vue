<template>
  <div class="p-4">
    <!-- Título Principal -->
    <h2 class="text-center text-3xl font-bold mb-5 text-purple-600">Gestión de Categorías</h2>

    <!-- Card: Formulario de Categoría -->
    <Card class="mb-4 p-4 border-round shadow-2 surface-card">
      <template #title>
        <h1 class="m-0 text-2xl font-bold text-purple-700">
          {{ editando ? 'Editar Categoría' : 'Nueva Categoría' }}
        </h1>
      </template>
      <template #content>
        <form @submit.prevent="guardarCategoria" class="flex flex-column gap-4">
          <div class="field">
            <label for="nombre" class="block font-medium mb-2">Nombre</label>
            <InputText
              id="nombre"
              v-model="form.nombre"
              placeholder="Ej. Fragancias de lujo"
              required
              class="w-full"
            />
          </div>
          <div class="flex justify-content-end gap-3">
            <Button
              type="submit"
              :label="editando ? 'Actualizar' : 'Crear'"
              icon="pi pi-check"
              class="p-button-sm p-button-success"
            />
            <Button
              v-if="editando"
              type="button"
              label="Cancelar"
              icon="pi pi-times"
              class="p-button-sm p-button-secondary"
              @click="cancelarEditar"
            />
          </div>
        </form>
      </template>
    </Card>

    <!-- Card: Lista de Categorías -->
    <Card class="p-4 border-round shadow-2 surface-card">
      <template #title>
        <h1 class="m-0 text-2xl font-bold text-purple-700">Categorías registradas</h1>
      </template>
      <template #content>
        <div v-if="categorias.length">
          <ul class="list-none p-0 m-0">
            <li
              v-for="categoria in categorias"
              :key="categoria.id"
              class="flex justify-content-between align-items-center py-3 px-2 border-bottom-1 surface-border"
            >
              <span class="text-900">{{ categoria.nombre }}</span>
              <div class="flex gap-2">
                <Button
                  icon="pi pi-pencil"
                  class="p-button-sm p-button-outlined p-button-primary"
                  @click="editarCategoria(categoria)"
                />
                <Button
                  icon="pi pi-trash"
                  class="p-button-sm p-button-outlined p-button-danger"
                  @click="eliminarCategoria(categoria.id)"
                />
              </div>
            </li>
          </ul>
        </div>
        <div v-else class="text-center text-600">No hay categorías disponibles.</div>
      </template>
    </Card>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const categorias = ref([]);
const form = ref({ nombre: '' });
const editando = ref(false);
const idEditando = ref(null);

const obtenerCategorias = async () => {
  const res = await axios.get('/api/categorias');
  categorias.value = res.data.data;
};

const guardarCategoria = async () => {
  if (editando.value) {
    await axios.put(`/api/categorias/${idEditando.value}`, form.value);
  } else {
    await axios.post('/api/categorias', form.value);
  }
  await obtenerCategorias();
  cancelarEditar();
};

const editarCategoria = (categoria) => {
  form.value.nombre = categoria.nombre;
  idEditando.value = categoria.id;
  editando.value = true;
};

const cancelarEditar = () => {
  form.value.nombre = '';
  idEditando.value = null;
  editando.value = false;
};

const eliminarCategoria = async (id) => {
  if (confirm('¿Deseas eliminar esta categoría?')) {
    await axios.delete(`/api/categorias/${id}`);
    await obtenerCategorias();
  }
};

onMounted(obtenerCategorias);
</script>

<style scoped>
input.p-inputtext,
select.p-dropdown {
  width: 100%;
  padding: 0.5rem 0.75rem;
  font-size: 1rem;
  border: 1.5px solid #999;
  border-radius: 6px;
  background-color: white;
  color: #333;
  box-sizing: border-box;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}
.field label {
  color: #4a4a4a;
}
</style>
