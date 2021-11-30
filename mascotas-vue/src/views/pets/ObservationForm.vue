<template>
  <FormContainer
    headline="¿Hay algo que te llamó la atención?"
    form_class="form-observation"
    :is_short_form="true"
  >
    <p>Tu espacio libre para anotar observaciones acerca del comportamiento o la salud de tu mascota.</p>
    <Form
        :pet_id="$route.params.pet_id"
    ></Form>
  </FormContainer>
</template>

<script>
import Form from "../../components/pets/observation/Form";
import FormContainer from "../../components/general/forms/FormContainer";

export default {
  name: "ObservationForm",
  components: {
    Form,
    FormContainer
  },
}
</script>
