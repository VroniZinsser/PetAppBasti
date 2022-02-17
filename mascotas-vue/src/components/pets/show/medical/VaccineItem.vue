<template>
    <div class="card vaccine-item">
        <span class="card-title">{{vaccine.name}}</span>
        <span class="card-date">{{formatDate(vaccine.date)}}</span>
        <router-link :to="{name: 'VaccineEditForm', params: {pet_id: vaccine.pets_id, vaccine_id: vaccine.id}}">Editar</router-link>
    </div>
    
</template>
<script>
import { formatDate } from "@/helpers";

export default {
    name: "VaccineItem",
    props: {
        vaccine: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            formatDate: formatDate,
        }    
    }
}
</script>
