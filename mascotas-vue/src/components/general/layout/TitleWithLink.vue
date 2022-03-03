<template>
  <div class="justify-center d-flex flex-column align-center">
    <p class="title">{{ title }}</p>

    <p>
      <router-link :to="{name: RouteName}">{{ linkText }}</router-link>
    </p>
  </div>
</template>

<script>
export default {
  name: "TitleWithLink",
  props: {
    title: {
      type: String,
      required: true,
    },
    linkText: {
      type: String,
      required: true,
    },
    RouteName: {
      type: String,
      required: true,
    },
  }
}
</script>