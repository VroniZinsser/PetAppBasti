<template>
    <div class="menuItemContainer">
        <a href="#">
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
    }
  }, 
  methods: {
    getCompletePath(path) {
      return PATH_IMG + path
    }
  }
}

</script>

<style scoped>
    img {
        max-width: 80px;
        border-radius: 50%;
        border: 5px solid #EFE5DC;
    }

    .menuItemContainer {
        margin-right: 1em;
    }

    span {
        display: block;
        text-align: center;
    }
</style>
