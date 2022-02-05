<template>
    <div>
        <TitleBar title="Mascotas compartidas"></TitleBar>
        <Loader v-if="loading"></Loader>
    </div>

</template>

<script>
import TitleBar from "@/components/general/layouts/TitleBar";
import Loader from "@/components/general/notifications/Loader";
import contactService from "@/services/contact";

export default {
  name: "OwnerShareList",
  components: {
    TitleBar,
    Loader,
  },
  data: () => ({
    loading: true,
    sharedPets: null,

  }),
  mounted() {
      contactService.getOwnerSharedPets()
        .then(res => {
          this.sharedPets = res.data.sharedPets;
          this.loading = false;
        });
  }
}
</script>

<style scoped>

</style>
