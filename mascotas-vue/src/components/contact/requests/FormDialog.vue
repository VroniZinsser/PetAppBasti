<template>
    <v-dialog :value="dialogOpen" max-width="500" @click:outside="$emit('closeDialog')">
      <v-card>
        <v-card-title class="grey lighten-2">
          Compartir tu mascota
        </v-card-title>

        <Form
            v-if="pets.length > 0"
            :pets="pets"
            :professionalName="professionalName"
            :professionalId="professionalId"
            v-on:request-created="createShareLink"
        />

        <v-card-text v-else class="pt-4 text-center">Necesitas tener como mínimo una mascota registrada</v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
              color="red"
              text
              @click="$emit('closeDialog')"
          >
            {{ pets ? 'Cancelar' : 'Cerrar' }}
          </v-btn>

          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>

<script>
import Form from "@/components/contact/requests/Form";
import petServices from "@/services/pets";


export default {
  name: "FormDialog",
  components: {
    Form,
  },
  props: {
    dialogOpen: {
        type: Boolean,
        default: false,
    },
    professionalName: {
        type: String,
        required: true,
    },
    professionalId: {
        type: Number,
        required: true,
    }
  },
  data() {
      return {
        pets: [],
        notification: {
        text: null,
        type: 'success',
        },
        requestLink: null,
        
    }
  },
    mounted() {
        petServices.getOwnerPets()
        .then(res => {
            if (res.success) {
                this.pets = res.data.pets;
            }
        })
    }
}
</script>