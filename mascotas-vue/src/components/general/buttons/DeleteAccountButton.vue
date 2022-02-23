<template>
    <div>
        <v-btn
            :loading="loading"
            :disabled="loading"
            class="button-delete-account"
            text
            @click="showWarnDialog = true"
        >
            <v-icon
                left
                >
                mdi-delete
            </v-icon>
            Eliminar mi cuenta
        </v-btn>
        <WarnDialog
            :showDialog="showWarnDialog" 
            dialogTitle="¿Eliminar tu cuenta de usuario?"
            :dialogText="is_professional ? dialogTextProfessional : dialogTextOwner"
            acceptButtonText="Sí, eliminar mi cuenta"

            @cancel="showWarnDialog = false"
            @accept="deleteAccount"
        />
    </div>
</template>

<script>
import WarnDialog from "@/components/general/notifications/WarnDialog";
import authService from "@/services/auth";
import userService from "@/services/users";
import store from "@/store";


export default {
  name: "DeleteAccountButton",

    data() {
        return {
            showWarnDialog: false,
            store,
            dialogTextProfessional: "¿Estás seguro que ya no querés ser parte de Basti? Si eliminás tu cuenta, tu perfil ya no estará disponible y no aparecerá en el mapa. No tendrás más acceso a las mascotas compartidas con vos.",
            dialogTextOwner: "¿Estás seguro que ya no querés ser parte de Basti? Si eliminás tu cuenta, no podrás acceder más a nuestro mapa. Las mascotas que agregaste a tu cuenta se eliminarán del sistema."
        }   
    },

    components: {
        WarnDialog,
    },

    props: {
        loading: {
            type: Boolean,
            default: false,
        },
        is_professional: {
            type: Boolean,
            default: false,
        }
    },
    
    methods: {
        deleteAccount() {
            this.showWarnDialog = false;
            this.$router.push({name: 'Login'});
            const id = this.store.user.id;
            authService.removeAuthUser();
            userService.delete(id)
                .then(res => {
                if (res.success) {
                    this.$router.push({name: 'Login'});
                } else {
                    this.store.setStatus({
                    msg: 'Algo salió mal. Intentalo nuevamente más tarde.',
                    type: 'error',
                    });
                }
            })
        }
    }
    
}
</script>
