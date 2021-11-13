<template>
    <div class="medical-container weight">
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
