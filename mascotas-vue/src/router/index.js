import Vue from 'vue'
import VueRouter from 'vue-router'
import authService from "../services/auth";
import Explore from "../views/explore/Explore"
// import Home from '../views/Home.vue'
import Inbox from "../views/inbox/Inbox";
import Login from "../views/Auth/Login";
import MedicinesAddForm from "../views/pets/medicines/MedicinesAddForm";
import ObservationForm from "../views/pets/ObservationForm"
import OwnerSingUp from "../views/Auth/sing-up/OwnerSingUp";
import Pets from "../views/pets/Pets";
import PetAddForm from "../views/pets/AddForm";
import PetEditForm from "../views/pets/EditForm";
import ProfessionalSignUp from "../views/users/ProfessionalSignUp";
import Schedule from "../views/schedule/Schedule";
import VaccineForm from "../views/pets/VaccineForm";
import WeightForm from "../views/pets/WeightForm";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Pets
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
        path: '/explorar',
        name: 'Explore',
        component: Explore,
        meta: {
            requiresAuth: true,
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
    {
        path: '/registrarme/profesional',
        name: 'UserCreate',
        component: ProfessionalSignUp,
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
    {
        path: '/mascotas/:pet_id/editar',
        name: 'PetEditForm',
        component: PetEditForm,
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
        path: '/mascotas/:pet_id/observacion',
        name: 'ObservationForm',
        component: ObservationForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/pesos/agregar',
        name: 'WeightForm',
        component: WeightForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/vacunas/agregar',
        name: 'VaccineForm',
        component: VaccineForm,
        meta: {
            requiresAuth: true,
        },
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
    } else {
        next()
    }
});

export default router
