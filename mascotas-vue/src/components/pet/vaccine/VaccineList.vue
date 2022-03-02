<template>
  <ul class="medical-list">
    <ListItem
        v-for="vaccine in sortedArray"
        :key="vaccine.id"
        :vaccine="vaccine"
        @delete="sendDelete"></ListItem>
  </ul>
</template>

<script>
import ListItem from "@/components/pet/vaccine/VaccineListItem";

export default {
  name: "List",
  components: {ListItem},
  props: {
    vaccines: {
      type: Array,
      required: true,
    }
  },
  data() {
    return {}
  },
  computed:{
    sortedArray() {
      let vaccines = this.vaccines;

      return vaccines.sort((a, b) => (a.date < b.date) ? 1 : -1);
    }
  },
  methods: {
    sendDelete(vaccine_id) {
      this.$emit('delete', vaccine_id);
    }
  },
  mounted() {
  }
}
</script>