<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="my-3">All Posts</h1>
            </div>
        </div>

        <div class="row search mb-3 p-3 bg-light">
            <div class="col-12">
                <form>
                    <h2>Search</h2>
                    <div class="row">
                        <div class="mb-3 col-2">
                            Order by Column
                            <select
                                class="form-select form-select"
                                name="orderbycolumn"
                                id="orderbycolumn"
                                v-model="form.orderbycolumn"
                            >
                                <option value="title">Title</option>
                                <option value="created_at">Created</option>
                            </select>
                        </div>
                        <div class="mb-3 col-2">
                            Order by Versus
                            <select
                                class="form-select form-select"
                                name="orderbysort"
                                id="orderbysort"
                                v-model="form.orderbysort"
                            >
                                <option value="asc">Asc</option>
                                <option value="desc">Desc</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            View by Tags
                            <div
                                class="d-flex align-items-center justify-content-between"
                            >
                                <div
                                    v-for="(tag, index) in tags"
                                    :key="`tag-${index}`"
                                >
                                    <input
                                        type="checkbox"
                                        name="tags[]"
                                        :value="tag.name"
                                        v-model="form.tags"
                                    />
                                    <label :for="tag.name">{{
                                        tag.name
                                    }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 d-flex">
                            <input
                                class="btn btn-info me-3"
                                type="button"
                                value="Filter"
                                @click.prevent="searchPosts"
                            />
                            <input
                                class="btn btn-danger"
                                type="button"
                                value="Reset filters"
                                @click.prevent="resetFilters"
                            />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <Loading v-if="loading" />

        <Main v-else :cards="cards" @changePage="changePage($event)" />
    </div>
</template>

<script>
import Axios from "axios";

import Loading from "../components/Loading.vue";
import Main from "../components/Main.vue";

export default {
    name: "Posts",
    components: {
        Loading,
        Main,
    },
    data() {
        return {
            loading: false,
            url: "http://127.0.0.1:8000/api/v1/",
            tags: [],
            form: {
                orderbycolumn: "title",
                orderbysort: "desc",
                tags: [],
            },
            cards: {
                posts: null,
                prev_page_url: null,
                next_page_url: null,
            },
        };
    },
    created() {
        this.getPosts(`${this.url}posts`);
        this.getTags();
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
                    this.cards.next_page_url =
                        result.data.results.next_page_url;
                    this.cards.prev_page_url =
                        result.data.results.prev_page_url;
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        searchPosts() {
            Axios.get(`${this.url}posts/search`, { params: this.form })
                .then((result) => {
                    this.cards.posts = result.data.results.data;
                    this.cards.next_page_url =
                        result.data.results.next_page_url;
                    this.cards.prev_page_url =
                        result.data.results.prev_page_url;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getTags() {
            Axios.get(`${this.url}tags`)
                .then((result) => {
                    this.tags = result.data.results.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        resetFilters() {
            this.form.orderbycolumn = "title";
            this.form.orderbysort = "desc";
            this.form.tags = [];
            this.getPosts(`${this.url}posts`);
        }
    }
};
</script>

<style lang="scss" scoped></style>
