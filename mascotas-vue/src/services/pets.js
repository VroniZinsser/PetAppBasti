import {API} from "../constants";

const petServices = {
    /**
     * Returns the data necessary for the creation of the add pet form
     *
     * @returns {Promise<any>}
     */
    createForm() {
        return fetch(`${API}mascotas/formulario-agregar`)
            .then(res => res.json());
    },

    /**
     * Add the pet to the database
     *
     * @param {{}} data
     * @param {string} data.breed
     * @param {string | date} data.date_of_birth
     * @param {string} data.name
     * @param {boolean} data.neutered
     * @param {string} data.photo
     * @param {string} data.temperament
     * @param {int} data.sex_id
     * @param {int} data.species_id
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
     * @param {string | int} pet_id
     * @param {{}} data
     * @param {string} data.observation
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
     * @param {string | int} pet_id
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
