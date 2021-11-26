import {API} from "@/constants/";

const medicineServices = {
    /**
     * Obtains the data necessary for the creation of the form.
     *
     * @returns {Promise<any>}
     */
    addForm() {
        return fetch(`${API}medicamentos/formulario-agregar`)
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
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },
}

export default medicineServices;
