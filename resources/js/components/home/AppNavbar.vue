<template>
    <!--<div class="container">-->
        <v-card>
            <v-app-bar
                absolute
                color="#385F73"
                dark
            >
                <!--                <v-app-bar-nav-icon></v-app-bar-nav-icon>-->

                <v-toolbar-title>
                    <router-link style="color: white; text-decoration: none" :to="{name:'home'}">D-Forum</router-link>
                </v-toolbar-title>

                <v-spacer></v-spacer>
                <p class="mt-4 mr-4">{{user.email}}</p>

                <v-btn class="btn-style" v-if="isLoggedIn">
                    <router-link class="nav-style" :to="{name:'create'}">Ask Question</router-link>
                </v-btn>
                <v-btn class="btn-style" v-if="isLoggedIn && isAdmin">
                    <router-link class="nav-style" :to="{name:'create-category'}">Category</router-link>
                </v-btn>
                <v-btn class="btn-style" v-if="isLoggedIn">
                    <a class="nav-style" href="#" @click="logout">Logout</a>
                </v-btn>
                <!-- <v-btn icon>
                     <v-icon>mdi-dots-vertical</v-icon>
                 </v-btn>-->
            </v-app-bar>
        </v-card>
   <!-- </div>-->
</template>

<script>
import {mapGetters} from 'vuex';
export default {
    name: "AppNavbar",
    data(){
        return {
            //user: this.$store.getters.getUser,
           // isLoggedIn: this.$store.state.isLoggedIn
        }
    },
    created() {
        //console.log('loggedIn', this.isLoggedIn)
    },
    computed:{
        ...mapGetters({
            user:'getUser',
            isLoggedIn: 'loggedIn',
            isAdmin: 'isAdmin'
        }),
        // user(){
        //     return this.$store.getters.getUser
        // },
        // isLoggedIn(){
        //     return this.$store.getters.loggedIn
        // }
    },
    methods:{
        async logout(){
            try{
                await axios.post("/logout");
                this.$store.dispatch('logout');
                this.$router.push({name:'login'})
            } catch (err) {
                console.log(err.response.status);
            }
        }
    }
}
</script>

<style scoped>
    .nav-style{
        text-decoration: none;
        color: #9bb1ba;
    }
    .btn-style{
        margin-right: 10px;
    }
</style>
