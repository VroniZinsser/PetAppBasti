<template>
  <v-menu
      ref="datePicker"
      v-model="datePicker"
      :close-on-content-click="false"
      transition="scale-transition"
      offset-y
  >
    <template v-slot:activator="{ on }">
      <v-text-field
          outlined
          v-model="dateFormatted"
          prepend-inner-icon="mdi-calendar"
          v-bind="$attrs"
          v-on="on"
          :id="identifier"
          :name="identifier"
          @blur="date = parseDate(dateFormatted)"
          :error="errors !== null"
          :messages="errors ? errors[0] : ''"
          :disabled="loading"
          color="#3fb094"
      />
    </template>

    <v-date-picker
        v-model="date"
        v-bind="$attrs"
        no-title
        locale="es-AR"
        @input="datePicker = false"
        :max="maxDate"
        :min="minDate"
        :disabled="loading"
    />
  </v-menu>
</template>

<script>
import {formatDate} from "@/helpers";

export default {
  name: "InputDate",
  props: {
    identifier: {
      type: String,
    },
    errors: {
      default: null
    },
    loading: {
      type: Boolean,
      default: false
    },
    initialDate: {
      type: String
    },
    maxDate: {
      type: String
    },
    minDate: {
      type: String
    }
  },
  data: function () {
    return {
      dateFormatted: formatDate(this.initialDate),
      datePicker: false,
      date: this.initialDate
    }
  },
  watch: {
    date() {
      this.dateFormatted = formatDate(this.date)

      this.$emit('update-date', this.date)
    },
  },
  methods: {
    parseDate(date) {
      if (!date) return null

      const [day, month, year] = date.split('/')

      if (!month || !day || !year) return null;

      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    },
  },
}
</script>
