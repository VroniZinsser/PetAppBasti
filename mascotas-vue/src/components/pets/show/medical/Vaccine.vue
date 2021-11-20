<template>
    <div class="medical-container vaccine">
        <div class="medical-container-header">
            <h2>Vacunas</h2>
            <a href="#">Ver más</a>
        </div>
        <div class="medical-container-body">
            <VaccineItem 
                v-for="vaccine in vaccines" 
                :key="vaccine.id" 
                :vaccine="vaccine">
            </VaccineItem>
        </div>
    </div>
</template>
<script>

import VaccineItem from "@/components/pets/show/medical/VaccineItem";
export default {
    name: "Vaccine",
    props: {
        vaccines: {
            type: Array,
            required: true
        }
    },
    components: {
        VaccineItem
    },
}
</script>
