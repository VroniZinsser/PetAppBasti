<template>
    <v-container>
        <ul>
            <li v-for="pet in pets" :key="pet.id">
                <PetMenuItem :pet="pet" :is_active="pet.id === active"></PetMenuItem>
            </li>
        </ul>
    </v-container>   
</template>
<script>
import PetMenuItem from "@/components/pets/show/PetMenuItem";
export default {
  name: "PetMenu",
  components: {
      PetMenuItem
  },
  props: {
    active: {
      type: Number,
    },
    pets: {
      type: Array,
      required: true,
    }
  }
}
</script>
<style scoped>
    ul {
        display: flex;
        list-style: none;
    }
</style>