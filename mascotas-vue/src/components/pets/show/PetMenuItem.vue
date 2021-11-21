<template>
    <div class="pet-menu-item">
        <div 
          class="menu-item-link" 
          :class="is_active ? 'active' : ''"
          @click="$parent.$emit('show-pet', pet.id)">
          <img :src="getCompletePath(pet.image.src)" :alt="pet.image.alt">
          <span>{{ pet.name }}</span>
        </div>
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
    }
  }, 
  methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    },
  }
}
</script>
