<template>
    <div class="card medicine-item">
        <div class="medicine-item-info">
            <span class="card-title">{{professional.first_name}} {{professional.last_name}} </span>
            <span class="card-subtitle">({{professional.city}}, {{professional.street}} {{professional.house_number}})</span>
        </div>        
    </div>
</template>

<script>
export default {
    name: "ExploreListItem",
    props: {
        professional: {
            type: Object,
            required: true
        }
    },
}
</script>
