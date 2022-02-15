<template>
    <v-dialog v-model="showDialog" max-width="500" @click:outside="$emit('cancle')">
      <v-card class="settings-dialog basti-dialog">
        <v-card-title>
            <SettingsDialogHeader 
                :user="user"
                @close="$emit('cancle')"
            />
        </v-card-title>
        <v-list nav>
            <v-list-item-group>
                <SettingsDialogItem 
                    icon="mdi-account"
                    text="Ver Perfil"
                    @onclick="viewProfile"
                />
                <SettingsDialogItem 
                    icon="mdi-pencil"
                    text="Editar Perfil"
                    @onclick="editProfile"
                />
                <SettingsDialogItem 
                    icon="mdi-logout"
                    text="Cerrar Sesión"
                    @onclick="$emit('logout')"
                />
                <v-divider />
                <SettingsDialogItem 
                    icon="mdi-delete"
                    text="Eliminar mi cuenta"
                    class="danger"
                    @onclick="$emit('delete-account')"
                />
            </v-list-item-group>
        </v-list>
      </v-card>
    </v-dialog>
    
</template>

<script>
import SettingsDialogItem from "@/components/users/settings/SettingsDialogItem";
import SettingsDialogHeader from "@/components/users/settings/SettingsDialogHeader";

export default {
  name: "SettingsDialog",
  components: {
      SettingsDialogItem,
      SettingsDialogHeader
  },
  props: {
      showDialog: {
          type: Boolean,
          default: false,
      },
      user: {
          type: Object,
          required: true,
      }
  },
  methods: {
      viewProfile() {
        if (!(this.$route.name == 'ProfessionalProfile' && this.$route.params.professional_id == this.user.id)) {
            this.$router.push({
                name: 'ProfessionalProfile',
                params: { 'professional_id': this.user.id } 
            });
        }
        this.$emit('cancle')
      },

      editProfile() {
        if (this.$route.name !== 'ProfessionalEdit') {
            this.$router.push({
                name: 'ProfessionalEdit',
            });
        }
        this.$emit('cancle')
      }
  }
}

</script>