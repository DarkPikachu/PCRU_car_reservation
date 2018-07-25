<template>
<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-gear"></span>
            </button>
            <a class="navbar-brand" href="#"><span>CarSYS Demo Version</span> <span class="hidden-xs"></span></a>
        </div>
        <div class="clearfix"></div>
        
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right user-nav">
                    <li class="dropdown profile_menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="/fileupload/user/1.png?181" width="30">admin <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="/index.php?r=profile">ข้อมูลส่วนตัว</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="/index.php?r=site/logout">ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>
                                    <ul class="nav navbar-nav navbar-right not-nav">
                        <li class="button">
                            <a href="/index.php?r=carreturn&amp;status=5" title="รับคืนรถ รออนุมัติ">
                                <i class="fa fa-flag-o"></i>
                                                            </a>
                        </li>
                        <li class="button">
                            <a href="/index.php?r=approve" class="speech-button" title="จองใช้รถ รออนุมัติ">
                                <i class="fa fa-inbox"></i>
                                                                    <span class="bubble">1</span>
                                                            </a>
                        </li>				
                    </ul>
                            </div><!--/.nav-collapse -->

            </div>
</div>
</template>

<script>
    import { Navbar, Layout } from 'bootstrap-vue/es/components';

    Vue.use(Layout);
    Vue.use(Navbar);

    export default {
        components: {
        },
        mounted() {
            console.log('Component mounted.')
        }

    }
</script>
