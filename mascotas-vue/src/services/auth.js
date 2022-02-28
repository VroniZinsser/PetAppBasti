import {API} from "@/constants/";
import store from "../store";

const authService = {
    /**
     * Get the authenticated User
     *
     * @returns {Promise<any>}
     */
    me() {
        return fetch(`${API}autenticacion`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Attempts to authenticate the user.
     *
     * @param {{}} credentials
     * @param {string} credentials.email
     * @param {string} credentials.password
     * @returns {Promise<any>}
     */
    login(credentials) {
        return fetch(`${API}autenticacion`, {
            method: 'POST',
            body: JSON.stringify(credentials),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Logs out the user from the back-end
     * Removes the user from the store and local storage
     *
     * @returns {Promise<any>}
     */
    logout() {
        return fetch(`${API}autenticacion`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json())
            .then(() => {
                store.removeUser();
                localStorage.removeItem('user');
            });
    },

    /**
     * Saves the user in the store and in the local storage
     *
     * @param {{}} user
     * @param {int} user.id
     * @param {string} user.email
     * @param {string} user.first_name
     * @param {string} user.last_name
     * @param {{} | null} user.profile_image
     */
    saveAuthUser(user) {
        store.setUser(user);

        localStorage.setItem('user', JSON.stringify({
            'id': user.id,
            'email': user.email,
            'first_name': user.first_name,
            'last_name': user.last_name,
            'profile_image': user.profile_image,
            'is_professional': user.is_professional,
        }));
    },

    removeAuthUser() {
        store.removeUser();
        localStorage.removeItem('user');
    },

    /**
     * Sends an email to the given address with a link to reset the password
     *
     * @param {{}} formData
     * @param {string} formData.email
     * @returns {Promise<any>}
     */
    sendPasswordReset(formData) {
        return fetch(`${API}autenticacion/recuperar-contrasena`, {
            method: 'POST',
            body: JSON.stringify(formData),
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Changes the password of unauthenticated user by mail and token
     *
     * @param {{}} formData
     * @param {string} formData.email
     * @param {string} formData.password
     * @param {string} formData.token
     * @returns {Promise<any>}
     */
    changePassword(formData) {
        return fetch(`${API}autenticacion/cambiar-contrasena`, {
            method: 'POST',
            body: JSON.stringify(formData),
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Changes the password of an authenticated user by current password 
     *
     * @param {{}} formData
     * @param {string} formData.currentPassword
     * @param {string} formData.newPassword
     * @returns {Promise<any>}
     */
    changePasswordAuthenticated(formData) {
        return fetch(`${API}autenticacion/cambiar-contrasena-autenticado`, {
            method: 'POST',
            body: JSON.stringify(formData),
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Returns a boolean, true if the user is authenticated, false if not.
     *
     * @returns {boolean}
     */
    auth() {
        return store.user.id !== null;
    }
}

if (localStorage.getItem('user') !== null) {
    const authUser = JSON.parse(localStorage.getItem('user'));
    store.setUser(authUser);
}

export default authService;
