import {API} from "../constants";

const petServices = {

    /**
     * Returns the data necessary for the creation of the add pet form
     *
     * @returns {Promise<any>}
     */
    addForm() {
        return fetch(`${API}mascotas/agregar`)
            .then(res => res.json());
    },

    /**
     * Add the pet to the database
     *
     * @param pet
     * @returns {Promise<any>}
     */
    addPet(pet) {
        return fetch(`${API}mascotas/agregar`, {
            method: 'POST',
            body: JSON.stringify(pet),
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
     * Update single fields of the pet
     *
     * @param data
     * @returns {Promise<any>}
     */
     patch(data) {
        return fetch(`${API}mascotas/${data.pets_id}`, {
            method: 'PATCH',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    }
};

export default petServices;
