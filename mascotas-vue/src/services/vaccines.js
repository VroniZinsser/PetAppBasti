import {API} from "../constants";

//TODO: change hardcoded pet-id in rest url
const vaccineService = {
    /**
     * Get all vaccines of one pet
     *
     * @returns {Promise<any>}
     */
    getVaccinesByPet() {
        return fetch(`${API}mascotas/1/vacunas`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },

    /**
     * Creates new vaccine
     *
     * @param vaccine
     * @returns {Promise<any>}
     */
    create(vaccine) {
        return fetch(`${API}vacunas`, {
            method: 'POST',
            body: JSON.stringify(vaccine),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            credentials: 'include'
        }).then(res => res.json());
    },
};

export default vaccineService;
