<template>
  <v-container fluid>
    <h1>Agregar vacuna</h1>
    <Form
      :pets_id="$route.params.petsId"
    ></Form>
  </v-container>
</template>

<script>
import Form from "../../components/pets/vaccine/Form";
export default {
  name: "VaccineForm",
  components: { Form },
}
</script> 