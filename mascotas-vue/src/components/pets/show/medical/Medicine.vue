<template>
    <div class="medical-container colored">
        <h2>Medicamentos</h2>
    </div>
    
</template>
<script>

export default {
    name: "Medicine",
    props: {
        medicines: {
            type: Array,
            required: true
        }
    }
}
</script>
