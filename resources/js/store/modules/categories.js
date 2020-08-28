import axios from 'axios'


export default{
    state: {
        editing:false,
        categories:{}
    },
    getters: {
        getEdit: state => state.editing,
        getCat: state => state.categories
    },
    mutations: {
        isEditing(state, check){
            state.editing = check
        },
        setCategory(state, payload){
            state.categories = payload;
        },
        unshiftCat(state, payload){
            state.categories.unshift(payload);
        },
        deleteCategory(state, index){
            state.categories.splice(index, 1)
        },
        updateCategory(state, category){
            //const index = state.categories.indexOf(category.id);
            state.categories.forEach(cat => {
                if(cat.id === category.id){
                    cat.name = category.name;
                    return cat;
                }
            })
        }
    },
    actions: {
      async loadCategories({commit}){
          const cat = (await axios.get('/api/category')).data;
          commit('setCategory', cat);
        }
    },
    modules: {
    }
}

