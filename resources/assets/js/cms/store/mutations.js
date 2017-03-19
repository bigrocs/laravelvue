import * as types from './mutation-types'
export default {
    /**
     * 暂时废弃
     * [SET_HEADERS 设置Headers数据]
     * @headers 当前请求头部    
     */
    // [types.SET_HEADERS] (state,{
    //     Accept = state.headers['Accept'],
    //     Authorization = state.headers['Authorization'],
    //     XCsrfToken = state.headers['X-CSRF-TOKEN'],
    //     XRequestedWith = state.headers['X-Requested-With'],
    // }){
    //     state.headers = {
    //         'Accept':Accept,
    //         'Authorization':Authorization,
    //         'X-CSRF-TOKEN': XCsrfToken,
    //         'X-Requested-With': XRequestedWith,
    //     }
    // },
    /**
     * [CHANGE_LOGIN_DIALOG_VISIBLE 改变登录组件状态]
     * @currentApiUrl 当前路由通信ApiUrl  
     */
    [types.CHANGE_LOGIN_DIALOG_VISIBLE] (state){
        state.loginDialogVisible = !state.loginDialogVisible
    },
    /**
     * [CHANGE_REGISTER_DIALOG_VISIBLE 改变注册组件状态]
     * @currentApiUrl 当前路由通信ApiUrl  
     */
    [types.CHANGE_REGISTER_DIALOG_VISIBLE] (state){
        state.registerDialogVisible = !state.registerDialogVisible
    },
    /**
     * [SET_CURRENT_API_URL 设置currentApiUrl数据]
     * @currentApiUrl 当前路由通信ApiUrl     
     */
    [types.SET_CURRENT_API_URL] (state,currentApiUrl){
        state.currentApiUrl = currentApiUrl
    },
    /**
     * [SET_CURRENT_DATA 设置currentData数据]
     * @currentApiUrl 当前页面显示数据   
     */
    [types.SET_CURRENT_DATA] (state,currentData){
        state.currentData = currentData
    },
    /**
     * [SET_POST_DATA 设置postData数据]
     * @type {Number}
     * 不传入默认不修改
     */
    [types.SET_POST_DATA] (state,{ 
    	tabIndex = state.postData['tabIndex'],
    	pageSize = state.postData['pageSize'],
    	page = state.postData['page'],
    	selectSearch = state.postData['selectSearch'],
    	inputSearch = state.postData['inputSearch'] 
    }){
    	state.postData = {
    		tabIndex:tabIndex,
	        pageSize:pageSize,
	        page:page,
	        selectSearch:selectSearch,
	        inputSearch:inputSearch
    	}
    },
}