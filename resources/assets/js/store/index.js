import Vue from 'vue'
import Vuex from 'vuex'

import mutations from './mutations'
import * as actions from './actions'

Vue.use(Vuex)

const state = {
    /**
     * [mainData 主数据设置]
     * @type {String}
     */
    mainData:{
        routes:'',
        apiUrl:''
    },
    /**
     * [dialogFormVisible dialog弹窗状态控制]
     * @type {Boolean}
     */
    dialogFormVisible:false,
    /**
     * [currentApiUrl 当前页面API通信网址]
     * @type {String}
     */
    currentApiUrl:'',
    /**
     * [currentData 当前页面数据]
     * @type {String}
     */
    currentData:'',
    /**
     * [postData 页面访问post初始数据]
     * @type {Object}
     */
    postData:{
        tabIndex:'0',
        pageSize:null,
        page:1,
        selectSearch:'',
        inputSearch:''
    },
    /**
     * [headers API通信header头部初始数据]
     * @type {Object}
     */
    headers:{
        'Accept':'application/json',
        'Authorization':'',
        'X-CSRF-TOKEN': window.Laravel.csrfToken,
        'X-Requested-With': 'XMLHttpRequest'
    },
}
export default new Vuex.Store({
  state,
  mutations,
  actions
})
