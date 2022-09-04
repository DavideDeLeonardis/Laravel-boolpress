<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="my-3">Home</h1>
            </div>
        </div>

        <Loading v-if="loading"/>

        <Main :cards="cards" @changePage="changePage($event)" />
    </div>
</template>

<script>
import Axios from "axios";

import Loading from "../components/Loading.vue";
import Main from "../components/Main.vue";


export default {
    name: "Home",
    components: {
        Loading,
        Main,
    },
    data() {
        return {
            loading: false,
            url: "http://127.0.0.1:8000/api/v1/",
            cards: {
                posts: null,
                prev_page_url: null,
                next_page_url: null,
            }
        }
    },
    created() {
        this.getPosts(`${this.url}posts/random`);
    },
    methods: {
        changePage(varChangePage) {
            if (this.cards[varChangePage]) {
                this.getPosts(this.cards[varChangePage]);
            }
        },
        getPosts(url) {
            this.loading = true;
            Axios.get(url)
                .then((result) => {
                    this.cards.posts = result.data.results.data;
                    this.cards.next_page_url = result.data.results.next_page_url;
                    this.cards.prev_page_url = result.data.results.prev_page_url;
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
};
</script>

<style lang="scss" scoped></style>
