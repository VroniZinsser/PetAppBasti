<template>
  <header>
    <a @click="$router.back()">
      <span class="sr-only">Volver a la página anterior</span>

      <span class="material-icons">arrow_back</span>
    </a>

    <h1>{{ title }}</h1>
  </header>
</template>

<script>
import store from "@/store";

export default {
  name: "PetDetailMedicalListHeader",
  props: {
    title: {
      type: String,
      required: true,
    }
  },
  data() {
    return {
      store
    }
  },
  computed: {
    isOwner() {
      return !this.store.user.is_professional;
    },
  }
}
</script>