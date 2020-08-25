<template>
    <div>
<!--        <v-container>-->
        <v-layout row wrap>
            <v-flex xs8>
                <question
                    v-for="question in questions"
                    :key="question.id"
                    :data="question"
                ></question>
            </v-flex>
            sidebar
        </v-layout>
<!--        </v-container>-->
    </div>
</template>

<script>
import Question from "../forum/Question";
export default {
    name: "AppHome",
    components: {Question},
    data(){
        return{
            questions:{}
        }
    },
   async created() {
       await axios.get('/api/question')
        .then(resp => {
            this.$store.commit('isEditing', false)
            this.questions = resp.data
        })
        .catch(err => console.log('ERROR', err.response.data))
    }
}
</script>

<style scoped>

</style>
