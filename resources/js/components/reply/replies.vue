<template>
    <v-card class="mx-auto mt-4" v-if="user.id">

        <v-card-subtitle class="pb-0">

            <div id="title">{{reply.user}}</div>
            <div class="ml-2">said {{reply.updated_at}}</div> <!-- ||reply.created_at-->
            <v-spacer></v-spacer>
            <like :reply="reply" class="float-right"></like>
            <div class="" style="clear: both"></div>
        </v-card-subtitle>




        <v-divider></v-divider>

        <edit-reply v-if="editReply && editObj === reply" :reply="editObj"></edit-reply>

            <div v-else class="cardText" v-html="body"></div>
            <v-divider></v-divider>
        <div  v-if="!editReply">
            <v-card-actions v-if="user.id === reply.user_id">
                <v-btn icon small  @click="edit(reply)">
                    <v-icon color="orange">mdi-pencil</v-icon>
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn icon small @click="deleteReply()">
                    <v-icon color="red">mdi-delete-forever</v-icon>
                </v-btn>
            </v-card-actions>
        </div>
    </v-card>
</template>

<script>
import EditReply from "./editReply";
import Like from "../like/Like";
export default {
    name: "replies",
    components: {Like, EditReply},
    props:['reply'],
    data(){
        return {
           editObj:null
        }
    },
    computed:{
        body(){
            return marked(this.reply.reply)
        },
        user(){
            return this.$store.getters.getUser;
        },
        editReply(){
            return this.$store.getters.getEditReply
        },
        allReplies(){
            return this.$store.getters.getReplies;
        }
        // setEditObj(){
        //     this.editObj = this.$store.getters.getEditObj
        // }
    },
    created() {
        this.editObj = null;
        this.listen();
    },
    methods:{
        async deleteReply(){
            const questID = this.$store.getters.getQuestID;
            await axios.delete(`/api/question/${questID}/reply/${this.reply.id}`)
                    .then(resp => {
                        this.$store.dispatch('updateReplies', resp.data);
                    })
            this.$store.commit('setQuestID', null);
        },
        edit(reply){
            this.editObj = reply;
           // this.$store.commit('setEditReplyObj', reply);
           // this.setEditObj;
            this.$store.commit('setEditReply', true);
        },
        listen(){
            Echo.private('App.Models.User.' + this.user.id)
                .notification((notification) => {
                    console.log('notification', notification);
                    this.$store.dispatch('updateReplies', notification.reply)

                });
            Echo.channel('deleteReplyChannel')
                .listen('DeleteReplyEvent', e => {

                    for(let index = 0; index < Object.keys(this.allReplies).length; index++){
                        if(this.reply[index].id === e.id){
                            this.reply.splice(index, 1);
                        }
                    }
                })
        }
    }
}
</script>

<style scoped>
    .cardText{
        color: black;
        padding: 15px;
    }
    .card__text{
        color: black !important;
    }
</style>
