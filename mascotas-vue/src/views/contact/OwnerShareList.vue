<template>
    <div>
        <TitleBar title="Mascotas compartidas"></TitleBar>
        <Loader v-if="loading"></Loader>
        <div v-else class="owner-share-list">
            <div class="intro">
                <p v-if="professionals.length > 0">Aquí aparecen los profesionales que actualmente pueden ver tus mascotas:</p>
                <p v-else>Actualmente ningún profesional puede ver tus mascotas.</p>
            </div>
            <ul v-if="professionals.length > 0">
                <li v-for="professional in professionals" :key="professional.id">
                    <ShareListItem 
                      :professional="professional"
                      @delete-request="deleteRequest"
                    />
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
import TitleBar from "@/components/general/layout/TitleBar";
import Loader from "@/components/general/layout/TheLoader";
import ShareListItem from "@/components/contact/list/OwnerShareListItem";
import contactService from "@/services/contact";
import { handleAccessError } from "@/helpers";

export default {
  name: "OwnerShareList",
  components: {
    TitleBar,
    Loader,
    ShareListItem,
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

<style scoped>

</style>
