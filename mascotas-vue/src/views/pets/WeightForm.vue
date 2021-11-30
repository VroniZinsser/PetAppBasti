<template>
  <v-container fluid class="short-form-container">  
    <div class="form-heading">
      <h1>¿Cuánto pesa tu mascota?</h1>
    </div>
    <BaseNotification
        v-if="store.status.msg != null"
        :type="store.status.type"
        :text="store.status.msg"
        :title="store.status.title"
    />
    <p>Si pesás a tu mascota regularmente será mucho más fácil llevar un control sobre su dieta.</p>

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
