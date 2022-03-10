<template>
    <div
        v-if="cards.prev_page_url || cards.next_page_url"
        class="row mt-3"
    >
        <ul class="list-inline">
            <li class="list-inline-item">
                <button
                    v-if="cards.prev_page_url"
                    class="btn btn-primary text-white"
                    @click="changePage('prev_page_url')"
                >
                    Prev
                </button>
            </li>
            <li class="list-inline-item">
                <button
                    v-if="cards.next_page_url"
                    class="btn btn-primary text-white"
                    @click="changePage('next_page_url')"
                >
                    Next
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "ChangePage",
    props: ["cards"],
    methods: {
        changePage(varChangePage) {
            this.$emit("changePage", varChangePage);
        },
    },
};
</script>

<style lang="scss" scoped></style>
