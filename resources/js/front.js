require("./bootstrap");

window.Vue = require("vue");

import App from "./views/App";
import Home from "./pages/Home";
import Posts from "./pages/Posts";
import Post from "./pages/Post";
import About from "./pages/About";
import Contacts from "./pages/Contacts";

import VueRouter from "vue-router";
Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/posts",
            name: "posts",
            component: Posts,
        },
        {
            path: "/posts/:id",
            name: "post",
            props: true,
            component: Post,
        },
        {
            path: "/about",
            name: "about",
            component: About,
        },
        {
            path: "/contacts",
            name: "contacts",
            component: Contacts,
        },
    ],
});

const app = new Vue({
    el: "#app",
    render: (h) => h(App),
    router
});
