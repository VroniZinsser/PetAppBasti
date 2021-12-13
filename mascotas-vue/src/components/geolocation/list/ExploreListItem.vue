<template>
  <li 
    class="card explore-list-item"
    :class="isActive ? 'active' : ''" 
    @click="$parent.$emit('select-professional', professional.id)"
  >
    <div>
      <p class="professional-name">{{ professional.first_name }} {{ professional.last_name }} </p>

      <p class="card-subtitle">
        {{ professional.city }}, {{ professional.street }} {{ professional.house_number }}
      </p>
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
