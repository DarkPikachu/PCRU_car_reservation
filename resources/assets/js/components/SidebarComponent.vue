<template>
    <b-container fluid>
        <aside id="slider" class="main-sidebar">
            <section class="sidebar" style="height: auto;">
                <ul class="sidebar-menu">
                    <li class="header"> MAIN NAVIGATION</li>

                    <div id="list-example" class="list-group">
                        <a class="list-group-item list-group-item-action" href="task/add">ขอใช้รถ</a>
                        <a class="list-group-item list-group-item-action" href="task/waiting_list">รายการรอพิจารณา</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-3">Item 3</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-4">Item 4</a>
                    </div>
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


