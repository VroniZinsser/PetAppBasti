<template>
  <div class="pet-profile">
    <p>{{ pet.name }}</p>
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
        <span>{{ pet.neutered ? 'Sí' : 'No'}}</span>
      </li>
      <li>
        <span>Sexo:</span>
        <span>{{ pet.sex.name }}</span>
      </li>
      <li v-if="pet.date_of_birth">
        <span>Fecha de nacimiento:</span>
        <span>{{ pet.date_of_birth }}</span>
      </li>
      <li v-if="pet.temperament">
        <span>Temperamento:</span>
        <span>{{ pet.temperament }}</span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "PetProfile",
  props: {
    pet: {
      type: Object,
      required: true
    },
  },
}
</script>