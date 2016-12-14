import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    Config:{
      Api:{
          mainUrl:'/api/v1/main' //API接口网址
      },
    },
};
export default new Vuex.Store({
  state
})
