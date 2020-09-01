<template>
    <div>
        <div  v-if="user.id !== reply.user_id">
            <v-btn icon medium @click="likePost">
                <v-icon :color="like ? 'green':'black'">mdi-star </v-icon>
                {{reply.like_count + count}}
            </v-btn>
        </div>
        <div v-else>
            <v-icon :color="like ? 'green':'black'">mdi-star </v-icon>
            {{reply.like_count + count}}
        </div>

    </div>
</template>

<script>
export default {
    name: "Like",
    props:['reply'],
    data(){
        return {
            like:false,
            count:0,
            user:null
        }
    },
    created() {
        Echo.channel('likeChannel')
            .listen('LikeEvent', (e) => {
                if(this.reply.id === e.id){

                    e.type === 1 ? this.count++ : this.count--
                }
            });

       this.user = this.$store.getters.getUser;
        this.reply.likes.forEach(row => {
            if(row.user_id === this.user.id){
                this.like = true;
            }
        });
    },
    methods:{
        async likePost(){
            this.like = !this.like;
            this.like ? this.incr() : this.decr();
        },
        async incr(){
            await axios.post(`/api/like/`, {'reply_id':this.reply.id, 'user_id':this.user.id} )
             .then(resp => this.count++)
        },
        async decr(){
            await axios.delete(`/api/dislike/`, {params:{'reply_id':this.reply.id, 'user_id':this.user.id}} )
                .then(resp => this.count--)
        }
    }
}
</script>

<style scoped>

</style>
