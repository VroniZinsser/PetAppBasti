<template>
  <v-container fluid>
    <h1>Agregar observación</h1>
    <Form
      :pets_id="$route.params.petsId"
    ></Form>
  </v-container>
</template>

<script>
import Form from "../../components/pets/observation/Form";
export default {
  name: "ObservationForm",
  components: { Form },
}
</script>