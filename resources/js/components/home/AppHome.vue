<template>
    <div>
<!--        <v-container>-->
        <v-layout row wrap v-if="loggedIn">

            <v-flex xs8>
                <div  v-if="Object.keys(getQuestions).length === 0">No questions have been asked yet.</div>
                <question
                    v-for="question in getQuestions"
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
import {mapGetters} from "vuex";
export default {
    name: "AppHome",
    components: {AppSidebar, Question},
    data(){
        return{
        }
    },
    computed:{
        ...mapGetters([
            'loggedIn',
            'getUser',
            'getQuestions'
        ])
    },
   async created() {
        console.log('created');
       this.$store.dispatch('allQuestions');
       this.$store.commit('isEditing', false)
       this.$store.commit('setNewReply', false);
       this.$store.commit('setEditReply', false);
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
