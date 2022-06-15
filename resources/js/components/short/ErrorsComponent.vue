<template>
    <div class="alert alert-danger alert-dismissible fade" :class="{ 'show': isShow }" role="alert">
        <span v-for="(errorText, idx) in renderErrors" :key="idx">{{ errorText }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="toggleShow()"></button>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

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
            isShow: false,
            renderErrors: []
        }
    },
    methods: {
        toggleShow() {
            if (!(this.isShow = !this.isShow)) {
                this.renderErrors = [];
            }
        },
        setType(type) {
            this.type = type;
        }
    },
    computed: {
        ...mapGetters({
            errors: 'errors/getErrors'
        })
    },
    watch: {
        errors(newValues) {
            for (const errorProperty in newValues) {
                if (Object.hasOwnProperty.call(newValues, errorProperty)) {
                    const propertyErrors = newValues[errorProperty];
                    this.renderErrors = [...this.renderErrors, ...propertyErrors];
                    console.log('Error: ', this.renderErrors);
                }
            }
            
            // this.setType('danger');
            this.toggleShow();
        }
    }
}
</script>

<style>

</style>