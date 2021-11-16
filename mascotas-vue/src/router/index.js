import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import UserCreateForm from "../views/users/CreateForm";
import UserLoginForm from "../views/users/LoginForm";
import PetAddForm from "../views/pets/AddForm";
import ShowMap from "../views/map/ShowMap";
import PetShowList from "../views/pets/ShowList"
import ObservationForm from "../views/pets/ObservationForm"
import VaccineForm from "../views/pets/VaccineForm";
import WeightForm from "../views/pets/WeightForm";

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
            requiresAuth: true,
            role: 'professional'
        }
    },
    {
        path: '/usuarios/login',
        name: 'UserLogin',
        component: UserLoginForm,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/mascotas',
        name: 'PetShowList',
        component: PetShowList,
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
        path: '/mascotas/:petsId/pesos/nuevo',
        name: 'WeightForm',
        component: WeightForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mapa',
        name: 'ShowMap',
        component: ShowMap,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:petsId/observacion/nuevo',
        name: 'ObservationForm',
        component: ObservationForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:petsId/vacunas/nuevo',
        name: 'VaccineForm',
        component: VaccineForm,
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
    }
]

const router = new VueRouter({
    routes
})

export default router
