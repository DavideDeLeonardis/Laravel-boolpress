<template>
    <div class="container">
        <ChangePage :cards="cards" @changePage="changePage($event)" />

        <div v-if="cards" class="row row-cols-1 row-cols-md-3 g-4">
            <div
                v-for="(post, index) in cards.posts"
                :key="`post-${index}`"
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
                        <p class="card-text mb-4">{{ post.content }}</p>
                        <div v-if="post.tags && post.tags.length != 0">
                            <h4>Tags</h4>
                            <ul
                                v-for="(tag, index) in post.tags"
                                :key="`tag-${index}`"
                            >
                                <li>{{ tag.name }}</li>
                            </ul>
                        </div>
                    </div>

                    <router-link
                        class="btn btn-info"
                        :to="{ name: 'post', params: { slug: post.slug } }"
                        >View</router-link
                    >
                </div>
            </div>
        </div>

        <ChangePage :cards="cards" @changePage="changePage($event)" />
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
        }
    }
};
</script>

<style lang="scss" scoped></style>
