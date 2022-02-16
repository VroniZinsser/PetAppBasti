<template>
  <ul>
    <ListItem v-for="weight in ReverseArray" :weight="weight" :key="weight.id" @deleted="deleted"></ListItem>
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
    ReverseArray() {
      let weights = this.weights
      return weights.reverse()
    }
  },
  methods: {
    deleted(weight_id) {
      this.$emit('deleted', weight_id);
    }
  },
  mounted() {
  }
}
</script>