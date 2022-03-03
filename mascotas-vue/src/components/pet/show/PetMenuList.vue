<template>
  <div class="pet-menu">
    <ul>
      <li v-for="pet in pets" :key="pet.id">
        <PetMenuItem :pet="pet" :is_active="pet.id === active"></PetMenuItem>
      </li>
    </ul>
  </div>
</template>

<script>
import PetMenuItem from "@/components/pet/show/PetMenuListItem";

export default {
  name: "PetMenuList",
  components: {PetMenuItem},
  props: {
    active: {
      type: Number,
    },
    pets: {
      type: Array,
      required: true,
    }
  },
}
</script>
