/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// css files
//import 'va/lib/css'

// js files
//import 'va/lib/script'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*import VueBsDrawer from 'vue-bs-drawer'

Vue.component('bs-drawer', VueBsDrawer)*/

Vue.component('navbar-component', require('./components/NavbarComponent.vue'));
Vue.component('sidebar-component', require('./components/SidebarComponent.vue'));
Vue.component('dashboard-component', require('./components/DashboardComponent.vue'));
Vue.component('tasklist-component', require('./components/TaskListComponent.vue'));

import { Navbar, Layout } from 'bootstrap-vue/es/components';

Vue.use(Layout);
Vue.use(Navbar);

const app = new Vue({
    el: '#appVue',
    data: {
        taskList: []
    },
    created() {
        var uri = 'api/task/all'
        axios.get(uri, {
            headers: {
                'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZiZWIxZWNiYWJiYjA4YzI2ODA2MWNkMjY2MjA3MjIwMzYyYTZjYTUwMTY2OTdjMzU1NTk2OTg2NDE4OGM2MTRhYjI5MjUzNDMyN2UxMjExIn0.eyJhdWQiOiIxIiwianRpIjoiNmJlYjFlY2JhYmJiMDhjMjY4MDYxY2QyNjYyMDcyMjAzNjJhNmNhNTAxNjY5N2MzNTU1OTY5ODY0MTg4YzYxNGFiMjkyNTM0MzI3ZTEyMTEiLCJpYXQiOjE1MzMxMTIwODYsIm5iZiI6MTUzMzExMjA4NiwiZXhwIjoxNTY0NjQ4MDg2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Ozhi8umbCkJJaySURq2lHmCyMNfx3vmRmAi-3QUY3ZwBwfFjJo3UTjHcJpi6P6EqxnMs7KDTqNh9hfckt_N9-F8dFjPW3tYiMglzTKQqkPMJXkYROdQnfgxduoIjMfxfFp7wYQ3RC8t15ygSBtB3DhXFoHLOkR5v1EFptomlAJYKgdq1a7q0mnmph-z7uZgEsfqChns6kcFsfsM6VhEuXyjw9FcDsdJKzqp_wwSm9OFV1nleeLwAqiaLaG0WklLECuNsDizLRNuGa9Mn7SCMOgDzyuRui15gorY8KBhXrFEQ_f3-x4afEFgS8yO5IXYseOhUNyNgRIZxDDc6KmSWFG5njipRh9nwcIjBM0d_-LleoICiaCGBgFH-WXEA3dfZF0UNW8hdhPIOSZmi0Jtk8dywx3bEvxxCP1z-u3axe7EqkLFHhtBjdCD83mZayLm60xdEJifHw1KudGE-yDPR9x4QdxsRVRoRhe5QH1aX9jHugw0fnx70KTmeZA0wmjLugqupK31yR2Sws3zgYP-dXW_8cedWQ0azeBQeroXlC6ZMFV028rSqKr_adqLQtK-NblB6kgw2obm5DBl2daXPT3St3cZ8TYYwBFigJg--0ED4i7PxTObFiC5nbuNUQqbVjXGJ9_zhPbX49VQeIIEwO8SfVImkzYBnoaaQpHsQwaY',
                'Accept': 'application/json'
            }
        }).then(response => {
            console.log("debug", this)
            this.results = response.data.tasks

            //this.dataAdaptor(response.data.tasks)
            var tasks = response.data.tasks
            var events = []
            for (var i = 0; i < tasks.length; i++) {
                var tmpTitile = ''
                if (tasks[i].car != null)
                    tmpTitile += tasks[i].car.name + ' ทะเบียน ' + tasks[i].car.plate_number + ' ' + tasks[i].car.province + ' ไป ' + tasks[i].target + ' จ.' + tasks[i].province.province_name
                else
                    tmpTitile += ' ไป ' + tasks[i].target + ' จ.' + tasks[i].province.province_name


                var obj = {
                    id: tasks[i].id,
                    title: tmpTitile,
                    start: tasks[i].start_date + 'T' + tasks[i].start_time,
                    end: tasks[i].end_date + 'T' + tasks[i].end_time,
                    color: (tasks[i].status == '0') ? '#666666' : (tasks[i].status == '1') ? '#FF9933' : '#36c'
                }
                events.push(obj)
            }
            this.taskList = events

            this.results = events
            this.$refs.tasklist.setEvents(tasks);
            this.$refs.calendar.setEvents(this.results);
        })
    },
});