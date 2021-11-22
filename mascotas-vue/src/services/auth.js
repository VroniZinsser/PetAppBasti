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
     * @param {{} | null} user.image
     */
    saveAuthUser(user) {
        store.setUser(user);

        localStorage.setItem('user', JSON.stringify({
            'id': user.id,
            'email': user.email,
            'first_name': user.first_name,
            'last_name': user.last_name,
            'image': user.image,
        }));
    },

    /**
     * Save in the store the user who is in local storage
     */
    refreshAuthUser() {
        if (localStorage.getItem('user') !== null) {
            const authUser = JSON.parse(localStorage.getItem('user'));
            store.setUser(authUser);
        }
    },

    /**
     * Returns a boolean, true if the user is authenticated, false if not.
     *
     * @returns {boolean}
     */
    auth() {
        // TODO: Actualmente lo dejare con esta linea de código, porque si no me redirecciona aunque este autenticado, porque primero hace la consulta del router y luego se aplica el cambio en el store
        return localStorage.getItem('user') !== null;
        // return store.user.id !== null;
    }
}

export default authService;
