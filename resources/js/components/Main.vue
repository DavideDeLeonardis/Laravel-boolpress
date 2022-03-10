<template>
    <div class="container">
        <ChangePage :cards="cards" @changePage="changePage($event)" />

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div
                v-for="(post, index) in cards.posts"
                :key="`posts${index}`"
                class="col"
            >
                <div class="card">
                    <img
                        :src="
                            post.image
                                ? `/storage/${post.image}`
                                : '/storage/uploads/default.png'
                        "
                        :alt="post.title"
                        class="card-img-top"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <p class="card-text">{{ post.content }}</p>
                    </div>
                </div>
            </div>
        </div>

        <ChangePage :cards="cards" @changePage="changePage($event)"/>
    </div>
</template>

<script>
import ChangePage from "./ChangePage.vue";

export default {
    name: "Main",
    components: {
        ChangePage,
    },
    props: ["cards"],
    methods: {
        changePage(varChangePage) {
            this.$emit("changePage", varChangePage);
        },
    }
};
</script>

<style lang="scss" scoped></style>
