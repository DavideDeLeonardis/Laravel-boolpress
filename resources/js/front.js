require("./bootstrap");

window.Vue = require("vue");

import App from "./views/App";
import Home from "./pages/Home";
import Posts from "./pages/Posts";
import Post from "./pages/Post";
import About from "./pages/About";
import Contacts from "./pages/Contacts";
import ErrorPage from "./pages/ErrorPage";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faSpinner } from "@fortawesome/free-solid-svg-icons";
library.add(faSpinner);

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
            path: "/posts/:slug",
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
        {
            path: "/404",
            name: "error_page",
            component: ErrorPage,
        },
    ],
});

const app = new Vue({
    el: "#app",
    render: (h) => h(App),
    router
});
