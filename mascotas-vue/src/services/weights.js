import {API} from "../constants";

//TODO: change hardcoded pet-ids in rest urls
const weightService = {

    /**
     * Get all weights of one pet
     *
     * @returns {Promise<any>}
     */
    getWeightsByPet() {
        return fetch(`${API}mascotas/1/pesos`, {
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },

    
    /**
     * Creates new weight
     *
     * @param weight
     * @returns {Promise<any>}
     */
     create(weight) {
        return fetch(`${API}pesos`, {
            method: 'POST',
            body: JSON.stringify(weight),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },
};

export default weightService;
