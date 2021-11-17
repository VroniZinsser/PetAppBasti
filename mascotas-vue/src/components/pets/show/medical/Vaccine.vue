<template>
    <div class="medical-container vaccine">
        <div class="medical-container-header">
            <h2>Vacunas</h2>
            <a href="#">Ver más</a>
        </div>
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
