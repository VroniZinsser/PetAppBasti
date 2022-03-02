<template>
  <header>
    <router-link :to="{name: 'Pets'}">
      <span class="sr-only">Volver al listado de mascotas</span>
      <span class="material-icons">arrow_back</span>
    </router-link>

    <h1>{{ title }}</h1>
  </header>
</template>

<script>
export default {
  name: "PetDetailMedicalListHeader",
  components: {},
  props: {
    title: {
      type: String,
      required: true,
    }
  },
  data() {
    return {}
  },
  methods: {},
  mounted() {
  }
}
</script>