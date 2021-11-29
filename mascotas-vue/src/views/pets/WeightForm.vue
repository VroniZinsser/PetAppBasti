<template>
  <v-container fluid>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />
    <h1>Agregar peso</h1>

    <Form
        :pet_id="$route.params.pet_id"
    ></Form>
  </v-container>
</template>

<script>
import Form from "../../components/pets/weight/Form";
import BaseNotification from "@/components/general/notifications/BaseNotification";
import store from "@/store";

export default {
  name: "WeightForm",
  components: {
    Form,
    BaseNotification,
  },
  data: () => ({
    store,
  })
}
</script>
