<template>
    <v-dialog v-model="showDialog" max-width="500">
      <v-card>
        <v-card-title>
            {{ dialogTitle }}
        </v-card-title>

        <v-card-text>
            <p>{{ dialogText }}</p>
        </v-card-text>

        <v-divider />

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
              @click="$emit('cancle')"
          >
            {{ cancleButtonText }}
          </v-btn>

          <v-btn
              @click="$emit('accept')"
          >
            {{ acceptButtonText }}
          </v-btn>

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
    cancleButtonText: {
        type: String,
        default: 'Cancelar'
    }
  }
}
</script>