<template>
    <b-container fluid>
        <aside id="slider" class="main-sidebar">
            <section class="sidebar" style="height: auto;">
                <ul class="sidebar-menu">
                    <li class="header"> MAIN NAVIGATION</li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a> 
                        <ul class="treeview-menu">
                            <li class="active">
                                <a href="task/add"><i class="fa fa-circle-o"> ขอใช้รถ</i></a>
                            </li>
                            <li class=""><a href="task/add"><i class="fa fa-circle-o"> ขอใช้รถ</i></a></li>
                            <li class=""><a href="/dashboard/v1"><i class="fa fa-circle-o"> รายการรอพิจารณา</i></a></li>
                            <li class=""><a href="/dashboard/v2"><i class="fa fa-circle-o"> Dashboard v2</i></a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-files-o"></i> <span>Layout Options</span> <span class="pull-right-container"><small class="label pull-right label-primary">4</small></span></a> 
                        <ul class="treeview-menu">
                            <li><a><i class="fa fa-circle-o"> Top Navigation</i></a></li>
                            <li><a><i class="fa fa-circle-o"> Boxed</i></a></li>
                            <li><a><i class="fa fa-circle-o"> Fixed</i></a></li>
                            <li><a><i class="fa fa-circle-o"> Collapsed Sidebar</i></a></li>
                        </ul>
                    </li>
                    
                    <li class="">
                        <a href="/examples/widgets"><i class="fa fa-th"></i> <span>Widgets</span> <span class="pull-right-container"><small class="label pull-right bg-green">new</small></span></a>
                    </li>
                </ul>
            </section>
        </aside>
    </b-container>
</template>

<script>
    import { Navbar, Layout } from 'bootstrap-vue/es/components';

    Vue.use(Layout);
    Vue.use(Navbar);


    export default {
        name: 'SidebarMenu',
        methods: {
            
        }
    }
</script>


