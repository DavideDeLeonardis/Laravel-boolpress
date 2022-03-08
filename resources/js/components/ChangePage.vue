<template>
    <div class="row mt-3 bg-light">
        <ul class="list-inline bg-light">
            <li class="list-inline-item">
                <button
                    v-if="prev_page_url"
                    class="btn btn-primary text-white"
                    @click="changePage('prev_page_url')"
                >
                    Prev
                </button>
            </li>
            <li class="list-inline-item">
                <button
                    v-if="next_page_url"
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
};
</script>

<style lang="scss" scoped></style>
