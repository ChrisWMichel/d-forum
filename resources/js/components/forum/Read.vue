<template>
    <div>
        <edit-question v-if="editing" :data="question"></edit-question>
        <div v-else>
            <show-question v-if="question" :data="question"></show-question>
        </div>
    </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion";
import EditQuestion from "./EditQuestion";
export default {
    name: "Read",
    components: {EditQuestion, ShowQuestion},
    data(){
        return{
            question: null
        }
    },
    computed:{
        editing(){
            return this.$store.getters.getEdit;
        }
    },
    created() {
        this.getQuestion();

    },
    methods:{
        getQuestion(){
            let questID = this.$route.params.id;
            axios.get(`/api/question/${questID}`)
                .then(resp => this.question = resp.data)
        }
    }
}
</script>

<style scoped>

</style>
