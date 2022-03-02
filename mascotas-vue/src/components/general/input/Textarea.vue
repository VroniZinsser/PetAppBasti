<template>
  <v-textarea
      outlined
      class="form-control"
      v-bind="$attrs"
      v-on="$listeners"
      :id="identifier"
      :name="identifier"
      :label="$attrs.label + ($attrs.required === '' ? ' *' : '')"
      :value="value"
      :error="errors !== null"
      :messages="errors ? errors[0] : ''"
      :disabled="loading"
      color="#3fb094"
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
}
</script>
