<template>
    <b-container fluid>
        <aside id="slider" class="main-sidebar">
            <section class="sidebar" style="height: auto;">
                <ul class="sidebar-menu">
                    
                    <div id="list-example" class="list-group">
                        <a class="list-group-item list-group-item-action" href="/car_reservation/public/task/add">ขอใช้รถ</a>
                        <a class="list-group-item list-group-item-action" href="/car_reservation/public/task/waiting_list">รายการรอพิจารณา</a>
                       
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


