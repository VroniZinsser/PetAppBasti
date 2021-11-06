<template>
  <v-container fluid>
    <h1>Agregar peso</h1>
    <Form
      :pets_id="$route.params.petsId"
    ></Form>
  </v-container>
</template>

<script>
import Form from "../../components/pets/weight/Form";

export default {
  name: "WeightForm",
  components: { Form },
}
</script>