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
     * Add a new medication to a pet
     * @param petId Int
     * @param data Array
     * @returns {Promise<any>}
     */
    add(petId, data) {
        return fetch(`${API}mascotas/${petId}/medicamentos`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },
}

export default medicineServices;
