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
      <v-divider></v-divider>
      <v-card-actions>
        <v-switch
          v-model="autoUpdate"
          :disabled="isUpdating"
          class="mt-0"
          color="green lighten-2"
          hide-details
          label="Auto Update"
        ></v-switch>
        <v-spacer></v-spacer>
        <v-btn
          :disabled="autoUpdate"
          :loading="isUpdating"
          color="blue-grey darken-3"
          depressed
          @click="isUpdating = true"
        >
          <v-icon left>mdi-update</v-icon>
          Update Now
        </v-btn>
      </v-card-actions>
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
        props: {
            provinces: String
        },
        data() {
            return {
                fpOptions: {},
                dateStart:'',
                form: {
                    checked:'',

                    creator: {
                        name: '',
                        position: '',
                        department: ''
                    },

                    start_date: '',
                    start_time: '',
                    end_date: '',
                    end_time: '',
                    num_date: '',

                    target: '',
                    objectives: '',
                    province_code: null,

                    num_of_companion: '',
                    companion: '',
                    baggage: '',

                    starting_point: ''
                },
                blank_form: {},
                provinces_options: JSON.parse(this.provinces),
                show: true
            }
        },
        methods: {
            onSubmit (evt) {
                evt.preventDefault();
                alert(JSON.stringify(this.form));

                var uri = '../../api/managetask'
                axios.post(uri, {
                    headers: {
                        'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZiZWIxZWNiYWJiYjA4YzI2ODA2MWNkMjY2MjA3MjIwMzYyYTZjYTUwMTY2OTdjMzU1NTk2OTg2NDE4OGM2MTRhYjI5MjUzNDMyN2UxMjExIn0.eyJhdWQiOiIxIiwianRpIjoiNmJlYjFlY2JhYmJiMDhjMjY4MDYxY2QyNjYyMDcyMjAzNjJhNmNhNTAxNjY5N2MzNTU1OTY5ODY0MTg4YzYxNGFiMjkyNTM0MzI3ZTEyMTEiLCJpYXQiOjE1MzMxMTIwODYsIm5iZiI6MTUzMzExMjA4NiwiZXhwIjoxNTY0NjQ4MDg2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Ozhi8umbCkJJaySURq2lHmCyMNfx3vmRmAi-3QUY3ZwBwfFjJo3UTjHcJpi6P6EqxnMs7KDTqNh9hfckt_N9-F8dFjPW3tYiMglzTKQqkPMJXkYROdQnfgxduoIjMfxfFp7wYQ3RC8t15ygSBtB3DhXFoHLOkR5v1EFptomlAJYKgdq1a7q0mnmph-z7uZgEsfqChns6kcFsfsM6VhEuXyjw9FcDsdJKzqp_wwSm9OFV1nleeLwAqiaLaG0WklLECuNsDizLRNuGa9Mn7SCMOgDzyuRui15gorY8KBhXrFEQ_f3-x4afEFgS8yO5IXYseOhUNyNgRIZxDDc6KmSWFG5njipRh9nwcIjBM0d_-LleoICiaCGBgFH-WXEA3dfZF0UNW8hdhPIOSZmi0Jtk8dywx3bEvxxCP1z-u3axe7EqkLFHhtBjdCD83mZayLm60xdEJifHw1KudGE-yDPR9x4QdxsRVRoRhe5QH1aX9jHugw0fnx70KTmeZA0wmjLugqupK31yR2Sws3zgYP-dXW_8cedWQ0azeBQeroXlC6ZMFV028rSqKr_adqLQtK-NblB6kgw2obm5DBl2daXPT3St3cZ8TYYwBFigJg--0ED4i7PxTObFiC5nbuNUQqbVjXGJ9_zhPbX49VQeIIEwO8SfVImkzYBnoaaQpHsQwaY',
                        'Accept': 'application/json'
                    },
                    data: this.form
                }).then(response => {
                    console.log("debug", response.data)
                    this.results = response.data.tasks

                   
                }).catch(function (error) {
                    console.log(error);
                });                                
            },
            onReset (evt) {
                evt.preventDefault();
                /* Reset our form values */
                /*this.form.email = '';
                this.form.name = '';
                this.form.food = null;
                this.form.checked = [];*/
                this.form = this.blank_form;

                /* Trick to reset/clear native browser form validation state */
                this.show = false;
                this.$nextTick(() => { this.show = true });
            }
        },
        created(){
            this.blank_form = this.form;
        }
    }
</script>