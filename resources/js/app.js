require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import VueAxios from 'vue-axios';

const el = document.getElementById('app');
const Swal = require('sweetalert2').default

window.Toast = Swal.mixin({
    toast: false,
    position: 'buttom-right',
    timer: 5000,
    timerProgressBar: false
})



createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(el);
