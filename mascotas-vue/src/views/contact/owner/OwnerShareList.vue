<template>
    <div>
        <TitleBar title="Mascotas compartidas"></TitleBar>
        <Loader v-if="loading"></Loader>
        <ul v-else class="owner-share-list">
            <li v-for="professional in professionals" :key="professional.id">
                <ShareListItem :professional="professional" />
            </li>
        </ul>
    </div>

</template>

<script>
import TitleBar from "@/components/general/layouts/TitleBar";
import Loader from "@/components/general/notifications/Loader";
import ShareListItem from "@/components/contact/owner/ShareListItem";
import contactService from "@/services/contact";

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

  }),
  mounted() {
      contactService.getOwnerSharedPets()
        .then(res => {
          this.professionals = res.data.professionals;
          this.loading = false;
        });
  },
}
</script>

<style scoped>

</style>
