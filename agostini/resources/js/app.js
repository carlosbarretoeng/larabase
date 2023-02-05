import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { dom } from "@fortawesome/fontawesome-svg-core";

import Highcharts from 'highcharts'
import Stock from "highcharts/modules/stock";
import accessibilityInit from 'highcharts/modules/accessibility'
import exportingInit from 'highcharts/modules/exporting'
import HighchartsVue from 'highcharts-vue'

import {createI18n} from 'vue-i18n'
import i18n_messages from './I18n'

library.add(fas);
library.add(far);
library.add(fab);

dom.watch();

Stock(Highcharts);
accessibilityInit(Highcharts);
exportingInit(Highcharts);

const i18n = createI18n({
    locale: 'pt-br',
    fallbackLocale: 'en',
    messages: i18n_messages
})

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(HighchartsVue, Highcharts)
            .use(i18n)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
