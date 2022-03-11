<template>
    <div class="d-flex justify-content-center">
        <font-awesome-icon icon="fa-solid fa-spinner" spin size="2xl" />
    </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

export default {
    name: "Loading",
    components: {
        FontAwesomeIcon,
    },
};
</script>

<style lang="scss" scoped></style>
