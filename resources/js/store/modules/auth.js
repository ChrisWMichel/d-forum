import axios from 'axios'
import {isLoggedIn, logOut} from "../../shared/utils/auth";


export default{
    state: {
        isLoggedIn:false,
        user:{},
        isAdmin:false,
        userID:null
    },
    getters:{
        //getUser: state => state.user,
        getUser(state){
            return state.user
        },
        loggedIn: state => state.isLoggedIn,
        isAdmin: state => state.isAdmin,
        getUserID: state => state.userID
    },
    mutations: {
        setUser(state, payload){
            state.user = payload
        },
        setLoggedIn(state, payload){
            state.isLoggedIn = payload;
        },
        setIsAdmin(state){
            state.isAdmin = true;
        },
        setUserID(state, id){
            state.userID = id
        }
    },
    actions: {
        async loadUser({commit, dispatch}){
            if(isLoggedIn()){
                try{
                    const user = (await axios.get('/user')).data;
                    commit('setUser', user);
                    commit('setUserID', user.id);
                    commit("setLoggedIn", true);
                    if(user.isAdmin === 1){
                        commit('setIsAdmin')
                    }
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

