<template>
  <header>
    <router-link :to="{name: routerBackLink}">
      <span class="sr-only">Volver al listado de mascotas</span>

      <span class="material-icons">arrow_back</span>
    </router-link>

    <h1>{{ title }}</h1>
  </header>
</template>

<script>
export default {
  name: "PetDetailMedicalListHeader",
  props: {
    title: {
      type: String,
      required: true,
    }
  },
  computed: {
    routerBackLink() {
      return this.$route.meta.ownerView ? 'Pets' : 'HomeProfessional';
    }
  }
}
</script>