<template>
  <FormContainer
    headline="Agregá una nueva vacuna"
    form_class="form-vaccine"
    :is_short_form="true"
  >
    <p>No olvides de anotar el nombre exacto de la vacuna para poder reconocerla después.</p>
    <Form
        :pet_id="$route.params.pet_id"
    ></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/vaccine/Form";
import FormContainer from "../../components/general/forms/FormContainer";

export default {
  name: "VaccineForm",
  components: {
    Form,
    FormContainer
  },
}
</script>
