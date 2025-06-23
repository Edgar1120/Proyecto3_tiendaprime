import { createRouter, createWebHistory } from 'vue-router';
import PerfumeList from '../views/PerfumeList.vue';
import PerfumeForm from '../views/PerfumeForm.vue';

import PerfumeDetail from '@/views/PerfumeDetail.vue';
import Categorias from '../views/Categorias.vue'

const routes = [
    { path: '/', component: PerfumeList },
    { path: '/perfumes/new', component: PerfumeForm },
    { path: '/perfumes/:id/edit', component: PerfumeForm, props: true },
    {path: '/perfumes/:id',name: 'PerfumeDetail',component: PerfumeDetail,props: true},
    {path: '/categorias', name: 'Categorias', component: Categorias},

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
