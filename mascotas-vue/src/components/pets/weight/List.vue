<template>
  <ul class="weight-list">
    <ListItem v-for="weight in sortedArray" :weight="weight" :key="weight.id" @delete="sendDelete"></ListItem>
  </ul>
</template>

<script>
import ListItem from "@/components/pets/weight/ListItem";

export default {
  name: "List",
  components: {ListItem},
  props: {
    weights: {
      type: Array,
      required: true,
    }
  },
  data() {
    return {}
  },
  computed: {
    sortedArray() {
      let weights = this.weights;

      return weights.sort((a, b) => (a.date < b.date) ? 1 : -1);
    }
  },
  methods: {
    sendDelete(weight_id) {
      this.$emit('delete', weight_id);
    }
  },
  mounted() {
  }
}
</script>