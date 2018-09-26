Nova.booting((Vue, router) => {
    Vue.component('index-nova-time-field', require('./components/IndexField'));
    Vue.component('detail-nova-time-field', require('./components/DetailField'));
    Vue.component('form-nova-time-field', require('./components/FormField'));
})
