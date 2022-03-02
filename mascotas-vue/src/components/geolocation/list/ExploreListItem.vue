<template>
  <li
      class="card explore-list-item"
      :class="isActive ? 'active' : ''"
      @click="$parent.$emit('select-professional', professional.id)"
  >
    <div class="horizontal-bottom-line">
      <p class="professional-name">{{ nameToDisplay(professional) }}</p>

      <p class="card-subtitle">
        {{ professional.city }}, {{ professional.street }} {{ professional.house_number }}
      </p>
    </div>

    <div class="professional-types">
      <div v-for="type in professional.user_types" :key="type.id">
        {{ type.name }}
      </div>
    </div>
  </li>
</template>

<script>
import {nameToDisplay} from "@/helpers";

export default {
  name: "ExploreListItem",
  props: {
    professional: {
      type: Object,
      required: true
    },
    isActive: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      nameToDisplay,
    }
  }
}
</script>
