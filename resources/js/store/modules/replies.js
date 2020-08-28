
export default{
    state: {
        newReply:false,
        editReply:false,
        originalReply:'',
        replyObj:{},
        questID: null
    },
    getters: {
        newReply: state => state.newReply,
        getReplies: state => state.replyObj,
        getQuestID: state => state.questID,
        getEditReply: state => state.editReply,
        getOriginalReply: state => state.originalReply
    },
    mutations: {
        createNewReply(state, check){
            state.newReply = check
        },
        setNewReply(state, check){
            state.newReply = check;
        },
        setOriginalReply(state, original){
            state.originalReply = original
        },
        clearReplyObj(state){
            state.replyObj = {};
        },
        setReplyObj(state, payload){
            const replyID = payload.reply.id;
            state.replyObj = payload.question;
            const oldIndex = state.replyObj.replies.findIndex( x => x.id === replyID);

            state.replyObj.replies = state.replyObj.replies.filter(item => {

                if(item.id === replyID){
                    state.replyObj.replies.splice(oldIndex, 1)
                } else {
                    return item;
                }
            })
            state.replyObj.replies.unshift(payload.reply)
        },
        setQuestID(state, id){
            state.questID = id;
        },
        setEditReply(state, check){
            state.editReply = check;
        },
        // setEditReplyObj(state, payload){
        //     state.editReplyObj = payload
        // }
    },
    actions: {
        async updateReplies({state, commit}, payload){
            const question = (await axios.get(`/api/question/${payload.question_id}`)).data;

            commit('setReplyObj', {'question':question, 'reply':payload})
        }
    },
    modules: {
    }
}

