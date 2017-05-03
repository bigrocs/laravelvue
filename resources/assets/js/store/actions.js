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
 * [changgeLoginDialogVisible 改变登录组件状态]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-18T15:05:45+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @return   {[type]}                                [description]
 */
export const changeLoginDialogVisible = ({ commit,state }) => {
    commit(types.CHANGE_LOGIN_DIALOG_VISIBLE) 
}
/**
 * [changeRegisterDialogVisible 改变注册组件状态]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-18T15:01:02+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @return   {[type]}                                [description]
 */
export const changeRegisterDialogVisible = ({ commit,state }) => {
    commit(types.CHANGE_REGISTER_DIALOG_VISIBLE) 
}
/**
 * [authCheck 检测用户登录状态]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-25T10:33:07+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @return   {[type]}                                [description]
 */
export const authCheck = ({ commit,state }) => {
    let thenFunction = (Response) => {
        if (Response.data.state) {
            commit(types.AUTH_STATUS_TRUE)          //开启用户登录状态
        }else{
            commit(types.AUTH_STATUS_FLASE)         //关闭用户登录状态
        }
    }
    getHttpNotify({ commit,state },{url:state.mainData.apiUrl.authCheck, thenFunction, notification:false})//请求
}
/**
 * [开启用户登录状态]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-22T11:28:32+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @return   {[type]}                                [description]
 */
export const authCheckTrue = ({ commit,state }) => {
    commit(types.AUTH_STATUS_TRUE) 
}
/**
 * [关闭用户登录状态]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-22T11:28:16+0800
 * @param    {[type]}                 options.commit [description]
 * @param    {[type]}                 options.state  [description]
 * @return   {[type]}                                [description]
 */
export const authCheckFalse = ({ commit,state }) => {
    commit(types.AUTH_STATUS_FLASE) 
}
/**
 * [打开DialogForm并填写数据]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-29T15:23:45+0800
 * @param    {[type]}                 options.commit   [description]
 * @param    {[type]}                 options.state    [description]
 * @param    {[type]}                 options.url      [description]
 * @param    {[type]}                 options.postData [description]
 * @return   {[type]}                                  [description]
 */
export const openDialogForm = ({ commit,state },{url,postData}) => {
    commit(types.DOALOG_FORM_VISIBLE_TRUE) 
    let thenFunction = function(Response){
        commit(types.SET_DOALOG_FORM_DATA,Response.data.form) 
    }
    getHttpNotify({ commit,state },{url,postData,thenFunction,notification:false}) //检测登录状态
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
export const getCurrentData = ({ commit,state },postData=state.postData) => {
    axios.post(state.currentApiUrl,postData,{withCredentials:true}).then((Response) => {
        //设置CurrentData 
    	commit(types.SET_CURRENT_DATA,Response.data) 
        //初始化tabIndex
        if (state.postData.tabIndex==0 && Response.data.tabs) {
            let tabIndex =  Object.keys(Response.data.tabs)[0].toString()
            commit(types.SET_POST_DATA,{
                tabIndex:tabIndex,
            })
        }
        if(state.currentData.title){
            document.title = state.currentData.title//设置页面标题
        }
        //notification信息
        if (Response.data.notification) {
            actionsNotification({ commit },Response.data)
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
 * @DateTime 2017-03-22T11:20:48+0800
 * @param    {[type]}                 options.commit       [vuex赋值]
 * @param    {[type]}                 options.state        [vuex状态数据]
 * @param    {[type]}                 options.url          [请求网址]
 * @param    {String}                 options.postData     [请求数据]
 * @param    {String}                 options.thenFunction [请求后执行外部方法]
 * @param    {Boolean}                options.notification [是否开启Notify提醒]
 * @return   {[type]}                                      [description]
 */
export const getHttpNotify = ({ commit,state },{url = state.currentApiUrl, postData = '',thenFunction = '',notification = true}) => {
    axios.post(url,postData,{withCredentials:true})
        .then((Response) => {
            if (thenFunction) {
              thenFunction(Response)
            }
            if (notification) {
                actionsNotification({ commit },Response.data)
            }
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
 * [setPostData 设置初始化postData数据 不出入默认初始化]
 * @author BigRocs
 * @email    bigrocs@qq.com
 * @DateTime 2017-03-30T14:16:42+0800
 * @param    {[type]}                 options.commit       [description]
 * @param    {String}                 options.tabIndex     [description]
 * @param    {[type]}                 options.pageSize     [description]
 * @param    {Number}                 options.page         [description]
 * @param    {String}                 options.selectSearch [description]
 * @param    {String}                 options.inputSearch  [description]
 * @return   {[type]}                                      [description]
 */
export const setPostData = ({ commit,state },{
        tabIndex = state.postData['tabIndex'],
        pageSize = state.postData['pageSize'],
        page = state.postData['page'],
        selectSearch = state.postData['selectSearch'],
        inputSearch = state.postData['inputSearch'] 
    }) => {
    commit(types.SET_POST_DATA,{
        tabIndex:tabIndex,
        pageSize:pageSize,
        page:page,
        selectSearch:selectSearch,
        inputSearch:inputSearch
    })
}
export const actionsNotification = ({ commit }, datas = '') => {
    datas.duration = datas.duration ? datas.duration : 4500;  //设置自动取消时间
    Notification({
      title: datas.title,
      message: datas.message,
      type: datas.type,
      iconClass: datas.iconClass,
      customClass: datas.customClass,
      duration: datas.duration,
      onClose: datas.onClose,
      offset: datas.offset,
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