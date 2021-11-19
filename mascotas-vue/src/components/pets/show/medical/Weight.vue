<template>
    <div class="medical-container weight">
        <div class="medical-container-header">
            <span>Peso actual: </span>
            <a href="#">Ver más</a>
        </div>
        <div class="medical-container-body">
            <ul>
                <li v-for="weight in weights" :key="weight.id">{{weight.weight}}</li>
            </ul>
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
