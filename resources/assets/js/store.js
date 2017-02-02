import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    Config:{
      Api:{
          mainUrl:'/api/admin/main' //API接口网址
      },
    },
    dialogFormVisible:false,
    currentApiUrl:'',
    currentData:'',
    postData:{
        tabIndex:0,
        pageSize:null,
        page:1,
        selectSearch:'',
        inputSearch:''
    }
};
const mutations = {
    /**
     * 获取当前路由的APIURL
     */
    getCurrentApiUrl (state,routeName) {
        for(var key in state.data.routes){
            if(state.data.routes[key].name == routeName){
                state.currentApiUrl = state.data.routes[key].apiUrl;
            }
        }
    },
    /**
     * 根据当前路由获取页面数据
     */
    getCurrentData (state,data) {
        Vue.http.post(state.currentApiUrl,data).then((Response) => {
            state.currentData = Response.data
            if(state.currentData.title){
                document.title = state.currentData.title//设置页面标题
            }
        })
    }
};
export default new Vuex.Store({
  state,
  mutations
})
