import {API} from "../constants";

const weightService = {
    /**
     * Creates new weight
     *
     * @param {{}} data
     * @param {int} data.weight
     * @param {string | date} data.date
     * @param {int} data.pet_id
     * @returns {Promise<any>}
     */
    create(data) {
        return fetch(`${API}pesos`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Updates a weight
     *
     * @param {{}} data
     * @param {int} data.weight
     * @param {string | date} data.date
     * @param {int} data.pet_id
     * @param {int} id
     * @returns {Promise<any>}
     */
    update(data, id) {
        return fetch(`${API}pesos/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Deletes a weight
     * @param {int} id
     * @returns {Promise<any>}
     */
    delete(id) {
        return fetch(`${API}pesos/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },
};

export default weightService;
