<template>
    <div class="medical-container observation">
        <div class="medical-container-header">
            <h2>Observaciones</h2>
            <a href="#">Ver más</a>
        </div>
        <div class="medical-container-body">
            <p>{{observation}}</p>
        </div>
    </div>
</template>
<script>

export default {
    name: "Observation",
    props: {
        observation: {
            type: String,
        }
    }
}
</script>
