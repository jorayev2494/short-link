<template>
    <div class="col-md-6 m-4">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" @change="toggleShowList" :checked="isShowList" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Generated links</label>
        </div>
        <div v-show="isShowList">
            <!-- <ol>
                <li>
                    <div>
                        <a :href="link.client_url" target="_bank" class="m-4">{{ link.short_url }}</a>
                        <p>
                            <span >{{ link.client_url}} </span>
                        </p>
                    </div>
                </li>
            </ol> -->

            <div class="list-group" v-for="(link, idx) in links" :key="idx">
                <div  class="list-group-item list-group-item-action m-2">
                    <p>
                        Visited count: <span class="badge" :class="link.visited_count ? 'bg-primary' : 'bg-secondary'">{{ link.visited_count }}</span>
                    </p>

                    <div class="raw">
                        <a :href="link.full_short_url" target="_bank">
                            {{ link.short_url }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';

export default {
    name: 'ListShortLinksComponent',
    data() {
        return {
            isShowList: !false
        }
    },
    methods: {
        loadLinksAsync: async function() {
            await this.$store.dispatch('links/loadLinkAsync');
        },
        toggleShowList() {
            this.isShowList = !this.isShowList;
        }
    },
    computed: {
        ...mapGetters({
            links: 'links/getLinks'
        })
    },
    mounted() {
        console.log(this.name + 'mounted');
        this.loadLinksAsync();
    }
}
</script>

<style>

</style>