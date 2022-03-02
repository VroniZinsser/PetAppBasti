<template>
  <li v-if="contactData">
    <a :href="link" target="_blank">
      <img :src="createStaticImgPath(imgPath)" :alt="alt">
      <span>{{ contactData }}</span>
    </a>
  </li>
</template>
<script>
import {createStaticImgPath} from "@/helpers";

export default {
  name: "ProfessionalProfileContactItem",
  props: {
    contactData: {
      type: String,
    },
    link: {
      type: String,
    },
    imgPath: {
      type: String,
    },
    alt: {
      type: String,
    }
  },
  data() {
    return {
      createStaticImgPath,
    }
  }
}
</script>
