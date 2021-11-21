<template>
  <div class="pet-profile">
    <div class="pet-profile-header">
      <h2>Perfil</h2>
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
      <a href="#">Editar perfil</a>
    </div>
  </div>
</template>

<script>
import {formatDate} from "../../../helpers";

export default {
  name: "PetProfile",
  props: {
    pet: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
    formatted_date_of_birth: formatDate(this.pet.date_of_birth),
  }}
}
</script>
