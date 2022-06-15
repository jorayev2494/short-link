<template>
    <div v-show="text" class="alert alert-success alert-dismissible fade show" role="alert">
        <span>{{ text }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="toggleShow()"></button>
    </div>
</template>

<script>

export default {
    name: 'AlertComponent',
    props: {
        text: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            isShow: !false,
        }
    },
    methods: {
        toggleShow() {
            if (!(this.isShow = !this.isShow)) {
                this.renderErrors = [];
            }
        },
    }
}
</script>

<style>

</style>