<template>
    <div v-if="question">
       <edit-question v-if="editing" :data="question"></edit-question>
       <div v-else>
           <show-question v-if="question" :data="question"></show-question>
       </div>
       <v-container class="mt-4">

           <div v-if="!newReply">
               <replies v-for="reply in question.replies" :key="reply.id" :reply="reply"></replies>

               <v-btn class="mt-4" color="green" medium  @click="addReply()">
                   <v-icon >mdi-check </v-icon>
                   Reply
               </v-btn>
           </div>

           <div v-else>
               <new-reply></new-reply>
           </div>
       </v-container>
    </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion";
import EditQuestion from "./EditQuestion";
import Replies from "../reply/replies";
import NewReply from "../reply/newReply";
import {mapGetters} from 'vuex';

export default {
    name: "Read",
    components: {NewReply, Replies, EditQuestion, ShowQuestion},
    data(){
        return{
            question: null
        }
    },
    computed:{
        editing(){
            return this.$store.getters.getEdit;
        },
        newReply(){
            // const check = this.$store.getters.newReply;
            // console.log('check', check)
            // if(!check){
            //     this.getQuestion()
            // }
            // return check;

            this.getQuestion()
        },
        replyObj(){
            return this.$store.getters.getReplies;
        }

    },
    created() {
        this.getQuestion();
    },
    methods:{
       async getQuestion(){

           if(Object.keys(this.replyObj).length > 0){
               this.question = this.replyObj;
               this.$store.commit('clearReplyObj');
           } else {
               console.log('questID', this.$route.params.id)
               let questID = this.$route.params.id;
               if(questID){
                   await axios.get(`/api/question/${questID}`)
                       .then(resp => this.question = resp.data)
               }
           }
           this.$store.commit('setQuestID', this.$route.params.id)
        },
        addReply(){
            this.$store.commit('createNewReply', true);
        }
    }
}
</script>

<style scoped>

</style>
