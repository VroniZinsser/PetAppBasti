<template>
    <div>
        <div>
            <h2>Profesionales</h2>
        </div>
        <div>
            <ExploreListItem 
                v-for="professional in professionals" 
                :key="professional.id" 
                :professional="professional">
            </ExploreListItem>
        </div>
    </div>
    
</template>
<script>
import ExploreListItem from "@/components/geolocation/list/ExploreListItem";

export default {
    name: "ExploreList",
    props: {
        professionals: {
            type: Array,
            required: true,
        },
    },
    components: {
        ExploreListItem,
    },
}
</script>
