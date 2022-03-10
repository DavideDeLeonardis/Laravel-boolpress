<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="my-3">Home</h1>
            </div>
        </div>
        <Main :cards="cards" @changePage="changePage($event)" />
    </div>
</template>

<script>
import Axios from "axios";

import Main from "../components/Main.vue";

export default {
    name: "Home",
    components: {
        Main,
    },
    data() {
        return {
            cards: {
                posts: null,
                prev_page_url: null,
                next_page_url: null,
            }
        };
    },
    created() {
        this.getPosts("http://127.0.0.1:8000/api/v1/posts/random");
    },
    methods: {
        changePage(varChangePage) {
            if (this.cards[varChangePage]) {
                this.getPosts(this.cards[varChangePage]);
            }
        },
        getPosts(url) {
            Axios
                .get(url)
                .then((result) => {
                    this.cards.posts = result.data.results.data;
                    this.cards.next_page_url = result.data.results.next_page_url;
                    this.cards.prev_page_url = result.data.results.prev_page_url;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
};
</script>

<style lang="scss" scoped></style>
