import * as types from './mutation-types'
import { Notification } from 'element-ui'

/**
 * [setCurrentApiUrl 设置当前路由页面API通信网址]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-04T13:34:19+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @param    {[type]}                 apiUrl         [当前路由api通信网址]
 * @return   {[type]}                                [description]
 */
export const setCurrentApiUrl = ({ commit,state },apiUrl) => {
    commit(types.SET_CURRENT_API_URL,apiUrl) 
}
/**
 * [openLoginRegisterDialogVisible 打开登录注册组件]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-18T15:05:45+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @return   {[type]}                                [description]
 */
export const openLoginRegisterDialogVisible = ({ commit,state }) => {
    commit(types.OPEN_LOGIN_REGISTER_DIALOG_VISIBLE) 
}
/**
 * [closeLoginRegisterDialogVisible 关闭登录注册组件]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-18T15:01:02+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @return   {[type]}                                [description]
 */
export const closeLoginRegisterDialogVisible = ({ commit,state }) => {
    commit(types.CLOSE_LOGIN_REGISTER_DIALOG_VISIBLE) 
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
    .catch(function (error) {
        /**
         * [thenFunction 如果登录没有成功跳转到登录页面]
         * @author BigRocs
         * @email    bigrocs@qq.com
         * @DateTime 2017-03-04T09:26:41+0800
         * @param    {[type]}                 Response [description]
         * @return   {[type]}                          [description]
         */
        var thenFunction = (Response) => {
            let dataState = Response.data.state
            let loginRouterNmae = state.mainData.config.loginRouterNmae
            if (!dataState) {
                setTimeout(() =>  {
                    router.push({name:loginRouterNmae})
                }, 3000);
            }
        }
        getHttpNotify({ commit,state },{url:state.mainData.apiUrl.authCheck, thenFunction}) //检测登录状态
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
 * @param    {String}                 Notification     [from element-ui]
 * @return   {[type]}                                  [description]
 */
export const getHttpNotify = ({ commit,state },{url = state.currentApiUrl, postData = '',thenFunction = ''}) => {
    axios.post(url,postData)
        .then((Response) => {
            if (thenFunction) {
              thenFunction(Response)
            }
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
        tabIndex:'0',
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