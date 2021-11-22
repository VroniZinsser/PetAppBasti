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
    },

    /**
     * Get all vaccines of the pet
     *
     * @param petId
     * @returns {Promise<any>}
     */
     getVaccines(petId) {
        return fetch(`${API}mascotas/${petId}/vacunas`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
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
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
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
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },
};

export default petServices;
