import axios from 'axios'
import {isLoggedIn, logOut} from "../../shared/utils/auth";


export default{
    state: {
        isLoggedIn:false,
        user:{}
    },
    getters:{
        getUser: state => state.user,
        loggedIn: state => state.isLoggedIn
    },
    mutations: {
        setUser(state, payload){
            state.user = payload
        },
        setLoggedIn(state, payload){
            state.isLoggedIn = payload;
        }
    },
    actions: {
        async loadUser({commit, dispatch}){
            if(isLoggedIn()){
                try{
                    const user = (await axios.get('/user')).data;
                    commit('setUser', user);

                    commit("setLoggedIn", true);
                } catch (err){
                    dispatch('logout')
                }
            }
        },
        logout({commit}){
            commit('setUser', {})
            commit('setLoggedIn', false)
            logOut();
        }
    },
    modules: {
    }
}

