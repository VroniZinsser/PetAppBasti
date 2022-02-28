<template>
  <div class="pet-profile">
    <div class="pet-profile-header">
      <h2>Perfil</h2>

      <Dropdown @deletePet="showWarnDialog = true" />
    </div>

    <div class="pet-profile-body">
      <ul>
        <li>
          <span>Nombre:</span>
          <span>{{ pet.name }}</span>
        </li>
        <li>
          <span>Especie:</span>
          <span>{{ pet.species.name }}</span>
        </li>
        <li v-if="pet.breed">
          <span>Raza:</span>
          <span>{{ pet.breed }}</span>
        </li>
        <li>
          <span>Castrado:</span>
          <span>{{ pet.neutered ? 'Sí' : 'No' }}</span>
        </li>
        <li>
          <span>Sexo:</span>
          <span>{{ pet.sex.name }}</span>
        </li>
        <li v-if="pet.date_of_birth">
          <span>Fecha de nacimiento:</span>
          <span>{{ formatted_date_of_birth }}</span>
        </li>
        <li v-if="pet.temperament" class="wide-content">
          <span>Temperamento:</span>
          <span>{{ pet.temperament }}</span>
        </li>
      </ul>
    </div>

    <div class="pet-profile-footer">
      <router-link :to="{name: 'PetEditForm', params: {'pet_id': this.pet.id}}" class="main-btn">
        Editar perfil
      </router-link>
    </div>
    <WarnDialog
      :showDialog="showWarnDialog" 
      :dialogTitle="`¿Querés borrar el perfil de ${pet.name}?`"
      dialogText="Se eliminarán todos los datos relacionados a tu mascota."
      acceptButtonText="Borrar perfil"

      @cancel="showWarnDialog = false"
      @accept="deletePet()"
    />
  </div>
</template>

<script>
import {formatDate} from "../../../helpers";
import Dropdown from "../../general/buttons/Dropdown";
import petServices from "../../../services/pets";
import store from "../../../store";
import WarnDialog from "@/components/general/notifications/WarnDialog";
import { handleAccessError } from "@/helpers";

export default {
  name: "PetProfile",
  components: {
    Dropdown,
    WarnDialog,  
  },
  props: {
    pet: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      store,
      handleAccessError,
      showWarnDialog: false,
    }
  },
  methods: {
    deletePet() {
      petServices.deletePet(this.pet.id)
          .then(res => {
            if (!res.success) {
              if (this.handleAccessError(res)) return;
              this.store.setStatus({
                msg: 'Algo salió mal. No se pudo eliminar la mascota.',
                type: 'error',
              });
            } else {
              this.store.setStatus({
                msg: 'Mascota eliminada con éxito',
                type: 'success',
              });
              this.store.setActivePet(null);
            }

            this.$emit('deleted');
          })
    }
  },
  computed: {
    formatted_date_of_birth() { 
      return formatDate(this.pet.date_of_birth);
    }
  }
}
</script>
