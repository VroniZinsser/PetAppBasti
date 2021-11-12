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
            v-model="dateFormatted"
            prepend-icon="mdi-calendar"
            v-bind="$attrs"
            v-on="on"
            :id="identifier"
            :name="identifier"
            @blur="date = parseDate(dateFormatted)"
            :error="errors !== null"
            :messages="errors ? errors[0] : ''"
            :disabled="loading"
            ></v-text-field>
        </template>
        <v-date-picker
            v-model="date"
            v-bind="$attrs"
            no-title
            locale="es-AR"
            @input="datePicker = false"
            :max="maxDate"
            :disabled="loading"
        ></v-date-picker>
    </v-menu>
</template>

<script>
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
        }
    },
    
    data: function() {
        return {
            dateFormatted: this.formatDate(this.initialDate),
            datePicker: false,
            date: this.initialDate
        }
    },

    methods: {
        
        
        formatDate (date) {
            if (!date) return null

            const [year, month, day] = date.split('-')
            return `${day}/${month}/${year}`
        },
        
        parseDate (date) {
            if (!date) return null

            const [day, month, year] = date.split('/')
            if (!month || !day || !year) return null;
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
        },
    },
    watch: {
    date () {
      this.dateFormatted = this.formatDate(this.date)
      this.$emit('update-date', this.date)
    },
  },
}
</script>
