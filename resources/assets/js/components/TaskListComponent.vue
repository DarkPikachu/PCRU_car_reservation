<template>
    <v-app>
        <v-content>
            <v-container fluid>
                <h3>รายการ การขอใช้รถยนต์</h3>
                <v-layout>
                    <v-flex xs6 offset-xs3>
                        <v-list>
                            <v-list-tile avatar>
                            <v-list-tile-action class="album-verwerkt">
                                <v-icon class="pink--text">star</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>Text</v-list-tile-title>
                                <v-list-tile-sub-title>Title</v-list-tile-sub-title>
                            </v-list-tile-content>
                            <v-list-tile-action>
                                <v-btn icon ripple>
                                <v-icon class="grey--text text--lighten-1">file_download</v-icon>
                                </v-btn>
                            </v-list-tile-action>
                            <v-list-tile-action>
                                <v-btn icon>
                                <v-icon class="grey--text text--lighten-1">delete</v-icon>
                                </v-btn>
                            </v-list-tile-action>
                            </v-list-tile>
                        </v-list>
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

    Vue.use(VueRouter)
    Vue.use(Vuetify)

    export default {
        datas(){
            return{
                events:[],
            }
        },
        methods: {
            setComingEvents(events) {
                this.events = events
            }
        }
    }
</script>
