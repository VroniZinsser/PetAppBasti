import {API} from '@/constants';

let users = null

const userService = {
    /**
     * Creates a new user.
     *
     * @param {{}} user
     * @param {string} user.first_name
     * @param {string} user.last_name
     * @param {string} user.email
     * @param {boolean} user.email_visible
     * @param {string} user.password
     * @param {string} user.country
     * @param {string} user.state
     * @param {string} user.city
     * @param {string | number} user.postal_code
     * @param {string} user.district
     * @param {string} user.street
     * @param {string | number} user.house_number
     * @param {string} user.apartment
     * @param {string} user.location_id
     * @param {number} user.latitude
     * @param {number} user.longitude
     * @param {string | int} user.dni
     * @param {string} user.public_name
     * @param {string} user.description
     * @param {string | int} user.whatsapp
     * @param {string} user.instagram
     * @param {string} user.facebook
     * @param {string} user.web
     * @param {[]} user.user_types
     * @param {string} user.photo
     * @return {Promise<{headers: Headers, ok: boolean, redirected: boolean, status: number, statusText: string, trailer: Promise<Headers>, type: ResponseType, url: string, clone(): Response, body: ReadableStream | null, bodyUsed: boolean, arrayBuffer(): Promise<ArrayBuffer>, blob(): Promise<Blob>, formData(): Promise<FormData>, json(): Promise<any>, text(): Promise<string>} | never>}
     */
    create(user) {
        return fetch(`${API}profesionales`, {
            method: 'POST',
            body: JSON.stringify(user),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(rta => rta.json())
            .then(respuesta => {
                if (respuesta.success) {
                    if (Array.isArray(users)) {
                        users.push(respuesta.user);
                    }
                }
                return {...respuesta};
            });
    },

    /**
     * Attempt to create a new user with the owner characteristic in the database, and returns the created user in case of success
     *
     * @param {{}} data
     * @param {string} data.first_name
     * @param {string} data.last_name
     * @param {string} data.email
     * @param {string} data.password
     * @returns {Promise<any>}
     */
    createOwner(data) {
        return fetch(`${API}usuarios/amo`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Returns necessary data for the users creation form
     *
     * @returns {Promise<any>}
     */
    createForm() {
        return fetch(`${API}profesionales/formulario-agregar`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Returns all user types that belong to professionals
     *
     * @returns {Promise<any>}
     */
    getProfessionalUserTypes() {
        return fetch(`${API}profesionales/tipos`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Returns users with any usertype related to professionals
     *
     * @returns {Promise<any>}
     */
    getProfessionals() {
        return fetch(`${API}profesionales`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Gets a user by its id
     *
     * @param {string | int} id
     * @returns {Promise<any>}
     */
    getUserById(id) {
        return fetch(`${API}usuarios/${id}`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Updates an existing user.
     *
     * @param {{}} user
     * @param {string} user.first_name
     * @param {string} user.last_name
     * @param {string} user.email
     * @param {boolean} user.email_visible
     * @param {string} user.password
     * @param {string} user.country
     * @param {string} user.state
     * @param {string} user.city
     * @param {string | number} user.postal_code
     * @param {string} user.district
     * @param {string} user.street
     * @param {string | number} user.house_number
     * @param {string} user.apartment
     * @param {string} user.location_id
     * @param {number} user.latitude
     * @param {number} user.longitude
     * @param {string | int} user.dni
     * @param {string} user.public_name
     * @param {string} user.description
     * @param {string | int} user.whatsapp
     * @param {string} user.instagram
     * @param {string} user.facebook
     * @param {string} user.web
     * @param {[]} user.user_types
     * @param {string} user.photo
     * @return {Promise<{headers: Headers, ok: boolean, redirected: boolean, status: number, statusText: string, trailer: Promise<Headers>, type: ResponseType, url: string, clone(): Response, body: ReadableStream | null, bodyUsed: boolean, arrayBuffer(): Promise<ArrayBuffer>, blob(): Promise<Blob>, formData(): Promise<FormData>, json(): Promise<any>, text(): Promise<string>} | never>}
     */
    update(user, id) {
        return fetch(`${API}profesionales/${id}`, {
            method: 'PUT',
            body: JSON.stringify(user),
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            credentials: 'include'
        })
            .then(rta => rta.json())
            .then(respuesta => {
                // if (respuesta.success) {
                //     if (Array.isArray(users)) {
                //         users.push(respuesta.user);
                //     }
                // }
                return { ...respuesta };
            });
    },
}
export default userService;
