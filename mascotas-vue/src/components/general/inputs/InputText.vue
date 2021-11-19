<template>
  <v-text-field
      class="form-control"
      v-bind="$attrs"
      v-on="$listeners"
      :type="$attrs.type ? $attrs.type : 'text'"
      :id="identifier"
      :name="identifier"
      :label="$attrs.label + ($attrs.required === '' ? ' *' : '')"
      :value="value"
      :error="errors !== null"
      :messages="errors ? errors[0] : ''"
      :disabled="loading"
  ></v-text-field>

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
}
</script>
