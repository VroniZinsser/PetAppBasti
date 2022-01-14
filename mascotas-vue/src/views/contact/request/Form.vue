<template>
  <Form :pets="pets"/>
</template>

<script>
import petServices from "../../../services/pets";
import Form from "../../../components/contacts/requests/create/Form";

export default {
  name: "Form",
  components: {Form},
  data: () => ({
    loading: false,
    pets: null,
  }),
  mounted() {
    petServices.getOwnerPets()
        .then(res => {
          if (res.success) {
            this.pets = res.data.pets;
            // this.loading = false; TODO Por alguna razon esto da un error que se envia la petición una y otra vez haciendo que falle el sistema
          }
        })
  }
}
</script>

<style scoped>

</style>
