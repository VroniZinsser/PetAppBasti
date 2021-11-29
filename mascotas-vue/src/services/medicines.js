import {API} from "@/constants/";

const medicineServices = {
    /**
     * Obtains the data necessary for the creation of the form.
     *
     * @returns {Promise<any>}
     */
    createForm() {
        return fetch(`${API}medicamentos/formulario-agregar`)
            .then(res => res.json());
    },

    /**
     * Creates a new medication
     * @param {{}} data
     * @param {string} data.name
     * @param {string} data.quantity
     * @param {string | date} data.start_date
     * @param {string | date} data.end_date
     * @param {[]} data.hours
     * @param {string | int} data.pet_id
     * @returns {Promise<any>}
     */
    create(data) {
        return fetch(`${API}medicamentos`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

    /**
     * Updates a medication
     * @param {{}} data
     * @param {string} data.name
     * @param {string} data.quantity
     * @param {string | date} data.start_date
     * @param {string | date} data.end_date
     * @param {[]} data.hours
     * @param {string | int} id
     * @returns {Promise<any>}
     */
    update(data, id) {
        return fetch(`${API}medicamentos/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

    /**
     * Deletes a medication
     * @returns {Promise<any>}
     * @param {string | int} id
     */
    delete(id) {
        return fetch(`${API}medicamentos/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },
}

export default medicineServices;
