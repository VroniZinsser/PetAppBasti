<template>
    <div class="title-bar">
        <h1>{{ title }}</h1>
    </div>   
</template>
<script>
export default {
  name: "TitleBar",
  props: {
    title: {
      type: String,
      required: true
    },
  }, 
}
</script>
