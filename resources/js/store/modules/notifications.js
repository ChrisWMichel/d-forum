import axios from 'axios'

export default{
    state: {
        read:[],
        unread:[]
    },
    getters: {
        getReadNotice  : state => state.read,
        getUnreadNotice: state => state.unread
    },
    mutations: {


    },
    actions: {
        async getNotifications({state, rootGetters}){
            if(rootGetters.loggedIn){
                await axios.post(`/api/notifications`, rootGetters.getUser)
                    .then(resp => {
                        state.read = resp.data.read;
                        state.unread = resp.data.unread;
                    })
            }
        }

    },
    modules: {
    }
}

