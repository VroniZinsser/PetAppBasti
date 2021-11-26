import {API} from "../constants";

const weightService = {
    /**
     * Creates new weight
     *
     * @param weight
     * @returns {Promise<any>}
     */
    create(weight) {
        return fetch(`${API}pesos`, {
            method: 'POST',
            body: JSON.stringify(weight),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

    /**
     * Updates a weight
     * @param data Array
     * @returns {Promise<any>}
     */
     update(data, id) {
        return fetch(`${API}pesos/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

     /**
     * Deletes a weight
     * @param data Array
     * @returns {Promise<any>}
     */
      delete(id) {
        return fetch(`${API}pesos/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },
};

export default weightService;
