<template>
  <div class="pet-menu-item">
    <a :href="'#/mascotas/' + pet.id" :class="is_active ? 'active' : ''">
      <img :src="getCompletePath(pet.image.src)" :alt="pet.image.alt">
      <span>{{ pet.name }}</span>
    </a>
  </div>
</template>

<script>
import {PATH_IMG} from "../../../constants";

export default {
  name: "PetMenuItem",
  props: {
    is_active: {
      type: Boolean,
      default: false,
    },
    pet: {
      type: Object,
      required: true,
    },
  },
  methods: {
    getCompletePath(path) {
      return PATH_IMG + path;
    },
  },
}
</script>
