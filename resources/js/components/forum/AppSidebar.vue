<template>

    <v-card class="mx-auto" style="margin-top:18px">
        <v-toolbar color="#9bb1ba" dark dense>
            <v-toolbar-title>Categories</v-toolbar-title>


        </v-toolbar>
        <v-list v-for="category in getCat" :key="category.id">
            <div @click="getCategory(category.id)">
                <v-list-item-content class="cat-list">
                    <v-list-item-title :class="category.id === getCatID ? 'catSelected':'' ">{{category.name}}</v-list-item-title>
                </v-list-item-content>
            </div>
        </v-list>
    </v-card>

</template>

<script>
import {mapGetters} from 'vuex';
export default {
    name: "AppSidebar",
    data(){
        return {
            //categories:{}
        }
    },
    computed:{
        ...mapGetters([
            'getCat',
            'getCatID'
        ]),
        // categories(){
        //     return  this.$store.getters.getCat;
        // }
    },
    methods:{
        getCategory(id){
            this.$store.commit('setCatID', id);
            this.$store.dispatch('allQuestions');
        }
    }
}
</script>

<style scoped>
    .catSelected{
        font-weight: bolder;
    }
    .cat-list:hover{
        cursor: pointer;
        background-color: rgba(170, 172, 183, 0.28);
    }
    .cat-list{
        width: 100%;
        padding-left: 10px;
    }
</style>
