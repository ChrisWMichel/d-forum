import Vue from 'vue'
import VueRouter from 'vue-router'
import {isLoggedIn} from "../shared/utils/auth";

Vue.use(VueRouter)

import Home from "../components/home/AppHome";
import Login from "../components/auth/Login";
import Register from "../components/auth/Register";


const routes = [
    {path:"/", component:Home, name:'home', meta:{requireAuth:true}},
    {path:"/sign-in", component:Login, name:'login'},
    {path:"/sign-up", component:Register, name:'register'}
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
    if(to.matched.some(rec => rec.meta.requireAuth)){
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
