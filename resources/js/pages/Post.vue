<template>
    <div>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="card">
                <img
                    class="card-img-top"
                    :src="'/storage/' + post.image"
                    :alt="post.title"
                />
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.content }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    name: "Post",
    props: ["id"],
    data() {
        return {
            post: null,
        }
    },
    created() {
        const url = "http://127.0.0.1:8001/api/v1/posts/" + this.id;
        this.getPost(url);
    },
    methods: {
        getPost(url) {
            Axios
                .get(url)
                .then((result) => {
                    console.log(result.data);
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
