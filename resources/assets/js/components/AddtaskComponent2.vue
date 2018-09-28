<template>
   <v-app id="inspire">
    <v-card>
      <v-card-title class="headline font-weight-regular blue-grey white--text">เพิ่มรายการจองรถ</v-card-title>
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-container>
          <v-layout wrap>
            <v-flex xs12 md6>
              <v-text-field
                v-model="form.creator.name"
                :disabled="isUpdating"
                :rules="validate.creator"
                box
                color="blue-grey lighten-2"
                label="ผู้ขอใช้รถ"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md6>
              <v-text-field
                v-model="form.creator.position"
                :disabled="isUpdating"
                :rules="validate.creator"
                box
                color="blue-grey lighten-2"
                label="ตำแหน่ง"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md12>
              <v-text-field
                v-model="form.creator.department"
                :disabled="isUpdating"
                :rules="validate.creator"
                box
                color="blue-grey lighten-2"
                label="สังกัด"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md6>
              <v-text-field
                v-model="form.target"
                :disabled="isUpdating"
                :rules="validate.creator"
                box
                color="blue-grey lighten-2"
                label="สถานที่ไปราชการ"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 sm6 d-flex>
              <v-select
                v-model="form.province_code"
                :items="provinces_options"
                :rules="validate.required"
                box
                item-value="province_code"
                item-text="province_name"
                label="จังหวัดที่ไป"
              ></v-select>
            </v-flex>

            <v-flex xs12 md12>
              <v-text-field
                v-model="form.objectives"
                :disabled="isUpdating"
                :rules="validate.creator"
                box
                color="blue-grey lighten-2"
                label="วัตถุประสงค์การเดินทาง"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md12>
              <b-form-group id="inputGroup4"
                          label="รายชื่อผู้ร่วมเดินทาง :"
                          label-for="inCompanion">
                  <companion-component ref="companion"></companion-component>
              </b-form-group>
            </v-flex>

            <v-flex xs12 md6>
              <v-text-field
                v-model="form.num_of_companion"
                :disabled="isUpdating"
                :rules="validate.required"
                box
                color="blue-grey lighten-2"
                label="จำนวนผู้ร่วมเดินทาง"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md12>
              <v-text-field
                v-model="form.baggage"
                :disabled="isUpdating"
                :rules="validate.required"
                box
                color="blue-grey lighten-2"
                label="สัมภาระ/สิ่งของ"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md6>
              <v-text-field
                v-model="form.start_date"
                :disabled="isUpdating"
                :rules="validate.required"
                box
                color="blue-grey lighten-2"
                label="วันที่เดินทางไป"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md6>
              <v-text-field
                v-model="form.start_time"
                :disabled="isUpdating"
                :rules="validate.required"
                box
                color="blue-grey lighten-2"
                label="เวลาที่ออกเดินทาง"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md6>
              <v-text-field
                v-model="form.end_date"
                :disabled="isUpdating"
                :rules="validate.required"
                box
                color="blue-grey lighten-2"
                label="วันที่เดินทางกลับ"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 md6>
              <v-text-field
                v-model="form.end_time"
                :disabled="isUpdating"
                :rules="validate.required"
                box
                color="blue-grey lighten-2"
                label="เวลาที่กลับมาถึง"
              ></v-text-field>
            </v-flex>

            <v-flex xs12>
              <v-text-field
                v-model="form.starting_point"
                :disabled="isUpdating"
                :rules="validate.required"
                box
                color="blue-grey lighten-2"
                label="จุดขึ้นรถ"
              ></v-text-field>
            </v-flex>

            <v-flex xs12 v-show="false">
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

            <v-btn
              :disabled="!valid"
              @click="submit"
            >
              submit
            </v-btn>

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
      props: {
            provinces: String
      },
      data: function() {
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
          title: 'The summer breeze',

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
          valid: true,
          validate: {
            required: [
              (v) => !!v || 'required',
            ],
            creator: [
              (v) => !!v || 'required',
              (v) => v && v.length > 1 || 'must be more than 10 characters'
            ],
            province: [
              (v) => !!v || 'required',
            ],
          },
          blank_form: {},
          provinces_options: JSON.parse(this.provinces),
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
        /*remove (item) {
          const index = this.friends.indexOf(item.name)
          if (index >= 0) this.friends.splice(index, 1)
        },*/
        submit () {
          console.log(this.form)

          if (!this.$refs.form.validate()) {
            // Native form submission is not yet supported
            /*axios.post('/api/submit', {
              name: this.name,
              email: this.email,
              select: this.select,
              checkbox: this.checkbox
            })*/
            //JSON.stringify();

            //Get diff date
            var start = moment(this.form.start_date); //start date
            var end = moment(this.form.end_date); // end date
            var duration = moment.duration(end.diff(start))
            var days = duration.asDays()
            this.form.num_date = days

            //Get companion name
            var companionName = ''
            var persons = this.$refs.companion.todos
            for(var i=0; i<persons.length; i++){
              companionName += persons[i].title
              if(persons.length != (i+1))
                companionName += "/"
            }
            this.form.companion = companionName

            axios.post('./../api/managetask', {
                start_date: this.form.start_date,
                start_time: this.form.start_time,
                end_date: this.form.end_date,
                end_time: this.form.end_time,
                num_date: this.form.num_date,

                target: this.form.target,
                objectives: this.form.objectives,
                province_code: this.form.province_code,

                num_of_companion: this.form.num_of_companion,
                companion: this.form.companion,
                baggage: this.form.baggage,

                starting_point: this.form.starting_point,
              },
              {
                headers: { 
                  Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZiZWIxZWNiYWJiYjA4YzI2ODA2MWNkMjY2MjA3MjIwMzYyYTZjYTUwMTY2OTdjMzU1NTk2OTg2NDE4OGM2MTRhYjI5MjUzNDMyN2UxMjExIn0.eyJhdWQiOiIxIiwianRpIjoiNmJlYjFlY2JhYmJiMDhjMjY4MDYxY2QyNjYyMDcyMjAzNjJhNmNhNTAxNjY5N2MzNTU1OTY5ODY0MTg4YzYxNGFiMjkyNTM0MzI3ZTEyMTEiLCJpYXQiOjE1MzMxMTIwODYsIm5iZiI6MTUzMzExMjA4NiwiZXhwIjoxNTY0NjQ4MDg2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Ozhi8umbCkJJaySURq2lHmCyMNfx3vmRmAi-3QUY3ZwBwfFjJo3UTjHcJpi6P6EqxnMs7KDTqNh9hfckt_N9-F8dFjPW3tYiMglzTKQqkPMJXkYROdQnfgxduoIjMfxfFp7wYQ3RC8t15ygSBtB3DhXFoHLOkR5v1EFptomlAJYKgdq1a7q0mnmph-z7uZgEsfqChns6kcFsfsM6VhEuXyjw9FcDsdJKzqp_wwSm9OFV1nleeLwAqiaLaG0WklLECuNsDizLRNuGa9Mn7SCMOgDzyuRui15gorY8KBhXrFEQ_f3-x4afEFgS8yO5IXYseOhUNyNgRIZxDDc6KmSWFG5njipRh9nwcIjBM0d_-LleoICiaCGBgFH-WXEA3dfZF0UNW8hdhPIOSZmi0Jtk8dywx3bEvxxCP1z-u3axe7EqkLFHhtBjdCD83mZayLm60xdEJifHw1KudGE-yDPR9x4QdxsRVRoRhe5QH1aX9jHugw0fnx70KTmeZA0wmjLugqupK31yR2Sws3zgYP-dXW_8cedWQ0azeBQeroXlC6ZMFV028rSqKr_adqLQtK-NblB6kgw2obm5DBl2daXPT3St3cZ8TYYwBFigJg--0ED4i7PxTObFiC5nbuNUQqbVjXGJ9_zhPbX49VQeIIEwO8SfVImkzYBnoaaQpHsQwaY',
                  Accept: 'application/json'
                }
              }
            ).then(response => {
              console.log(response)
            }).catch(e => {
              alert(e)
            })
          }
        },
        clear () {
          this.$refs.form.reset()
        }
      },

      created(){
        this.blank_form = this.form;
      }
  }
</script>