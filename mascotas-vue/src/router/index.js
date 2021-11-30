import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import UserCreateForm from "../views/users/CreateForm";
import Login from "../views/Auth/Login";
import PetAddForm from "../views/pets/AddForm";
import Explore from "../views/explore/Explore"
import Pets from "../views/pets/Pets";
import ObservationForm from "../views/pets/ObservationForm"
import VaccineForm from "../views/pets/VaccineForm";
import WeightForm from "../views/pets/WeightForm";
import MedicinesAddForm from "../views/pets/medicines/MedicinesAddForm";
import authService from "../services/auth";
import OwnerSingUp from "../views/Auth/sing-up/OwnerSingUp";
import Schedule from "../views/schedule/Schedule";
import Inbox from "../views/inbox/Inbox";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/usuarios/crear-profesional',
        name: 'UserCreate',
        component: UserCreateForm,
        meta: {
            requiresGuest: true,
            role: 'professional'
        }
    },
    {
        path: '/mascotas',
        name: 'Pets',
        component: Pets,
        meta: {
            requiresAuth: true,
        },
    },

    {
        path: '/mascotas/agregar',
        name: 'PetAddForm',
        component: PetAddForm,
        meta: {
            requiresAuth: true,
        },
    },
    // TODO: Add this route for single profile of a pet
    // {
    //     path: '/mascotas/:petsId',
    //     name: 'PetProfile',
    //     component: PetProfile,
    //     meta: {
    //         requiresAuth: true,
    //     },
    // },

    {
        path: '/mascotas/:pet_id/observacion/nuevo',
        name: 'ObservationForm',
        component: ObservationForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/pesos/nuevo',
        name: 'WeightForm',
        component: WeightForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/explorar',
        name: 'Explore',
        component: Explore,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/agenda',
        name: 'Schedule',
        component: Schedule,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/casilla',
        name: 'Inbox',
        component: Inbox,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/mascotas/:pet_id/vacunas/nuevo',
        name: 'VaccineForm',
        component: VaccineForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/medicamentos/agregar',
        name: 'MedicinesAddForm',
        component: MedicinesAddForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/about',
        name: 'About',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: function () {
            return import(/* webpackChunkName: "about" */ '../views/About.vue')
        }
    },
    {
        path: '/ingresar',
        name: 'Login',
        component: Login,
        meta: {
            requiresGuest: true,
        }
    },
    {
        path: '/registrarme/amo',
        name: 'OwnerSingUp',
        component: OwnerSingUp,
        meta: {
            requiresGuest: true,
        }
    },
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(route => route.meta.requiresAuth === true)) {
        if (!authService.auth()) {
            next({name: 'Login'});
        } else {
            next()
        }
    } else if (to.matched.some(route => route.meta.requiresGuest === true)) {
        if (authService.auth()) {
            next({name: 'Home'});
        } else {
            next()
        }
    }else{
        next()
    }
});

export default router
