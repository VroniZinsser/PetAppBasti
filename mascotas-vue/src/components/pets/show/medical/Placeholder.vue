<template>
    <div class="no-data">
        <img :src="img_src" :alt="cta_text">
        <p>{{ replacePetName(text, pet_name) }}</p>
        <a :href="cta_url" class="add-data-link">{{cta_text}}</a>
    </div>
</template>
<script>

export default {
    name: "Placeholder",
    props: {
        img_src: {
            type: String,
            required: true,
        },
        text: {
            type: String,
            required: true,
        },
        cta_url: {
            type: String,
            required: true,
        },
        cta_text: {
            type: String,
            required: true,
        },
        pet_name: {
            type: String,
            required: true,
        }
    },

    methods: {
        replacePetName(text, petName) {
            return text.replace(':petName', petName);
        }
    }
}
</script>
