<template>
<v-app>
    <v-content>
        <v-container fluid>
            <h2>รายการ การขอใช้รถยนต์</h2>
            <v-layout v-for="event in events" :key="`6${event}`">
                <v-flex xs12>
                    <h3>{{ moment(event.start_date, 'YYYY-MM-DD').format('DD MMMM YYYY') }}</h3>
                    <v-data-table :headers="headers" :items="events" hide-actions class="elevation-1">
                        <template slot="items" slot-scope="props">
                            <td>{{ props.item.name }}</td>
                            <td class="text-xs-left">{{ moment(props.item.start_time, 'HH:mm:ss').format('HH:mm น.') }}</td>
                            <td class="text-xs-left">
                                {{ props.item.target }}
                                <br/>
                                <br/>
                                <span class="theme--light darken-1 gray--text">
                                    ผู้ขอใช้รถ {{ props.item.target }}<br/>
                                    ทำรายการ {{ moment(props.item.created_at).format('DD-MM-YYYY HH:mm น.') }}
                                </span>
                            </td>
                            <td class="text-xs-left">
                                {{ props.item.end_date }}<br/>
                                {{ props.item.end_time }}
                            </td>
                            <td class="text-xs-left">
                                {{ props.item.protein }}
                                รอพิจารณา
                            </td>
                        </template>
                    </v-data-table>
                </v-flex>

                <v-flex xs12 >
                    <v-data-table :headers="headers" :items="events" hide-actions class="elevation-1">
                        <template slot="items" slot-scope="props">
                            <td>{{ props.item.name }}</td>
                            <td class="text-xs-left">{{ moment(props.item.start_time, 'HH:mm:ss').format('HH:mm น.') }}</td>
                            <td class="text-xs-left">
                                {{ props.item.target }}
                                <br/>
                                <br/>
                                <span class="theme--light darken-1 gray--text">
                                    ผู้ขอใช้รถ {{ props.item.target }}<br/>
                                    ทำรายการ {{ moment(props.item.created_at).format('DD-MM-YYYY HH:mm น.') }}
                                </span>
                            </td>
                            <td class="text-xs-left">
                                {{ props.item.end_date }}<br/>
                                {{ props.item.end_time }}
                            </td>
                            <td class="text-xs-left">
                                {{ props.item.protein }}
                                รอพิจารณา
                            </td>
                        </template>
                    </v-data-table>
                </v-flex>
            </v-layout>

        </v-container>
    </v-content>

</v-app>
</template>

<script>
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
// index.js or main.js
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import VueRouter from 'vue-router'

import moment from 'moment'
Vue.prototype.moment = moment

Vue.use(VueRouter)
Vue.use(Vuetify)


export default {
    data() {
        return {
            headers: [{
                    text: 'ที่',
                    align: 'left',
                    sortable: false,
                },
                {
                    text: 'เวลา',
                    value: 'time_start',
                    sortable: false
                },
                {
                    text: 'สถานที่ไปราชการ',
                    value: 'fat',
                    sortable: false
                },
                {
                    text: 'วันที่กลับ',
                    value: 'carbs',
                    sortable: false
                },
                {
                    text: 'รถยนต์ และ พขร.ที่อนุมัติ',
                    value: 'protein',
                    sortable: false
                }
            ],
            events:[],
            desserts: [{
                    value: false,
                    name: 'Frozen Yogurt',
                    calories: 159,
                    fat: 6.0,
                    carbs: 24,
                    protein: 4.0,
                    iron: '1%'
                },
                {
                    value: false,
                    name: 'Ice cream sandwich',
                    calories: 237,
                    fat: 9.0,
                    carbs: 37,
                    protein: 4.3,
                    iron: '1%'
                },
                {
                    value: false,
                    name: 'Eclair',
                    calories: 262,
                    fat: 16.0,
                    carbs: 23,
                    protein: 6.0,
                    iron: '7%'
                },
                {
                    value: false,
                    name: 'Cupcake',
                    calories: 305,
                    fat: 3.7,
                    carbs: 67,
                    protein: 4.3,
                    iron: '8%'
                },
                {
                    value: false,
                    name: 'Gingerbread',
                    calories: 356,
                    fat: 16.0,
                    carbs: 49,
                    protein: 3.9,
                    iron: '16%'
                },
                {
                    value: false,
                    name: 'Jelly bean',
                    calories: 375,
                    fat: 0.0,
                    carbs: 94,
                    protein: 0.0,
                    iron: '0%'
                },
                {
                    value: false,
                    name: 'Lollipop',
                    calories: 392,
                    fat: 0.2,
                    carbs: 98,
                    protein: 0,
                    iron: '2%'
                },
                {
                    value: false,
                    name: 'Honeycomb',
                    calories: 408,
                    fat: 3.2,
                    carbs: 87,
                    protein: 6.5,
                    iron: '45%'
                },
                {
                    value: false,
                    name: 'Donut',
                    calories: 452,
                    fat: 25.0,
                    carbs: 51,
                    protein: 4.9,
                    iron: '22%'
                },
                {
                    value: false,
                    name: 'KitKat',
                    calories: 518,
                    fat: 26.0,
                    carbs: 65,
                    protein: 7,
                    iron: '6%'
                }
            ]
        }
    },
    methods: {
        setComingEvents(events) {
            this.events = events
        },
        setEvents(events){
            //this.events  = events

            for(var index in events){
                var endDate = moment(events[index].end_date,'YYYY-MM-DD')
                var now = moment();

                if (now < endDate) {
                    this.events.push(events[index]) 
                } 
            }
        },
    }
}
</script>
