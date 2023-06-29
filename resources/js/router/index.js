import { createRouter, createWebHistory } from "vue-router";
import store from '@/js/stores'
import NotFound from '@/js/pages/errors/404'
import Register from '@/js/pages/auth/Register'
import Login from '@/js/pages/auth/Login'
import TwoFactorChallenge from '@/js/pages/auth/TwoFactorChallenge'
import ForgotPassword from '@/js/pages/auth/ForgotPassword'
import ResetPassword from '@/js/pages/auth/ResetPassword'
import VerifyEmail from '@/js/pages/auth/VerifyEmail'

import ConfirmPassword from '@/js/pages/auth/ConfirmPassword'
import Home from '@/js/pages/Home'

/* Account */


import ProductsIndex from "@/js/pages/Products/Index";
import ProductsEdit from "@/js/pages/Products/Edit";
import ProductsAdd from "@/js/pages/Products/Add";
import ProductsBasket from "@/js/pages/Products/Basket";

import Auth from "@/js/pages/auth/index";





const router = createRouter({
    history: createWebHistory(),
    routes: [

        { path: "/", name: 'Home', component: Home },








        { path: "/", name: 'Auth', component: Auth,
            children: [
                { path: "/register", name: 'Register', component: Register },
                { path: "/confirm-password", meta: {auth:['user','admin'] }, name: 'ConfirmPassword', component: ConfirmPassword },
                { path: "/login", name: 'Login', component: Login },
                { path: "/verify-email", name: 'VerifyEmail', component: VerifyEmail },
                { path: "/two-factor-challenge", name: 'TwoFactorChallenge', component: TwoFactorChallenge },
                { path: "/forgot-password", name: 'ForgotPassword', component: ForgotPassword },
                { path: "/reset-password/:token", name: 'ResetPassword', component: ResetPassword },
            ]
        },


        {path: "/products", name: 'ProductsIndex', component: ProductsIndex},
        {path: "/products/add", name: 'ProductsAdd', component: ProductsAdd},
        {path: "/products/basket", name: 'ProductsBasket', component: ProductsBasket},
        {path: "/products/:id", name: 'ProductsEdit', component: ProductsEdit},





        { path: '/:pathMatch(.*)*', name: '404', component: NotFound}
    ],
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { top: 0 }
        }
    },
});

router.beforeEach((to, from, next) => {
    if(to.meta.auth && !store.getters.user) {
        next({name: "Login"})
    }
    if(to.meta.auth && !to.meta.auth.includes(store.getters.user.role)) {
        next({name: "Login"})
    } else {
        next();
    }
});

export default router;
