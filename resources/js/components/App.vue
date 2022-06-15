<template>
    <div class="container p-5">
        <center>
            <h1>Short links App</h1>
            <short-link-component></short-link-component>
        </center>
    </div>
</template>

<script>

import ShortLinkComponent from './short/ShortLinkComponent.vue'

export default {
  components: { ShortLinkComponent },
}
</script>

<style>

</style>