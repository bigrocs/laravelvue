<template>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://cdn.bootcss.com/admin-lte/2.3.6/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>laravelCmf Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
        </button>
      </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>首页 Dashboard</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            <li class="header">系统 system</li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>系统功能</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <router-link to="/foo"><i class="fa fa-wrench"></i>系统设置</router-link>
                    </li>
                    <li>
                        <router-link to="/bar"><i class="fa fa-cogs"></i>配置管理</router-link>
                    </li>
                    <li>
                        <router-link to="/foo"><i class="fa fa-upload"></i>上传管理</router-link>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder-open-o"></i> <span>应用中心</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <router-link to="/foo"><i class="fa fa-wrench"></i>模块扩展</router-link>
                    </li>
                    <li>
                        <router-link to="/foo"><i class="fa fa-cogs"></i>插件管理</router-link>
                    </li>
                    <li>
                        <router-link to="/foo"><i class="fa fa-upload"></i>主题管理</router-link>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
</template>
