import * as types from './mutation-types'

/**
 * [getCurrentApiUrl 获取当前路由页面API通信网址]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-02-16T14:39:45+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @param    {[type]}                 routeName      [当前路由名称]
 * @return   {[type]}                                [description]
 */
export const getCurrentApiUrl = ({ commit,state },routeName) => {
	let currentApiUrl = null
	for(var key in state.data.routes){
        if(state.data.routes[key].name == routeName){
            currentApiUrl = state.data.routes[key].apiUrl
        }
    } 
    commit(types.SET_CURRENT_API_URL,currentApiUrl) 
}

/**
 * [getCurrentData 获取当前页面数据]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-02-16T14:51:16+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @param    {[type]}                 postData       [description]
 * @return   {[type]}                                [description]
 */
export const getCurrentData = ({ commit,state },postData) => {
    axios.post(state.currentApiUrl,postData).then((Response) => {
    	commit(types.SET_CURRENT_DATA,Response.data) 
        if(state.currentData.title){
            document.title = state.currentData.title//设置页面标题
        }
    })
}
/**
 * [setTabIndex 设置tabIndex]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-02-16T15:15:12+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {Number}                 tabIndex       [description]
 * @return   {[type]}                                [description]
 */
export const setTabIndex = ({ commit }, tabIndex = 0) => {
	commit(types.SET_POST_DATA,{ tabIndex })
}
/**
 * [initTabIndex 初始化tabIndex]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-02-16T14:39:18+0800
 * @param    {[type]}                 options.commit [description]
 * @return   {[type]}                                [description]
 */
export const initTabIndex = ({ commit }) => {
	const tabIndex = 0
	commit(types.SET_POST_DATA,{ tabIndex })
}
/**
 * [initPostData 初始化postData数据]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-02-16T14:38:43+0800
 * @param    {[type]}                 options.commit [description]
 * @return   {[type]}                                [description]
 */
export const initPostData = ({ commit }) => {
	commit(types.SET_POST_DATA,{
        tabIndex:0,
        pageSize:null,
        page:1,
        selectSearch:'',
        inputSearch:''
    })
}