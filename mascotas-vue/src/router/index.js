import Vue from 'vue'
import VueRouter from 'vue-router'
import authService from "@/services/auth";
import ProfessionalExplore from "../views/explore/ProfessionalExplore";
import Login from "../views/auth/login/UserLogin";
import PetMedicineForm from "../views/pet/medicine/PetMedicineForm";
import ResetPasswordForm from "../views/auth/password/ResetPasswordForm";
import ChangePassword from "../views/auth/password/ChangePassword";
import ChangePasswordAuthenticated from "../views/auth/password/ChangePasswordAuthenticated";
import PetObservationForm from "../views/pet/observation/PetObservationForm";
import OwnerSignUp from "../views/auth/signUp/OwnerSignUp";
import Pets from "../views/pet/PetList";
import PetAddForm from "../views/pet/PetAddForm";
import PetEditForm from "../views/pet/PetEditForm";
import PetShared from "../views/pet/PetShared";
import OwnerEdit from "../views/user/owner/OwnerEditForm";
import ProfessionalEdit from "../views/user/professional/ProfessionalEditForm";
import ProfessionalHome from "../views/user/professional/ProfessionalHome";
import ProfessionalSignUp from "../views/auth/signUp/ProfessionalSignUp";
import ProfessionalProfile from "../views/user/professional/ProfessionalProfile";
import TaskSchedule from "../views/schedule/TaskSchedule";
import OwnerShareList from "../views/contact/OwnerShareList";
import PetVaccineForm from "../views/pet/vaccine/PetVaccineForm";
import PetWeightForm from "../views/pet/weight/PetWeightForm";
import PetWeightList from "../views/pet/weight/PetWeightList";
import PetVaccineList from "../views/pet/vaccine/PetVaccineList";
import AcceptSharedPetRequest from "@/views/contact/SharePetAccept";
import PageNotFound from "@/views/PageNotFound";
import PetMedicineList from "@/views/pet/medicine/PetMedicineList";

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
        component: TaskSchedule,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/compartir',
        name: 'SharedPets',
        component: OwnerShareList,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/explorar',
        name: 'Explore',
        component: ProfessionalExplore,
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
        path: '/recuperar-contrasena',
        name: 'ResetPasswordForm',
        component: ResetPasswordForm,
        meta: {
            requiresGuest: true,
        }
    },
    {
        path: '/cambiar-contrasena',
        name: 'ChangePassword',
        component: ChangePassword,
        meta: {
            requiresGuest: true,
        }
    },
      {
        path: '/profesional/agenda',
        name: 'ScheduleProfessional',
        component: TaskSchedule,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/profesional/explorar',
        name: 'ExploreProfessional',
        component: ProfessionalExplore,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/profesional/home',
        name: 'HomeProfessional',
        component: ProfessionalHome,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/registrarme/amo',
        name: 'OwnerSignUp',
        component: OwnerSignUp,
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
        name: 'MedicineForm',
        component: PetMedicineForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/medicamentos/:medicine_id/editar',
        name: 'MedicineFormEdit',
        component: PetMedicineForm,
        meta: {
            requiresAuth: true,
            editing: true,
        },
    },
    {
        path: '/mascotas/:pet_id/medicamentos',
        name: 'MedicineList',
        component: PetMedicineList,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/compartidas/:pet_id',
        name: 'PetShared',
        component: PetShared,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/observacion',
        name: 'ObservationForm',
        component: PetObservationForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/pesos/agregar',
        name: 'WeightForm',
        component: PetWeightForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/pesos/:weight_id/editar',
        name: 'WeightFormEdit',
        component: PetWeightForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/pesos',
        name: 'WeightList',
        component: PetWeightList,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/vacunas',
        name: 'VaccineList',
        component: PetVaccineList,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/vacunas/agregar',
        name: 'VaccineForm',
        component: PetVaccineForm,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/mascotas/:pet_id/vacunas/:vaccine_id/editar',
        name: 'VaccineFormEdit',
        component: PetVaccineForm,
        meta: {
            requiresAuth: true,
            editing: true,
        },
    },
    {
        path: '/profesionales/:professional_id',
        name: 'ProfessionalProfile',
        component: ProfessionalProfile,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/peticiones/:request_id/aceptar',
        name: 'AcceptRequest',
        component: AcceptSharedPetRequest,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/perfil/editar/profesional',
        name: 'ProfessionalEdit',
        component: ProfessionalEdit,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/perfil/editar',
        name: 'OwnerEdit',
        component: OwnerEdit,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/perfil/editar/contrasena',
        name: 'ChangePasswordAuthenticated',
        component: ChangePasswordAuthenticated,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '*',
        name: 'PageNotFound',
        component: PageNotFound,
    }
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
