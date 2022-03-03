import {PATH_IMG} from "@/constants";
import {PATH_STATIC_IMG} from "@/constants";
import {URL_REQUESTS} from "@/constants";
import store from "@/store";
import router from "@/router";

const formatDate = function(date) {
        if (!date) return null

        const [year, month, day] = date.split('-')
        return `${day}/${month}/${year}`
    
};

const createImgPath = function(path) {
    return PATH_IMG + path;
}

const createStaticImgPath = function(path) {
    return PATH_STATIC_IMG + path;
}

const createRequestAcceptUrl = function (requestId) {
    return URL_REQUESTS + requestId + "/aceptar";
}

const nameToDisplay = function(user) {
    return user.public_name ? user.public_name : user.first_name + ' ' + user.last_name;
}

const getCurrentDate = function() {
    return (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10);
}

const displayWeight = function (weight) {
    if (weight < 1000) {
        return weight + 'g';
    } else {
        return (weight / 1000) + 'kg';
    }
}

/**
 * If the server response contains an access deny set up a message to the user and send back to previous page
 * @param {*} res 
 * @returns bool true if there is an access error
 */
const handleAccessError = function(res) {
    let hasError = false;
    
    if (res.access === false || res.message === 'Unauthenticated.') {
        hasError = true;
        store.setStatus({
            msg: "Esta acción no está habilitada para tu cuenta.",
            type: 'error',
        });

        if (store.user.is_professional) {
            router.push({ name: 'HomeProfessional' });
        } else {
            router.push({ name: 'Pets' });
        }
    }
    return hasError;
}

/**
 * If the server response shows the user is unauthenticated set up a message and log out the user from the frontend
 * @param {*} res 
 * @returns bool true if there is an authentication error
 */
const handleAuthenticationError = function (res) {
    let hasError = false;
    if (res.message === 'Unauthenticated.') {
        hasError = true;
        store.setStatus({
            msg: 'Por favor ingresá nuevamente con tus credenciales',
            type: 'warning',
        });
        store.removeUser();
        localStorage.removeItem('user')
        router.push({ name: 'Login' });
    }
    return hasError;
}

export {
    formatDate,
    createImgPath,
    createStaticImgPath,
    createRequestAcceptUrl,
    nameToDisplay,
    getCurrentDate,
    displayWeight,
    handleAccessError,
    handleAuthenticationError
}