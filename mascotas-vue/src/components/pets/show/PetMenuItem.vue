<template>
  <div class="pet-menu-item">
      <div 
        class="menu-item-link" 
        :class="is_active ? 'active' : ''"
        @click="$parent.$emit('show-pet', pet.id)">
        <img :src="createImgPath(pet.image.src)" :alt="pet.image.alt">
        <span>{{ pet.name }}</span>
      </div>
  </div>
</template>

<script>
import {createImgPath} from "@/helpers";

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
  data() {
    return {
      createImgPath: createImgPath,
    }
  }
}
</script>
