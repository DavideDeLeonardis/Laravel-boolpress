<template>
    <div class="container">
        <div v-if="post" class="row row-cols-1 row-cols-md-1 my-4">
            <div class="card w-50 mx-auto">
                <img
                    class="card-img-top"
                    src="../../images/default.png"
                    :alt="post.title"
                />
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.content }}</p>
                </div>
            </div>
        </div>
        <div v-else>
            <ErrorPage />
        </div>
    </div>
</template>

<script>
import Axios from "axios";

import ErrorPage from "../pages/ErrorPage.vue";

export default {
    name: "Post",
    components: {
        ErrorPage,
    },
    props: ["slug"],
    data() {
        return {
            post: null,
        };
    },
    created() {
        this.getPost(
            `https://limitless-basin-36680.herokuapp.com/api/v1/posts/${this.slug}`
        );
    },
    methods: {
        getPost(url) {
            Axios.get(url, {
                headers: { Authorization: "Bearer hvwiu56uvg64" },
            })
                .then((result) => {
                    this.post = result.data.results.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="scss" scoped></style>
