<template>
    <div>
        <TitleBar title="Mascotas compartidas"></TitleBar>
        <Loader v-if="loading"></Loader>
    </div>

</template>

<script>
import TitleBar from "@/components/general/layouts/TitleBar";
import Loader from "@/components/general/notifications/Loader";

export default {
  name: "OwnerShareList",
  components: {
    TitleBar,
    Loader,
  },
  data: () => ({
    loading: true,
 
  }),
  mounted() {
  }
}
</script>

<style scoped>

</style>
