<template>
  <v-text-field
      v-bind="$attrs"
      :type="type"
      :id="identifier"
      :name="identifier"
      :label="label"
      :value="value"
      :error="errors !== null"
      :messages="errors ? errors[0] : ''"
      :disabled="loading"
      outlined
      class="form-control"
      color="#3fb094"
      v-on="$listeners"
  />
</template>

<script>
export default {
  name: "InputText",
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

    type() {
      return this.$attrs.type ? this.$attrs.type : 'text'
    }
  },
}
</script>
