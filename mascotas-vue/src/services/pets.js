import {API} from "../constants";

const petServices = {
    /**
     * Returns the data necessary for the creation of the add pet form
     *
     * @returns {Promise<any>}
     */
    addForm() {
        return fetch(`${API}mascotas/formulario-agregar`)
            .then(res => res.json());
    },

    /**
     * Add the pet to the database
     *
     * @param data Array
     * @returns {Promise<any>}
     */
    addPet(data) {
        return fetch(`${API}mascotas`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

    /**
     * Get all user's pets
     *
     * @returns {Promise<any>}
     */
    getOwnerPets() {
        return fetch(`${API}mascotas`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

    /**
     * Updates only the observation field of the pet
     *
     * @param pet_id
     * @param data
     * @returns {Promise<any>}
     */
    updateObservation(pet_id, data) {
        return fetch(`${API}mascotas/${pet_id}/observacion`, {
            method: 'POST',
            body: JSON.stringify({
                action: 'update',
                data: data,
            }),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

    /**
     * Deletes content from observation field
     *
     * @returns {Promise<any>}
     */
    deleteObservation(pet_id) {
        return fetch(`${API}mascotas/${pet_id}/observacion`, {
            method: 'POST',
            body: JSON.stringify({
                action: 'delete',
            }),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    }
};

export default petServices;
