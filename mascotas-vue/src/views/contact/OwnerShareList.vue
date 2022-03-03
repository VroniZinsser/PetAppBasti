<template>
  <div>
    <TitleBar title="Mascotas compartidas"/>

    <Loader v-if="loading"/>

    <div v-else class="owner-share-list">
      <div class="intro">
        <p v-if="professionals.length > 0">Aquí aparecen los profesionales que actualmente pueden ver tus mascotas:</p>

        <p v-else>Actualmente ningún profesional puede ver tus mascotas.</p>
      </div>

      <ul v-if="professionals.length > 0">
        <li v-for="professional in professionals" :key="professional.id">
          <OwnerSignUpForm
              :professional="professional"
              @delete-request="deleteRequest"
          />
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import contactService from "@/services/contact";
import Loader from "@/components/general/layout/TheLoader";
import OwnerSignUpForm from "@/components/contact/list/OwnerShareListItem";
import TitleBar from "@/components/general/layout/TitleBar";
import {handleAccessError} from "@/helpers";

export default {
  name: "OwnerShareList",
  components: {
    TitleBar,
    Loader,
    OwnerSignUpForm,
  },
  data: () => ({
    loading: true,
    professionals: null,
    handleAccessError,
  }),
  mounted() {
    this.getSharedPets();
  },
  methods: {
    deleteRequest(id) {
      contactService.delete(id)
          .then(res => {
            if (this.handleAccessError(res)) return;
          });

      this.getSharedPets();
    },

    getSharedPets() {
      this.loading = true;
      contactService.getOwnerSharedPets()
          .then(res => {
            if (this.handleAccessError(res)) return;

            this.professionals = res.data.professionals;

            this.loading = false;
          });
    }
  }
}
</script>
