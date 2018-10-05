<template>
<v-app>
    <v-content>
        <v-container fluid>
            <h2>รายการ การขอใช้รถยนต์</h2>
            <v-layout v-for="event in events" :key="`${event}`">
                <v-flex xs12>
                    <h3>{{ moment(event.start_date, 'YYYY-MM-DD').format('DD MMMM YYYY') }}</h3>
                    <v-data-table :headers="headers" :items="events" hide-actions class="elevation-1">
                        <template slot="items" slot-scope="props" v-if="moment(props.item.start_date, 'YYYY-MM-DD').diff(moment(event.start_date, 'YYYY-MM-DD'), 'days') == 0">
                            <td>#{{ props.item.id }}</td>
                            <td class="text-xs-left">{{ moment(props.item.start_time, 'HH:mm:ss').format('HH:mm น.') }}</td>
                            <td class="text-xs-left">
                                {{ props.item.target }}
                                <br/>
                                <br/>
                                <span class="theme--light darken-1 gray--text">
                                    ผู้ขอใช้รถ {{ props.item.creator }}<br/>
                                    ทำรายการ {{ moment(props.item.created_at).format('DD/MM/YYYY HH:mm น.') }}
                                </span>
                            </td>
                            <td class="text-xs-left">
                                {{ moment(props.item.end_date, 'YYYY-MM-DD').format('DD/MM/YYYY') }}<br/>
                                {{ moment(props.item.end_time, 'HH:mm:ss').format('HH:mm น.') }}
                            </td>
                            <td class="text-xs-left">
<v-btn slot="activator" color="primary" dark class="mb-2" @click="editItem(props.item)">พิจารณา</v-btn>
                              <v-dialog v-model="editDialog" max-width="500px">
                                
                                <v-card>
                                  <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                  </v-card-title>

                                  <v-card-text>
                                    <v-container grid-list-md>
                                      <v-layout wrap>
                                        <v-flex xs12 sm6 md4>
                                          <v-text-field v-model="editedItem.name" label="ผู้ขอใช้รถ"></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md4>
                                          <v-text-field v-model="editedItem.calories" label="ตำแหน่ง"></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md4>
                                          <v-text-field v-model="editedItem.fat" label="สังกัด"></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md4>
                                          <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md4>
                                          <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                                        </v-flex>
                                      </v-layout>
                                    </v-container>
                                  </v-card-text>

                                  <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                                    <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                                  </v-card-actions>
                                </v-card>
                              </v-dialog>

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
    data: () => ({
      events:[],
      editDialog: false,
      dialog: false,
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
      desserts: [],
      editedIndex: -1,
      editedItem: {
        creator: {
          id: 0,
          name: name,
          position: null,
          department: null
        },

        start_date: null,
        start_time: null,
        end_date: null,
        end_time: null,
        num_date: '',

        target: '',
        objectives: '',
        province_code: null,

        num_of_companion: '',
        companion: '',
        baggage: '',

        starting_point: ''
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      }
    }),
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      }
    },
    watch: {
      dialog (val) {
        val || this.close()
      }
    },
    created () {
      this.initialize()
    },
    methods: {
        initialize () {
          //http://localhost/car_reservation/public/api/task/waiting/
            
            var uri = './../api/task/waiting/' + moment().format('YYYY-MM-DD')
            axios.get(uri, {
              headers: {
                'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZiZWIxZWNiYWJiYjA4YzI2ODA2MWNkMjY2MjA3MjIwMzYyYTZjYTUwMTY2OTdjMzU1NTk2OTg2NDE4OGM2MTRhYjI5MjUzNDMyN2UxMjExIn0.eyJhdWQiOiIxIiwianRpIjoiNmJlYjFlY2JhYmJiMDhjMjY4MDYxY2QyNjYyMDcyMjAzNjJhNmNhNTAxNjY5N2MzNTU1OTY5ODY0MTg4YzYxNGFiMjkyNTM0MzI3ZTEyMTEiLCJpYXQiOjE1MzMxMTIwODYsIm5iZiI6MTUzMzExMjA4NiwiZXhwIjoxNTY0NjQ4MDg2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Ozhi8umbCkJJaySURq2lHmCyMNfx3vmRmAi-3QUY3ZwBwfFjJo3UTjHcJpi6P6EqxnMs7KDTqNh9hfckt_N9-F8dFjPW3tYiMglzTKQqkPMJXkYROdQnfgxduoIjMfxfFp7wYQ3RC8t15ygSBtB3DhXFoHLOkR5v1EFptomlAJYKgdq1a7q0mnmph-z7uZgEsfqChns6kcFsfsM6VhEuXyjw9FcDsdJKzqp_wwSm9OFV1nleeLwAqiaLaG0WklLECuNsDizLRNuGa9Mn7SCMOgDzyuRui15gorY8KBhXrFEQ_f3-x4afEFgS8yO5IXYseOhUNyNgRIZxDDc6KmSWFG5njipRh9nwcIjBM0d_-LleoICiaCGBgFH-WXEA3dfZF0UNW8hdhPIOSZmi0Jtk8dywx3bEvxxCP1z-u3axe7EqkLFHhtBjdCD83mZayLm60xdEJifHw1KudGE-yDPR9x4QdxsRVRoRhe5QH1aX9jHugw0fnx70KTmeZA0wmjLugqupK31yR2Sws3zgYP-dXW_8cedWQ0azeBQeroXlC6ZMFV028rSqKr_adqLQtK-NblB6kgw2obm5DBl2daXPT3St3cZ8TYYwBFigJg--0ED4i7PxTObFiC5nbuNUQqbVjXGJ9_zhPbX49VQeIIEwO8SfVImkzYBnoaaQpHsQwaY',
                'Accept': 'application/json'
              }
            }).then(response => {
              console.log("debug", response.data.tasks)
              this.events = response.data.tasks
            })
        },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.editDialog = true
      },

      deleteItem (item) {
        const index = this.desserts.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
      },

      close () {
        this.editDialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      }
    }
}
</script>
