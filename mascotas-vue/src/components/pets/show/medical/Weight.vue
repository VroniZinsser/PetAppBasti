<template>
    <div class="medical-container weight">
        <div class="medical-container-header">
            <span>Peso actual: </span>
            <a v-if="weights.length > 0" href="#">Ver más</a>
        </div>
        <Placeholder 
            v-if="weights.length === 0"
            :img_src="placeholder.img_src"
            :text="placeholder.text"
            :cta_url="placeholder.cta.url"
            :cta_text="placeholder.cta.text"
            :pet_name="pet_name">
        </Placeholder>
        <div v-else class="medical-container-body">
            <ul>
                <li v-for="weight in weights" :key="weight.id">{{weight.weight}}</li>
            </ul>
        </div>
    </div>
</template>
<script>
import Placeholder from "@/components/pets/show/medical/Placeholder";
export default {
    name: "Weight",
    props: {
        weights: {
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
        }
    },
    components: {
        Placeholder,
    },
}
</script>
