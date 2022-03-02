<template>
  <div class="no-data">
    <img :src="img_src" :alt="cta_text">

    <p>{{ replacePetName(text, pet_name) }}</p>

    <router-link :to="{name: this.path_name, params: { pet_id: this.pet_id }}">{{ cta_text }}</router-link>
  </div>
</template>
<script>

export default {
  name: "PetDetailMedicalPlaceholder",
  props: {
    img_src: {
      type: String,
      required: true,
    },
    text: {
      type: String,
      required: true,
    },
    path_name: {
      type: String,
      required: true,
    },
    pet_id: {
      type: Number,
      required: true,
    },
    cta_text: {
      type: String,
      required: true,
    },
    pet_name: {
      type: String,
      required: true,
    }
  },

  methods: {
    replacePetName(text, petName) {
      return text.replace(':petName', petName);
    }
  }
}
</script>
