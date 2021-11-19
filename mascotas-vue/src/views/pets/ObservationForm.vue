<template>
  <v-container fluid>
    <h1>Agregar observación</h1>

    <Form :pet_id="$route.params.petId"></Form>
  </v-container>
</template>

<script>
import Form from "../../components/pets/observation/Form";

export default {
  name: "ObservationForm",
  components: {Form},
}
</script>
