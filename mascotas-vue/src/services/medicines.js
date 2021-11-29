import {API} from "@/constants/";

const medicineServices = {
    /**
     * Obtains the data necessary for the creation of the form.
     *
     * @returns {Promise<any>}
     */
    addForm() {
        return fetch(`${API}medicamentos/formulario-agregar`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Creates a new medication
     * @param data Array
     * @returns {Promise<any>}
     */
    create(data) {
        return fetch(`${API}medicamentos`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Updates a medication
     * @param data Array
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
     * @param data Array
     * @returns {Promise<any>}
     */
      delete(id) {
        return fetch(`${API}medicamentos/${id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },
}

export default medicineServices;
