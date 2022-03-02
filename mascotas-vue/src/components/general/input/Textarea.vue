<template>
  <v-textarea
      v-bind="$attrs"
      :id="identifier"
      :name="identifier"
      :label="label"
      :value="value"
      :error="errors !== null"
      :messages="errors ? errors[0] : ''"
      :disabled="loading"
      class="form-control"
      color="#3fb094"
      outlined
      v-on="$listeners"
  />
</template>

<script>
export default {
  name: "Textarea",
  props: {
    value: {},
    identifier: {
      type: String,
    },
    errors: {
      default: null
    },
    loading: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    label() {
      return this.$attrs.label + (this.$attrs.required === '' ? ' *' : '')
    },
  },
}
</script>
