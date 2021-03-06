import {API} from "../constants";

const vaccineService = {
    /**
     * Search for a vaccine and return its data
     *
     * @param {string | int} vaccine_id
     * @returns {Promise<any>}
     */
    find(vaccine_id) {
        return fetch(`${API}vacunas/${vaccine_id}`, {
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Creates new vaccine
     *
     * @param {{}} data
     * @param {string | date} data.name
     * @param {string | date} data.date
     * @param {int} data.pet_id
     * @returns {Promise<any>}
     */
    create(data) {
        return fetch(`${API}vacunas`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Updates a vaccine
     *
     * @param {{}} data
     * @param {string | date} data.name
     * @param {string | date} data.date
     * @param {int} data.pet_id
     * @param {int} id
     * @returns {Promise<any>}
     */
    update(data, id) {
        return fetch(`${API}vacunas/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Deletes a vaccine
     *
     * @param {int} id
     * @returns {Promise<any>}
     */
    delete(id) {
        return fetch(`${API}vacunas/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },
};

export default vaccineService;
