<template>
  <div>
    <CircleButton v-on:active="links = true"></CircleButton>

    <v-dialog v-model="links" class="container--fluid">
      <ul class="floating-links-list">
        <li v-for="data in buttonLinkData" :key="data.pathName">
          <CircleButtonLink
              :icon="data.icon"
              :link-text="data.text"
              :path-name="data.pathName"
              :path-params="data.pathParams"
              :default="data.default"></CircleButtonLink>
        </li>
      </ul>
    </v-dialog>
  </div>
</template>

<script>
import CircleButton from "./BaseButtonCircle";
import CircleButtonLink from "./BaseButtonCircleLink";

export default {
  name: "CircleButtonLinkList",
  components: {CircleButtonLink, CircleButton},
  props: {
    buttonLinkData: {
      type: Array,
      required: true,
    }
  },
  data: () => ({
    links: false
  })
}
</script>
