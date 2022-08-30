<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li
                        v-for="(item, index) in menuItems"
                        :key="`item-${index}`"
                        class="nav-item"
                    >
                        <router-link
                            class="nav-link"
                            :to="{ name: item.routeName }"
                            >{{ item.label }}</router-link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            menuItems: [
                {
                    label: "Home",
                    routeName: "home",
                },
                {
                    label: "Posts",
                    routeName: "posts",
                },
                {
                    label: "Contatti",
                    routeName: "contacts",
                },
            ],
        };
    },
};
</script>

<style lang="scss"></style>
