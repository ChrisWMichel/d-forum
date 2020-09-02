import axios from 'axios'


export default{
    state: {
        originalQuestion:{},
        questions:{}
    },
    getters: {
       getOriginalQuest: state => state.originalQuestion,
       getQuestions: state => state.questions
    },
    mutations: {
      setOriginalQuestion(state, question){
          state.originalQuestion = question;
      },
      setQuestions(state, questions){
          state.questions = questions;
      }
    },
    actions: {
        async allQuestions({commit, rootGetters}){
            const catID = rootGetters.getCatID;
            const questions = (await axios.get(`/api/questions?id=${catID}`)).data; // , {'id':catID}
            commit('setQuestions', questions);
        }
    },
    modules: {
    }
}

