<template>
  <div class="surface-card p-6 shadow-2 border-round max-w-screen-md mx-auto">
    <h3 class="text-3xl font-bold mb-6">{{ isEdit ? 'Editar' : 'Agregar' }} Perfume</h3>

    <form @submit.prevent="submit" class="flex flex-column gap-5">
      <div class="grid formgrid">
        <!-- Nombre -->
        <div class="field col-12 md:col-6">
          <label for="nombre" class="font-semibold mb-2 block">Nombre</label>
          <InputText id="nombre" v-model="form.nombre" required class="w-full" />
        </div>

        <!-- Marca -->
        <div class="field col-12 md:col-6">
          <label for="marca" class="font-semibold mb-2 block">Marca</label>
          <InputText id="marca" v-model="form.marca" required class="w-full" />
        </div>

        <!-- Precio -->
        <div class="field col-12 md:col-6">
          <label for="precio" class="font-semibold mb-2 block">Precio</label>
          <InputNumber
            id="precio"
            v-model="form.precio"
            :mode="'decimal'"
            :min="0"
            required
            class="w-full"
            inputClass="input-sm"
          />
        </div>

        <!-- Volumen -->
        <div class="field col-12 md:col-6">
          <label for="volumen" class="font-semibold mb-2 block">Volumen</label>
          <InputText id="volumen" v-model="form.volumen" required class="w-full" />
        </div>

        <!-- Género -->
        <div class="field col-12 md:col-6">
  <label for="genero" class="font-semibold mb-2 block">Género</label>
  <Select 
    v-model="form.genero"
    :options="generos"
    optionLabel="label"
    optionValue="value"
    placeholder="Selecciona un género"
    class="w-full"
  />
</div>


        <!-- Categoría -->
        <div class="field col-12 md:col-6">
          <label for="categoria" class="font-semibold mb-2 block">Categoría</label>
          <Dropdown
            id="categoria"
            :options="categorias"
            optionLabel="nombre"
            optionValue="id"
            v-model="form.categoria_id"
            placeholder="Selecciona una categoría"
            class="w-full"
            required
          />
        </div>

        <!-- Imagen URL -->
        <div class="field col-12">
          <label for="imagen" class="font-semibold mb-2 block">Imagen (URL)</label>
          <InputText id="imagen" v-model="form.imagen" class="w-full" />
        </div>

        <!-- Etiquetas -->
        <div class="field col-12">
          <label for="etiquetas" class="font-semibold mb-2 block">Etiquetas</label>
          <InputText id="etiquetas" v-model="form.etiquetas" class="w-full" />
        </div>

        <!-- Envío Gratis -->
        <div class="field-checkbox col-12 flex align-items-center gap-2">
          <Checkbox inputId="envioGratis" v-model="form.envio_gratis" />
          <label for="envioGratis" class="select-none">Envío Gratis</label>
        </div>
      </div>

      <!-- Botones -->
      <div class="flex gap-4 mt-4 justify-content-end">
        <Button type="submit" label="Guardar" icon="pi pi-check" class="p-button-success" />
        <router-link to="/" class="no-underline">
          <Button label="Cancelar" icon="pi pi-times" class="p-button-secondary" />
        </router-link>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import Select from 'primevue/select';

import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Dropdown from 'primevue/dropdown';
import Checkbox from 'primevue/checkbox';
import Button from 'primevue/button';

const route = useRoute();
const router = useRouter();
const isEdit = !!route.params.id;

const form = ref({
  nombre: '',
  marca: '',
  precio: null,
  volumen: '',
  genero: null,
  imagen: '',
  categoria_id: null,
  envio_gratis: false,
  etiquetas: '',
  rating: 0
});

const generos = [
  { label: 'Hombre', value: 'Hombre' },
  { label: 'Mujer', value: 'Mujer' },
  { label: 'Unisex', value: 'Unisex' }
];

const categorias = ref([]);

const loadCategorias = async () => {
  try {
    const res = await axios.get('/api/categorias');
    categorias.value = res.data.data;
  } catch (error) {
    console.error('Error al cargar categorías:', error);
  }
};

onMounted(async () => {
  await loadCategorias();
  if (isEdit) {
    try {
      const res = await axios.get(`/api/perfumes/${route.params.id}`);
      Object.assign(form.value, res.data.data);
      if ('id_categoria' in form.value) {
        form.value.categoria_id = form.value.id_categoria;
      }
    } catch (error) {
      console.error('Error al cargar perfume:', error);
    }
  }
});

const submit = async () => {
  try {
    if (isEdit) {
      await axios.put(`/api/perfumes/${route.params.id}`, form.value);
    } else {
      await axios.post('/api/perfumes', form.value);
    }
    router.push('/perfumes');
  } catch (error) {
    console.error('Error al guardar perfume:', error);
    alert('Error al guardar el perfume. Por favor intenta de nuevo.');
  }
};
</script>

<style scoped>
/* Estilos personalizados para que inputs y selects sean visibles y bonitos */

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

input.p-inputtext:focus,
select.p-dropdown:focus {
  outline: none;
  border-color: #7c3aed; /* morado */
  box-shadow: 0 0 5px rgba(124, 58, 237, 0.5);
}

/* Checkbox un poco más grande y alineado */
.p-checkbox {
  transform: scale(1.2);
  margin-right: 0.5rem;
}

/* Ajuste general para los dropdown paneles */
.p-dropdown-panel {
  font-size: 1rem !important;
}

/* Ajustar tamaño de input número */
.input-sm .p-inputnumber-input {
  font-size: 1rem;
  padding: 0.5rem 0.75rem;
}

/* Para que el formulario no sea tan ancho en pantallas grandes */
.surface-card {
  max-width: 700px;
}

/* Mejorar apariencia general */
.field label {
  color: #444;
}
</style>
