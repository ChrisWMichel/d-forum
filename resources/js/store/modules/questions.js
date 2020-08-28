import axios from 'axios'


export default{
    state: {
        originalQuestion:{}
    },
    getters: {
       getOriginalQuest: state => state.originalQuestion
    },
    mutations: {
      setOriginalQuestion(state, question){
          state.originalQuestion = question;
      }
    },
    actions: {

    },
    modules: {
    }
}

