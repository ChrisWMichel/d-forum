<template>
    <div class="text-center">

        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn v-on="on" icon medium @click="getNotifications" >
                    <v-icon :color="getUnreadNotice.length > 0 ? 'yellow':'black'">mdi-message-alert </v-icon>
                    {{getUnreadNotice.length}}
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="notice in getUnreadNotice" :key="notice.id">
                    <router-link :to="{name:'read', params:{id:getQuestID}}">
                        <v-list-item-title @click="readNotice(notice)">{{notice.question}}</v-list-item-title>
                    </router-link>
                </v-list-item>
                <v-list-item v-for="notice in getReadNotice" :key="notice.id">
                        <v-list-item-title>{{notice.question}}</v-list-item-title>
                </v-list-item>
                <v-list-item v-if="getReadNotice.length > 0">
                    <v-list-item-title class="clear_notice" @click="deleteNotices()">Clear Notifications</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>

</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "AppNotification",
    data(){
        return {
            notice:true,
            read:[],
            unread:[],
            sound: 'http://soundbible.com/mp3/sms-alert-1-daniel_simon.mp3'
        }
    },
    computed:{
        ...mapGetters([
            'getUnreadNotice',
            'getReadNotice',
            'getUser',
            'getQuestID'
        ])
    },
    created() {
        Echo.private(`App.Models.User.${this.getUser.id}`)
            .notification((notification) => {
                console.log(notification);
                this.playSound();
                this.getUnreadNotice( notification);
            });
    },
    methods:{
         getNotifications(){
             this.$store.dispatch('getNotifications')
        },
        async readNotice(item){
            await axios.post(`/api/markAsRead`, {user:this.getUser, noticeID:item.id})
                .then(resp => {

                    this.$store.dispatch('getNotifications')
                })
        },
        async deleteNotices(){
             const ids = [];
             this.getReadNotice.forEach(item => {
                 ids.push(item.id)
             })
             await axios.post(`/api/deleteNotifications`, {'ids': ids})
                .then(resp => {
                    this.$store.dispatch('getNotifications')
                })
        },
        playSound(){
             const alert = new Audio(this.sound);
             alert.play();
        }
    }
}
</script>

<style scoped>
    .clear_notice{
        font-weight: bolder;
        border-top: #2c3e50 solid 1px;
    }
    .clear_notice:hover{
        cursor: pointer;
    }
</style>
