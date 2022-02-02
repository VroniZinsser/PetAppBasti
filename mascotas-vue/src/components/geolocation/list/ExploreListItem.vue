<template>
  <li 
    class="card explore-list-item"
    :class="isActive ? 'active' : ''" 
    @click="$parent.$emit('select-professional', professional.id)"
  >
    <div class="horizontal-bottom-line">
      <p v-if="professional.public_name" class="professional-name">{{ professional.public_name }}</p>
      <p v-else class="professional-name">{{ professional.first_name }} {{ professional.last_name }}</p>
      <p class="card-subtitle">
        {{ professional.city }}, {{ professional.street }} {{ professional.house_number }}
      </p>
    </div>
    <div class="professional-types">
        <div v-for="type in professional.user_types" :key="type.id">
            {{type.name}}
        </div>
    </div>
  </li>
</template>

<script>
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
}
</script>
