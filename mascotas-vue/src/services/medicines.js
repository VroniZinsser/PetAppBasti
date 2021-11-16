import {API} from "@/constants/";

const medicineServices = {
    addForm(){
        return fetch(`${API}medicamentos/formulario-agregar`)
            .then(res => res.json());
    },

    add(petId, data){
        return fetch(`${API}mascotas/${petId}/medicamentos`, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
        }).then(res => res.json());
    },
}

export default medicineServices;
