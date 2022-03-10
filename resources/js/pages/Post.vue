<template>
    <div class="container">
        <div v-if="post" class="row row-cols-1 row-cols-md-1 my-4">
            <div class="card w-50 mx-auto">
                <img
                    class="card-img-top"
                    :src="
                        post.image
                            ? `/storage/${post.image}`
                            : '/storage/uploads/default.png'
                    "
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
        this.getPost(`http://127.0.0.1:8000/api/v1/posts/${this.id}`);
    },
    methods: {
        getPost(url) {
            Axios
                .get(url)
                .then((result) => {
                    this.post = result.data.results.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    }
};
</script>

<style lang="scss" scoped></style>
