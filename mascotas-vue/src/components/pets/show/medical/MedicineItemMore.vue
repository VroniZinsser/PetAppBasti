<template>
    <div class="card more">
        <a href="#">
            <div class="inner">
                <p>Ver todos <span>({{quantity}})</span></p>
            </div>
        </a>
    </div>
   
</template>

<script>
export default {
    name: "MedicineItem",
    props: {
        quantity: {
            type: Number,
            required: true
        }
    },
}
</script>
