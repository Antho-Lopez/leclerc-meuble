require('./bootstrap');
import _ from 'lodash';

import { createApp } from 'vue'

import App from './App.vue'
import store from './store'

import Chart from 'chart.js/auto';
window.Chart = Chart;

createApp(App).use(store).mount('#app')
