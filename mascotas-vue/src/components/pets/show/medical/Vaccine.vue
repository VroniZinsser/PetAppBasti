<template>
    <div class="medical-container colored">
        <h2>Vacunas</h2>
    </div>
</template>
<script>

export default {
    name: "Vaccine",
    props: {
        vaccines: {
            type: Array,
            required: true
        }
    }
}
</script>
