import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

import PrimeVue from 'primevue/config';



import 'primeicons/primeicons.css';
import 'primeflex/primeflex.css';

import Button from 'primevue/button';
import Menubar from 'primevue/menubar';
import InputText from 'primevue/inputtext';

const app = createApp(App);

app.use(router);
app.use(PrimeVue);

app.component('Button', Button);
app.component('Menubar', Menubar);
app.component('InputText', InputText);

app.mount('#app');
