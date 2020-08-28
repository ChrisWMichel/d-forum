<template>
    <v-card v-if="user.id">
        <v-container fluid>
            <v-card-title class="headline">
                {{data.title}}
                <v-spacer></v-spacer>
                <v-btn color="teal">{{data.reply_count}} replies</v-btn>
            </v-card-title>
            <v-card-subtitle>{{data.user}} Posted {{data.created_at}}</v-card-subtitle>

            <v-card-text v-html="body"></v-card-text>
            <v-card-actions v-if="user.id === data.user_id">

                <v-btn icon small  @click="editQuestion()">
                    <v-icon color="orange">mdi-pencil</v-icon>
                </v-btn>
                <v-spacer></v-spacer>
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
            return marked(this.data.body)
        },
        user(){
            return this.$store.getters.getUser;
        }
    },
    methods:{
        async deleteQuestion(){
            await axios.delete(`/api/question/${this.data.id}`)
                .then(resp => this.$router.push({name:'home'}))
                .catch(error => console.log(error.response.data))
        },
        editQuestion(){
            this.$store.commit('isEditing', true);
        }
    }
}
</script>

<style scoped>

</style>
