<template>
  <button class="float-circle-btn" @click="$emit('active')">
    <span class="material-icons">{{ iconText }}</span>

    <span class="sr-only">{{buttonText}}</span>
  </button>
</template>

<script>
export default {
  name: "BaseButtonCircle",
  props: {
    icon: {
      type: String
    },
    text: {
      type: String
    }
  },
  computed: {
    iconText(){
      return this.icon ? this.icon : 'add';
    },

    buttonText(){
      return  this.text ? this.text : 'Agregar (Abre listado de enlaces)'
    },
  },
}
</script>
