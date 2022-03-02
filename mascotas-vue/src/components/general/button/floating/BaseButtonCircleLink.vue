<template>
  <router-link
      :to="buttonRoute">
    <span class="text">{{ this.linkText }}</span>

    <div :class="getClass()">
      <span class="material-icons">{{ buttonIcon }}</span>
    </div>
  </router-link>
</template>

<script>
export default {
  name: "BaseButtonCircleLink",
  props: {
    pathName: {
      required: true,
      type: String
    },
    pathParams: {
      required: true,
      type: Object
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
  computed: {
    buttonRoute(){
      return Object.keys(this.pathParams).length === 0 ? {name: this.pathName} : {name: this.pathName, params: this.pathParams}
    },

    buttonIcon(){
      return this.icon ? this.icon : 'add';
    },
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