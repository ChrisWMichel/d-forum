<template>
    <div>
        <h3>New Reply</h3>
        <vue-simplemde v-model="body"  />

        <v-btn color="green" medium  @click="submitReply()">
            <v-icon >mdi-arrow-right-thick</v-icon>
            Done
        </v-btn>
    </div>
</template>

<script>
export default {
    name: "newReply",
    data(){
        return{
            body:null
        }
    },
    methods:{
        async submitReply(){
            const user = this.$store.getters.getUser;
            const questID = this.$store.getters.getQuestID
            await axios.post(`/api/question/${questID}/reply`, {body:this.body, user_id: user.id })
            .then(resp => {

                this.body = '';
                this.$store.dispatch('updateReplies', resp.data.reply)
                this.$store.commit('setNewReply', false);
                window.scrollTo(0,0);
            })

        }
    }
}
</script>

<style scoped>

</style>
