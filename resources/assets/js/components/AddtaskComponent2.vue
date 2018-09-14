<template>
   <v-app id="inspire">
    <v-card
      color="blue-grey darken-1"
      dark
    >
      <v-img
        height="200"
        src="https://cdn.vuetifyjs.com/images/cards/dark-beach.jpg"
      >
        <v-layout wrap>
          <v-flex xs12>
            <v-progress-linear
              :active="isUpdating"
              class="ma-0"
              color="green lighten-3"
              height="4"
              indeterminate
            ></v-progress-linear>
          </v-flex>
          <v-flex
            text-xs-right
            xs12
          >
            <v-menu
              bottom
              left
              transition="slide-y-transition"
            >
              <v-btn
                slot="activator"
                icon
              >
                <v-icon>more_vert</v-icon>
              </v-btn>
              <v-list>
                <v-list-tile @click="isUpdating = true">
                  <v-list-tile-action>
                    <v-icon>mdi-settings</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>Update</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-menu>
          </v-flex>
          <v-layout
            align-start
            column
            justify-end
            pa-3
          >
            <h3 class="headline">{{ name }}</h3>
            <span class="grey--text text--lighten-1">{{ title }}</span>
          </v-layout>
        </v-layout>
      </v-img>
      <v-form>
        <v-container>
          <v-layout wrap>
            <v-flex xs12 md6>
              <v-text-field
                v-model="name"
                :disabled="isUpdating"
                box
                color="blue-grey lighten-2"
                label="Name"
              ></v-text-field>
            </v-flex>
            <v-flex xs12 md6>
              <v-text-field
                v-model="title"
                :disabled="isUpdating"
                box
                color="blue-grey lighten-2"
                label="Title"
              ></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-autocomplete
                v-model="friends"
                :disabled="isUpdating"
                :items="people"
                box
                chips
                color="blue-grey lighten-2"
                label="Select"
                item-text="name"
                item-value="name"
                multiple
              >
                <template
                  slot="selection"
                  slot-scope="data"
                >
                  <v-chip
                    :selected="data.selected"
                    close
                    class="chip--select-multi"
                    @input="remove(data.item)"
                  >
                    <v-avatar>
                      <img :src="data.item.avatar">
                    </v-avatar>
                    {{ data.item.name }}
                  </v-chip>
                </template>
                <template
                  slot="item"
                  slot-scope="data"
                >
                  <template v-if="typeof data.item !== 'object'">
                    <v-list-tile-content v-text="data.item"></v-list-tile-content>
                  </template>
                  <template v-else>
                    <v-list-tile-avatar>
                      <img :src="data.item.avatar">
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                      <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
                      <v-list-tile-sub-title v-html="data.item.group"></v-list-tile-sub-title>
                    </v-list-tile-content>
                  </template>
                </template>
              </v-autocomplete>
            </v-flex>
          </v-layout>
        </v-container>
      </v-form>
    </v-card>
  </v-app>
</template>

<script>

    Vue.component('companion-component', require('./CompanionListComponent.vue'));

    import { Form, FormGroup, FormInput, FormSelect, FormTextarea, FormCheckbox, Button } from 'bootstrap-vue/es/components'
    import { VueFlatpickr } from 'vue-flatpickr'
    //import 'vue-flatpickr/theme/airbnb.css'
    import Vuetify from 'vuetify'
    import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
    // index.js or main.js
    import 'material-design-icons-iconfont/dist/material-design-icons.css' 

 
    Vue.use(Vuetify)

    Vue.use(Form)
    Vue.use(FormGroup)
    Vue.use(FormInput)
    Vue.use(FormSelect)
    Vue.use(FormTextarea)
    Vue.use(FormCheckbox)
    Vue.use(Button)

    //Vue.use(VueFlatpickr)

    export default {
    data () {
      let srcs = {
        1: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
        2: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
        3: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
        4: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
        5: 'https://cdn.vuetifyjs.com/images/lists/5.jpg'
      }

      return {
        autoUpdate: true,
        friends: ['นางใกล้รุ่ง เกตวันดี', 'นางสาว'],
        isUpdating: false,
        name: 'Midnight Crew',
        people: [
          { header: 'กองนโยบายและแผน' },
          { name: 'นางใกล้รุ่ง เกตวันดี', group: 'กองนโยบายและแผน', avatar: srcs[1] },
          { name: 'Ali Connors', group: 'กองนโยบายและแผน', avatar: srcs[2] },
          { name: 'Trevor Hansen', group: 'กองนโยบายและแผน', avatar: srcs[3] },
          { name: 'Tucker Smith', group: 'กองนโยบายและแผน', avatar: srcs[2] },
          { divider: true },
          { header: 'Group 2' },
          { name: 'Britta Holt', group: 'Group 2', avatar: srcs[4] },
          { name: 'Jane Smith ', group: 'Group 2', avatar: srcs[5] },
          { name: 'John Smith', group: 'Group 2', avatar: srcs[1] },
          { name: 'Sandra Williams', group: 'Group 2', avatar: srcs[3] }
        ],
        title: 'The summer breeze'
      }
    },

    watch: {
      isUpdating (val) {
        if (val) {
          setTimeout(() => (this.isUpdating = false), 3000)
        }
      }
    },

    methods: {
      remove (item) {
        const index = this.friends.indexOf(item.name)
        if (index >= 0) this.friends.splice(index, 1)
      }
    }
  }
</script>