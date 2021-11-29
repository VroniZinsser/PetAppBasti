import {API} from '@/constants';

let users = null

const userService = {
    /**
     * Creates a new user.
     *
     * @param {{}} user data for the user's creation
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
}
export default userService;
