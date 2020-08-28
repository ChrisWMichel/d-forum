<template>
    <div>
<!--        <v-container>-->
        <v-layout row wrap v-if="loggedIn">
            <v-flex xs8>
                <question
                    v-for="question in questions"
                    :key="question.id"
                    :data="question"
                ></question>
            </v-flex>
            <v-flex mb1></v-flex>
           <v-flex mb3>
               <app-sidebar></app-sidebar>
           </v-flex>
        </v-layout>
<!--        </v-container>-->
    </div>
</template>

<script>
import Question from "../forum/Question";
import AppSidebar from "../forum/AppSidebar";
export default {
    name: "AppHome",
    components: {AppSidebar, Question},
    data(){
        return{
            questions:{}
        }
    },
    computed:{
        loggedIn(){
            return this.$store.getters.loggedIn
        }
    },
   async created() {
       await axios.get('/api/question')
        .then(resp => {
            this.$store.commit('isEditing', false)
            this.$store.commit('setNewReply', false);
            this.$store.commit('setEditReply', false);
            this.questions = resp.data
            //console.log('questions', this.questions);
        })
        .catch(err => console.log('ERROR', err.response.data))
    }
}
</script>

<style scoped>

</style>
