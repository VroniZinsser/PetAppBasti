<template>
  <div class="pet-menu-item">
    <div
        :class="divClass"
        @click="$parent.$emit('show-pet', pet.id)"
    >

      <img :src="createImgPath(pet.image.src)" :alt="pet.image.alt"/>

      <span>{{ pet.name }}</span>
    </div>
  </div>
</template>

<script>
import {createImgPath} from "@/helpers";

export default {
  name: "PetMenuListItem",
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
      createImgPath,
    }
  },
  computed: {
    divClass() {
      let btnClass = 'menu-item-link';

      if (this.is_active) {
        btnClass += ' active'
      }

      return btnClass
    },
  },
}
</script>
