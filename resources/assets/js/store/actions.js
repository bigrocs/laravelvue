import * as types from './mutation-types'
import { Notification } from 'element-ui';

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
	for(var key in state.mainData.routes){
        if(state.mainData.routes[key].name == routeName){
            currentApiUrl = state.mainData.routes[key].apiUrl
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
 * [getNotify 获取post请求通知]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-01T11:49:12+0800
 * @param    {[type]}                 options.commit   [vuex赋值]
 * @param    {[type]}                 options.state    [vuex状态数据]
 * @param    {[type]}                 options.url      [请求网址]
 * @param    {String}                 options.postData [请求数据]
 * @return   {[type]}                                  [description]
 */
export const getNotify = ({ commit,state },{url = state.currentApiUrl, postData = ''}) => {
    axios.post(url,postData)
        .then((Response) => {
            Response.data.duration = Response.data.duration ? Response.data.duration : 4500;  //设置自动取消时间
            Notification({
              title: Response.data.title,
              message: Response.data.message,
              type: Response.data.type,
              iconClass: Response.data.iconClass,
              customClass: Response.data.customClass,
              duration: Response.data.duration,
              onClose: Response.data.onClose,
              offset: Response.data.offset,
            })
        })
        .catch(function (error) {
            Notification({
                title: '操作失败',
                message: '操作失败请联系管理员！',
                type: 'error',
            })
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
/**
 * 暂时废弃
 * [initHeaders 初始化页面头部Headers]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-02-16T16:34:05+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @return   {[type]}                                [description]
 */
// export const initHeaders = ({ commit,state }) => {
//     const tokenData = JSON.parse(window.localStorage.getItem('authUser'))
//     const Authorization = 'Bearer ' + tokenData.accessToken
//     commit(types.SET_HEADERS,{ Authorization })//设置头部Authorization
//     /**
//      * [common 赋值axios headers]
//      * @type {[type]}
//      */
//     window.axios.defaults.headers.common = state.headers  
// }