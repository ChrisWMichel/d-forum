<template>
    <div>
        <show-question :data="question"></show-question>
    </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion";
export default {
    name: "Read",
    components: {ShowQuestion},
    data(){
        return{
            question: {}
        }
    },
    created() {
        let questID = this.$route.params.id;
        axios.get(`/api/question/${questID}`)
            .then(resp => this.question = resp.data)
    }
}
</script>

<style scoped>

</style>
