<template>
    <div>
        <span>{{vaccine.name}}</span>
        <span>{{vaccine.date}}</span>
    </div>
    
</template>
<script>

export default {
    name: "VaccineItem",
    props: {
        vaccine: {
            type: Object,
            required: true
        }
    },
}
</script>
