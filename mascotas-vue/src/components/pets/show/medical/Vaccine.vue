<template>
    <div class="medical-container vaccine">
        <div class="medical-container-header">
            <h2>Vacunas</h2>
            <a v-if="vaccines.length > 0" href="#">Ver más</a>
        </div>
        <NoData 
            v-if="vaccines.length === 0"
            :img_src="placeholder.img_src"
            :text="placeholder.text"
            :cta_url="placeholder.cta.url"
            :cta_text="placeholder.cta.text"
            :pet_name="pet_name">
        </NoData>
        <div v-else class="medical-container-body">
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
import NoData from "@/components/pets/show/medical/NoData";
export default {
    name: "Vaccine",
    props: {
        vaccines: {
            type: Array,
            required: true
        },
        placeholder: {
            type: Object,
            required: true,
        },
        pet_name: {
            type: String,
            required: true,
        },
    },
    components: {
        NoData,
        VaccineItem
    },
}
</script>
