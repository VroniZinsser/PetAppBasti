<template>
    <div class="medical-container medicine">
        <h2>Medicamentos</h2>
        <div class="medical-container-body">
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
import MedicineItem from "@/components/pets/show/medical/MedicineItem";
import MedicineItemMore from "@/components/pets/show/medical/MedicineItemMore";
export default {
    name: "Medicine",
    props: {
        medicines: {
            type: Array,
            required: true
        }
    },
    components: {
        MedicineItem,
        MedicineItemMore
    },
}
</script>
