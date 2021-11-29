<template>
  <router-link :to="{name: this.pathName}">
    <span class="text">{{ this.linkText }}</span>
    <div :class="getClass()">
      <span class="material-icons">{{ this.icon ? this.icon : 'add' }}</span>
    </div>
  </router-link>
</template>

<script>
export default {
  name: "CircleButtonLink",
  props: {
    pathName: {
      required: true,
      type: String
    },
    linkText: {
      required: true,
      type: String
    },
    icon: {
      required: true,
      type: String
    },
    default: {
      type: Boolean
    }
  },
  methods: {
    /**
     * Adds classes to the original text according to the value of the parameters passed to it and returns the text.
     *
     * @returns {string}
     */
    getClass() {
      let content = "float-circle-btn link";

      if (this.default) {
        content += " default";
      }

      return content
    }
  }
}
</script>

<style scoped>

</style>
