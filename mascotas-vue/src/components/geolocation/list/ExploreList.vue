<template>
    <div class="explore-list">
        

        <ul>
            <ExploreListItem 
                v-for="professional in professionals" 
                :key="professional.id" 
                :professional="professional"
                :isActive="professional.id === selectedProfessionalId">
            </ExploreListItem>
        </ul>
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
        userTypes: {
            type: Array,
            required: true,
        },
        selectedProfessionalId: {
            type: Number
        }
    },
    components: {
        ExploreListItem,
    },
}
</script>
