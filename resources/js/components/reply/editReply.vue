<template>
    <v-container>
        <div>
            <v-form @submit.prevent = 'update'>
                <vue-simplemde v-model="reply.reply" />
                <v-card-actions>
                    <v-btn icon medium color="orange"  @click="cancel">
                        <v-icon>mdi-cancel</v-icon>
                        Cancel
                    </v-btn>
                    <v-spacer></v-spacer>

                    <v-btn icon medium color="teal" type="submit">
                        <v-icon >mdi-content-save</v-icon>
                        Update
                    </v-btn>
                </v-card-actions>
            </v-form>
        </div>
    </v-container>
</template>

<script>
import moment from 'moment/moment'
export default {
    name: "editReply",
    props:['reply'],
    data(){
        return{
            replyObj: null,
            today:new Date(),
            cancelReply:true
        }
    },
    created() {
        this.replyObj = this.$store.getters.getReplies;
        this.$store.commit('setOriginalReply', this.reply.reply)
    },
    methods:{
        cancel(){
            if(this.cancelReply){
                this.reply.reply = this.$store.getters.getOriginalReply;
                this.$store.commit('setOriginalReply', '')
                this.cancelReply = true;
            }
            this.$store.commit('setEditReply', false);
        },
        async update(){
            if(this.reply.reply){
                await axios.patch(`/api/question/${this.reply.question_id}/reply/${this.reply.id}`, {'body':this.reply.reply})
                    .then(resp => {
                       this.reply.updated_at =  moment(this.today).fromNow();
                        this.$store.dispatch('updateReplies',this.reply);
                        window.scrollTo(0,0)
                        this.cancelReply = false;
                        this.cancel()
                    })
            }
        }
    }
}
</script>

<style scoped>

</style>
