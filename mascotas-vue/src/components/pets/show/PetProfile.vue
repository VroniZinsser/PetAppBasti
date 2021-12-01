<template>
  <div class="pet-profile">
    <div class="pet-profile-header">
      <h2>Perfil</h2>

      <Dropdown @deletePet="deletePet()"></Dropdown>
    </div>

    <div class="pet-profile-body">
      <ul>
        <li>
          <span>Nombre:</span>
          <span>{{ pet.name }}</span>
        </li>
        <li>
          <span>Especie:</span>
          <span>{{ pet.species.name }}</span>
        </li>
        <li v-if="pet.breed">
          <span>Raza:</span>
          <span>{{ pet.breed }}</span>
        </li>
        <li>
          <span>Castrado:</span>
          <span>{{ pet.neutered ? 'Sí' : 'No' }}</span>
        </li>
        <li>
          <span>Sexo:</span>
          <span>{{ pet.sex.name }}</span>
        </li>
        <li v-if="pet.date_of_birth">
          <span>Fecha de nacimiento:</span>
          <span>{{ formatted_date_of_birth }}</span>
        </li>
        <li v-if="pet.temperament" class="wide-content">
          <span>Temperamento:</span>
          <span>{{ pet.temperament }}</span>
        </li>
      </ul>
    </div>
    
    <div class="pet-profile-footer">
      <router-link :to="{name: 'PetEditForm', params: {'pet_id': this.pet.id}}" class="main-btn">
        Editar perfil
      </router-link>
    </div>
  </div>
</template>

<script>
import {formatDate} from "../../../helpers";
import Dropdown from "../../general/buttons/Dropdown";
import petServices from "../../../services/pets";
import store from "../../../store";

export default {
  name: "PetProfile",
  components: {Dropdown},
  props: {
    pet: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      store,
      formatted_date_of_birth: formatDate(this.pet.date_of_birth),
    }
  },
  methods: {
    deletePet() {
      petServices.deletePet(this.pet.id)
          .then(res => {
            if (!res.success) {
              this.store.setStatus({
                msg: 'Algo salió mal. No se pudo eliminar la mascota.',
                type: 'error',
              });
            } else {
              this.store.setStatus({
                msg: 'Mascota eliminada con éxito',
                type: 'success',
              });
            }

            this.$emit('deleted');
          })
    }
  }
}
</script>
