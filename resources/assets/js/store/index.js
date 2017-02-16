import Vue from 'vue'
import Vuex from 'vuex'

import mutations from './mutations'
import * as actions from './actions'

Vue.use(Vuex)

const state = {
    dialogFormVisible:false,
    currentApiUrl:'',
    currentData:'',
    postData:{
        tabIndex:0,
        pageSize:null,
        page:1,
        selectSearch:'',
        inputSearch:''
    },
    headers:{},
}
export default new Vuex.Store({
  state,
  mutations,
  actions
})
