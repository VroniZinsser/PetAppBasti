<template>
  <v-dialog v-model="showDialog" max-width="500" @click:outside="$emit('cancel')">
    <v-card class="settings-dialog basti-dialog">
      <v-card-title>
        <SettingsDialogHeader
            :user="user"
            @close="$emit('cancel')"
        />
      </v-card-title>

      <v-list nav>
        <v-list-item-group>
          <SettingsDialogItem
              v-if="user.is_professional"
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
              icon="mdi-lock-reset"
              text="Cambiar Contraseña"
              @onclick="changePassword"
          />

          <SettingsDialogItem
              icon="mdi-logout"
              text="Cerrar Sesión"
              @onclick="$emit('logout')"
          />
        </v-list-item-group>
      </v-list>
    </v-card>
  </v-dialog>
</template>

<script>
import SettingsDialogHeader from "@/components/general/layout/setting/SettingsDialogHeader";
import SettingsDialogItem from "@/components/general/layout/setting/SettingsDialogItem";

export default {
  name: "SettingsDialog",
  components: {
    SettingsDialogHeader,
    SettingsDialogItem
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
      if (!(this.$route.name === 'ProfessionalProfile' && this.$route.params.professional_id === this.user.id)) {
        this.$router.push({
          name: 'ProfessionalProfile',
          params: {'professional_id': this.user.id}
        });
      }

      this.$emit('cancel')
    },

    editProfile() {
      const routeName = this.user.is_professional ? 'ProfessionalEdit' : 'OwnerEdit'

      this.redirectAndClose(routeName);
    },

    changePassword() {
      this.redirectAndClose('ChangePasswordAuthenticated');
    },

    redirectAndClose(routeName) {
      if (this.$route.name !== routeName) {
        this.$router.push({
          name: routeName,
        });
      }

      this.$emit('cancel')
    }
  }
}
</script>