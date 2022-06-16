<template>
    <div class="col-md-10 mb-10">
        <AlertComponent :text="message"></AlertComponent>
        <ErrorsComponent :type="'success'"></ErrorsComponent>
        <div class="col-md-10 mb-10">
            
            <form method="POST" @submit.prevent="sendServer">
                <div class="form-group">
                    <label for="exampleInputEmail1">Write your long link please!</label>
                    <input type="text" class="form-control m-2" id="exampleInputEmail1" v-model="link.client_url" placeholder="http://google.com" required>
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
                <button type="submit" class="btn btn-primary m-2">Generate</button>
            </form>
        </div>
    </div>
</template>

<script>

import AlertComponent from '../AlertComponent.vue'
import ErrorsComponent from '../ErrorsComponent.vue'

export default {
    data() {
        return {
            message: null,
            link: {
                client_url: ''
            }
        }
    },
    methods: {
        sendServer: async function () {
            await this.$store.dispatch('links/createLinkAsync', this.link).then((responseData) => {
                this.link.client_url = responseData.full_short_url;
                this.message = 'Your link successful created!';
                console.log('responseData: ', responseData);
            }).catch((err) => {
                
            });;
        }
    },
    components: {
        AlertComponent,
        ErrorsComponent
    }
}
</script>

<style>

</style>