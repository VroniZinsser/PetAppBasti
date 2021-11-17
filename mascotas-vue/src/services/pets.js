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
     * Updates only the observation field of the pet
     *
     * @param data
     * @returns {Promise<any>}
     */
    updateObservation(data) {
        return fetch(`${API}observacion`, {
            method: 'POST',
            body: JSON.stringify({
                action:'update',
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
    deleteObservation(data) {
        return fetch(`${API}observacion`, {
            method: 'POST',
            body: JSON.stringify({
                action:'delete',
                data: data
            }),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    }
};

export default petServices;
