<template>
    <div class="explore-list">
        <div>
            <v-select
                :items="userTypes"
                item-text="name"
                item-value="id"
                label="Tipo de profesional"
                outlined
            ></v-select>
        </div>

        <ul>
            <ExploreListItem 
                v-for="professional in professionals" 
                :key="professional.id" 
                :professional="professional"
                :isActive="professional.id === selectedProfessionalId">
            </ExploreListItem>
        </ul>
    </div>
    
</template>
<script>
import ExploreListItem from "@/components/geolocation/list/ExploreListItem";

export default {
    name: "ExploreList",
    props: {
        professionals: {
            type: Array,
            required: true,
        },
        userTypes: {
            type: Array,
            required: true,
        },
        selectedProfessionalId: {
            type: Number
        }
    },
    components: {
        ExploreListItem,
    },

    // computed: {
    //     existingUserTypes: function () {
    //         let redundantUserTypes = this.professionals.map((prof) => {
    //             return prof.user_types;
    //         }).flat();
            
    //         .map((type) => {
    //             return {
    //                 'id': type.id,
    //                 'name': type.name
    //             }
    //         });

    //     let reducedTypes = redundantUserTypes.filter((item,index)=>{ // filter javascript array
    //         return redundantUserTypes.indexOf(item) === index;
    //     })
    //         // .reduce((acc, item)=> {
    //         //     if (!acc.includes(item)) {
    //         //         acc.push(item);
    //         //     }
    //         //     return acc;
    //         // },[])
    //     //     let userTypes = [];
    //     //     this.professionals.map ((prof => {
    //     //         prof.user_types.map((type) => {
    //     //             userTypes.push(type);
    //     //         })
    //     //    }))
    //     //    let types = [...new Set(userTypes)];
    //     //    console.log(types);
    //     //    return [...new Set(userTypes)];

    //         console.log('usertypes: ', reducedTypes);
    //         // return this.message.split('').reverse().join('')
    //         return [1, 2, 3];
    //     }
    // }
}
</script>
