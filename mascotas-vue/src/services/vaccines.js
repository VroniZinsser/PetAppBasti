import {API} from "../constants";

const vaccineService = {
    /**
     * Creates new vaccine
     *
     * @param data Array
     * @returns {Promise<any>}
     */
    create(data) {
        return fetch(`${API}vacunas`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

    /**
     * Updates a vaccine
     * @param data Array
     * @returns {Promise<any>}
     */
     update(data, id) {
        return fetch(`${API}vacunas/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

     /**
     * Deletes a vaccine
     * @param data Array
     * @returns {Promise<any>}
     */
      delete(id) {
        return fetch(`${API}vacunas/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },
};

export default vaccineService;
