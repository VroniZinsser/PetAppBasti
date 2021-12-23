<template>
    <v-select
        :items="userTypes"
        item-text="name"
        item-value="id"
        label="Tipo de profesional"
        outlined
        v-model="userTypeId"
    ></v-select>
</template>

<script>
export default {
    name: "ExploreSearchBar",
    props: {
        professionals: {
            type: Array,
            required: true,
        },
        userTypes: {
            type: Array,
            required: true,
        }
    },
    data() {
        return {
            userTypeId: null,
            filteredProfessionals: [],
        }
    },
    watch: {
        userTypeId(id) {
            this.filterProfessionalsByType(id);
            this.$emit('update-filtered-professionals', this.filteredProfessionals);
        }
    },
    methods: {
        /**
         * Adds all professionals to the filtered list whose user types contain the given user type id
         */
        filterProfessionalsByType(typeId) {
            if (typeId === -1) {
                this.filteredProfessionals = this.professionals;
            } else {
                this.filteredProfessionals = [];
                this.professionals.forEach((professional) => {
                    professional.user_types.forEach((type) => {
                        if (type.id === typeId) {
                            this.filteredProfessionals.push(professional);
                        }
                    })
                })
            }
        },
    }
}

</script>