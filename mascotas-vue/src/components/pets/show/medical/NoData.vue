<template>
    <div class="no-data">
        <img :src="img_src" :alt="cta_text">
        <p>{{text}}</p>
        <a :href="cta_url" class="add-data-link">{{cta_text}}</a>
    </div>
</template>
<script>

export default {
    name: "NoData",
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
        }
    }
}
</script>
