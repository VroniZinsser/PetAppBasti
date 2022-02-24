<template>
    <v-dialog v-model="showDialog" max-width="500" @click:outside="$emit('cancel')">
      <v-card class="warn-dialog">
        <v-card-title v-if="dialogTitle">
            {{ dialogTitle }}
        </v-card-title>

        <v-card-text v-if="dialogText">
            <p>{{ dialogText }}</p>
        </v-card-text>

        <v-card-actions>
            <button
              class="accept mb-0"
              @click="$emit('accept')"
            >
            {{ acceptButtonText }}
          </button>
          <button
              class="cancel"
              @click="$emit('cancel')"
          >
            {{ cancelButtonText }}
          </button>

          

          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script>

export default {
  name: "WarnDialog",
  props: {
    showDialog: {
        type: Boolean,
        default: false,
    },
    dialogTitle: {
        type: String,
        required: true,
    },
    dialogText: {
        type: String,
    },
    acceptButtonText: {
        type: String,
        default: 'Aceptar'
    },
    cancelButtonText: {
        type: String,
        default: 'Cancelar'
    }
  }
}
</script>