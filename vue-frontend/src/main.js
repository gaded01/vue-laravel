/**
 * main.js
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */

// Components
import App from './App.vue'

// Composables
import { createApp } from 'vue'

import store from './store/index.js';

// Plugins
import { registerPlugins } from '@/plugins'

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const app = createApp(App)

registerPlugins(app)

app.component('VueDatePicker', VueDatePicker);

app.use(store)
app.mount('#app')
