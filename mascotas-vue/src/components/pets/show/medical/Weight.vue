<template>
    <div class="medical-container weight">
        <div class="medical-container-header">
            <span>Peso actual: </span>
            <a href="#">Ver más</a>
        </div>
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
