<template>
    <v-card
       class="mt-4"
    >
        <v-card-title class="headline">
            <router-link class="routeLink" :to="{name:'read', params:{'questID': data.id}}">{{data.title}}</router-link><!---->
        </v-card-title>

        <v-card-subtitle class="grey--text" >Asked {{data.created_at}} By {{data.user_name }}</v-card-subtitle>

        <v-card-text class="black--text">
           {{data.body}}
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: "Question",
    props:['data']
}
</script>

<style scoped>
    .routeLink{
        text-decoration: none;
        color: black;
    }
    .routeLink:hover{
        font-weight: bolder;
    }
</style>
