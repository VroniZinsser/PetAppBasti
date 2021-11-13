<template>
    <div class="medical-container vaccine">
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
