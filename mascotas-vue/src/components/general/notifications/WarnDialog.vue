<template>
    <v-dialog v-model="showDialog" max-width="500">
      <v-card class="warn-dialog">
        <v-card-title>
            {{ dialogTitle }}
        </v-card-title>

        <v-card-text>
            <p>{{ dialogText }}</p>
        </v-card-text>

        <v-card-actions>
            <button
              class="accept"
              @click="$emit('accept')"
            >
            {{ acceptButtonText }}
          </button>
          <button
              class="cancle"
              @click="$emit('cancle')"
          >
            {{ cancleButtonText }}
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
    cancleButtonText: {
        type: String,
        default: 'Cancelar'
    }
  }
}
</script>