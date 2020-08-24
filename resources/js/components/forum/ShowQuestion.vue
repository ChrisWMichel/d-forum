<template>
    <v-card>
        <v-container fluid>
            <v-card-title class="headline">
                {{data.title}}
                <v-spacer></v-spacer>
                <v-btn color="teal">{{data.reply_count}} replies</v-btn>
            </v-card-title>
            <v-card-subtitle>{{data.user}} Posted {{data.created_at}}</v-card-subtitle>
<!-- v-html="body"-->
            <v-card-text v-html="data.body">
            </v-card-text>
            <v-card-actions v-if="user.id === data.user_id">

                <v-btn icon small  @click="editQuestion()">
                    <v-icon color="orange">mdi-account-edit</v-icon>
                </v-btn>
                <v-btn icon small @click="deleteQuestion()">
                    <v-icon color="red">mdi-delete-forever</v-icon>
                </v-btn>
            </v-card-actions>

        </v-container>
    </v-card>
</template>

<script>
export default {
    name: "ShowQuestion",
    props:['data'],
    data(){
        return{

        }
    },

    computed:{
        body(){
            return marked(this.data.body, {sanitize:true})
        },
        user(){
            return this.$store.getters.getUser;
        }
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
