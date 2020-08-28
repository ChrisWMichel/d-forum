<template>

    <v-card class="mx-auto" style="margin-top:18px">
        <v-toolbar color="#9bb1ba" dark dense>
            <v-toolbar-title>Categories</v-toolbar-title>


        </v-toolbar>
        <v-list v-for="category in categories" :key="category.id">
            <router-link to="">
                <v-list-item-content class="ml-2">
                    <v-list-item-title>{{category.name}}</v-list-item-title>
                </v-list-item-content>
            </router-link>
        </v-list>
    </v-card>

</template>

<script>

export default {
    name: "AppSidebar",
    data(){
        return {
            //categories:{}
        }
    },
    computed:{
        categories(){
            return  this.$store.getters.getCat;
        }
    }
}
</script>

<style scoped>

</style>
