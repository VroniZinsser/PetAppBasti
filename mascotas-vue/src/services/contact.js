import {API} from "@/constants/";

const contactService = {
    /**
     * Gets all requests created as user owner
     * @returns {Promise<any>}
     * @constructor
     */
    getOwnerSharedPets() {
        return fetch(`${API}peticiones/aceptadas`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Gets all the requests that were accepted as a professional user
     * @returns {Promise<any>}
     * @constructor
     */
    getProfessionalSharedPets() {
        return fetch(`${API}peticiones/profesional`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    acceptGenerate(id){
        return fetch(`${API}peticiones/${id}/aceptar`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Create a request to share a pet
     *
     * @param {{}} data
     * @param {string | null} data.description
     * @param {string | date} data.expiration_date
     * @param {int} data.pet_id
     * @param {int} data.professional_id
     * @returns {Promise<any>}
     */
    create(data) {
        return fetch(`${API}peticiones`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Update an already created request
     *
     * @param {{}} data
     * @param {string | null} data.description
     * @param {string | date} data.expiration_date
     * @param {int} data.pet_id
     * @param {int} id
     * @returns {Promise<any>}
     */
    update(data, id) {
        return fetch(`${API}peticiones/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Accepts an already created request
     * @param {int} id
     * @returns {Promise<any>}
     */
    accept(id) {
        return fetch(`${API}peticiones/${id}/aceptar`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Delete a request
     *
     * @param {int} id
     * @returns {Promise<any>}
     */
    delete(id) {
        return fetch(`${API}peticiones/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },
}

export default contactService;
