import Vue from 'vue'
import VueRouter from 'vue-router'
import {isLoggedIn} from "../shared/utils/auth";
import {mapGetters} from "vuex";

Vue.use(VueRouter)

import Home from "../components/home/AppHome";
import Login from "../components/auth/Login";
import Register from "../components/auth/Register";
//import Question from "../components/forum/Question";
import Read from "../components/forum/Read";
import Create from "../components/forum/Create";
import CreateCategory from "../components/category/CreateCategory";


const routes = [
    {path:"/", component:Home, name:'home', meta:{requireLogin:true}},
    {path:"/ask", component:Create, name:'create'},
    {path:"/question/:id", component: Read, name:"read"},
    {path:"/sign-in", component:Login, name:'login'},
    {path:"/sign-up", component:Register, name:'register'},
    {path:"/create-category", component:CreateCategory, name:'create-category'}
];

const router = new VueRouter({
    routes,
    hashbang : false,
    mode: 'history',
    scrollBehavior(to, from, savedPosition){
        if(savedPosition){
            return savedPosition;
        }
        if(to.hash){
            return {selector: to.hash};
        }
        return {x: 0, y:0};
    }

})

router.beforeEach((to, from, next) => {
    if(to.matched.some(rec => rec.meta.requireLogin)){
        if(isLoggedIn()){
            next();
        } else {
            next({name:'login'})
        }
    } else {
        next();
    }
})

export default router
