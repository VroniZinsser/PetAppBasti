<template>
  <div class="address">
    <span>{{ professional.street }} {{ professional.house_number }}</span>

    <span>{{ professional.postal_code }} {{ professional.district }} {{ professional.city }}</span>

    <span>{{ professional.state }}</span>
  </div>
</template>

<script>

export default {
  name: "ProfessionalProfileAddress",
  props: {
    professional: {
      type: Object,
      required: true,
    },
  }
}
</script>