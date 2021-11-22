<template>
    <div class="medical-container medicine">
        <h2>Medicamentos</h2>
        <NoData 
            v-if="medicines.length === 0"
            :img_src="noData.img_src"
            :text="noData.text"
            :cta_url="noData.cta.url"
            :cta_text="noData.cta.text">
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
import {createImgPath} from "@/helpers";
export default {
    name: "Medicine",
    props: {
        medicines: {
            type: Array,
            required: true,
        },
        petName: {
            type: String,
            required: true,
        }
    },
    components: {
        NoData,
        MedicineItem,
        MedicineItemMore
    },
    data() {
        return {
            noData: {
                img_src: createImgPath('ui/no_medicine.png'),
                text: `Agregá medicamentos actuales o del pasado para el registro de medicación de ${this.petName}.`,
                cta: {
                    url: '#',
                    text: 'Agregar medicamento'
                }
            }
        }
    }
}
</script>
