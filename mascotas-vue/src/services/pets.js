import {API} from "../constant";

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
};

export default petServices;
