<template>
    <div class="medical-container observation">
        <div class="medical-container-header">
            <h2>Observaciones</h2>
            <a v-if="observation" href="#">Ver más</a>
        </div>
        <Placeholder 
            v-if="!observation"
            :img_src="placeholder.img_src"
            :text="placeholder.text"
            :cta_url="placeholder.cta.url"
            :cta_text="placeholder.cta.text"
            :pet_name="pet_name">
        </Placeholder>
        <div v-else class="medical-container-body">
            <p>{{observation}}</p>
        </div>
    </div>
</template>
<script>

import Placeholder from "@/components/pets/show/medical/Placeholder";
export default {
    name: "Observation",
    props: {
        observation: {
            type: String,
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
        Placeholder,
    },
}
</script>
