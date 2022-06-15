<template>
    <form-component></form-component>
    <list-short-links-component></list-short-links-component>
</template>

<script>

import FormComponent from './partials/FormComponent.vue';
import ListShortLinksComponent from './partials/ListShortLinksComponent.vue';

export default {
    name: 'ShortLinkComponent',
    components: {
        FormComponent,
        ListShortLinksComponent
    }
}
</script>

<style>

</style>