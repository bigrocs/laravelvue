import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    Config:{
      Api:{
          mainUrl:'/api/v1/main' //API接口网址
      },
    },
    CurrentApiUrl:'',
};
const mutations = {
    /**
     * 获取当前路由的APIURL
     */
    getCurrentApiUrl (state,routeName) {
        for(var key in state.data.routes){
            if(state.data.routes[key].name == routeName){
                state.CurrentApiUrl = state.data.routes[key].apiUrl;
            }
        }
    }
};
export default new Vuex.Store({
  state,
  mutations
})
