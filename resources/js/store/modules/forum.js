import axios from 'axios'


export default{
    state: {
        editing:false
    },
    getters: {
        getEdit: state => state.editing
    },
    mutations: {
        isEditing(state, check){
            state.editing = check
        }
    },
    actions: {

    },
    modules: {
    }
}

