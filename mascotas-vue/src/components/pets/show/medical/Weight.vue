<template>
    <div class="medical-container">
        <span>Peso actual: </span>
    </div>
</template>
<script>

export default {
    name: "Weight",
    props: {
        weights: {
            type: Array,
            required: true
        }
    }
}
</script>
