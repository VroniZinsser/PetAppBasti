<template>
    <div class="medical-container medicine">
        <h2>Medicamentos</h2>
        <NoData 
            v-if="medicines.length === 0"
            :img_src="placeholder.img_src"
            :text="placeholder.text"
            :cta_url="placeholder.cta.url"
            :cta_text="placeholder.cta.text"
            :pet_name="pet_name">
        </NoData>
        <div v-else class="medical-container-body">
            <MedicineItem 
                v-for="medicine in medicines" 
                :key="medicine.id" 
                :medicine="medicine">
            </MedicineItem>
            <MedicineItemMore :quantity="medicines.length"></MedicineItemMore>
        </div>
    </div>
    
</template>
<script>
import NoData from "@/components/pets/show/medical/NoData";
import MedicineItem from "@/components/pets/show/medical/MedicineItem";
import MedicineItemMore from "@/components/pets/show/medical/MedicineItemMore";
export default {
    name: "Medicine",
    props: {
        medicines: {
            type: Array,
            required: true,
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
        MedicineItem,
        MedicineItemMore
    },
}
</script>
