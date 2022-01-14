<template>
  <v-list>
    <ListItem
        v-for="r in sharedPets"
        :key="r.id"
        :request="r"
        @request-update="requestUpdate"
    ></ListItem>
  </v-list>
</template>

<script>
import ListItem from "./ListItem";

export default {
  name: "List",
  components: {ListItem},
  props: {
    sharedPets: {
      required: true,
      type: Array,
    }
  },
  methods: {
    requestUpdate(request){
      this.$emit("request-update", request);
    }
  }
}
</script>
