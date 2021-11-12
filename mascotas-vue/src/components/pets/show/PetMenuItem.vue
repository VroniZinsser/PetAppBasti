<template>
    <div class="menuItemContainer">
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

    a {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    img {
        max-width: 48px;
        border-radius: 50%;
        border: 3px solid #EFE5DC;
        background-color: #EFE5DC;
    }

    .menuItemContainer {
        margin-right: 1em;
    }

    span {
        display: block;
        text-align: center;
        color: #333333;
        font-family: 'Jost';
        font-size: 12px;
    }

    .active img {
        border-color: #FFCE8D;
    }

    .active span {
        color: #858585;
    }
</style>
