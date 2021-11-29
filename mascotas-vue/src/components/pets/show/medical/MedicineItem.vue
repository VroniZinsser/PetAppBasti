<template>
    <div class="card medicine-item">
        <div class="medicine-item-info">
            <span class="card-title">{{medicine.name}}</span>
            <span class="card-subtitle">{{medicine.quantity}}</span>
            <span class="card-date">{{formatDate(medicine.start_date)}} - {{formatDate(medicine.end_date)}}</span>
        </div>
        <div class="medicine-item-hours">
            <div v-for="hour in medicine.hours" :key="hour.id">
                {{hour.time}}
            </div>
        </div>
        
    </div>
    
</template>
<script>
import { formatDate } from "@/helpers";
export default {
    name: "MedicineItem",
    props: {
        medicine: {
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
