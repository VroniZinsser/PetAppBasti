import {API} from "../constants";

const petServices = {
    /**
     * Returns the data necessary for the creation of the add pet form
     *
     * @returns {Promise<any>}
     */
    createForm() {
        return fetch(`${API}mascotas/formulario-agregar`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
            .then(res => res.json());
    },

    /**
     * Search for a pet and return its data
     *
     * @param {string | int} pet_id
     * @returns {Promise<any>}
     */
    find(pet_id) {
        return fetch(`${API}mascotas/${pet_id}`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        })
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
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Updates the pet with the given id
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
     * @param pet_id
     * @returns {Promise<any>}
     */
    updatePet(data, pet_id) {
        return fetch(`${API}mascotas/${pet_id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Deletes the pet from the database
     *
     * @param {int} pet_id
     * @returns {Promise<any>}
     */
    deletePet(pet_id) {
        return fetch(`${API}mascotas/${pet_id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Get all user's pets
     *
     * @returns {Promise<any>}
     */
    getOwnerPets() {
        return fetch(`${API}mascotas`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
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
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
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
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Get all vaccines of the pet
     *
     * @param petId
     * @returns {Promise<any>}
     */
    getVaccines(petId) {
        return fetch(`${API}mascotas/${petId}/vacunas`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Get all medicines of the pet
     *
     * @param petId
     * @returns {Promise<any>}
     */
    getMedicines(petId) {
        return fetch(`${API}mascotas/${petId}/medicamentos`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Get all weights of the pet
     *
     * @param petId
     * @returns {Promise<any>}
     */
    getWeights(petId) {
        return fetch(`${API}mascotas/${petId}/pesos`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    getObservation(pet_id){
        return fetch(`${API}mascotas/${pet_id}/observacion`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    }
};

export default petServices;
