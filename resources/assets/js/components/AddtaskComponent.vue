<template>
    <b-container>
        <div>
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                <!-- Form Name -->
                <legend>บันทึกการขอใช้รถ</legend>

                    <b-form-group id="inputGroup0_1"
                                    label="ผู้ขอใช้รถ :"
                                    label-for="inCreatorName">
                        <b-form-input id="inCreatorName"
                                    type="text"
                                    v-model="form.creator.name"
                                    required
                                    placeholder="ผู้ขอใช้รถ">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup0_2"
                                    label="ตำแหน่ง :"
                                    label-for="inCreatorPosition">
                        <b-form-input id="inCreatorPosition"
                                    type="text"
                                    v-model="form.creator.position"
                                    required
                                    placeholder="ตำแหน่ง">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup0_3"
                                    label="สังกัด :"
                                    label-for="inCreatorDepartment">
                        <b-form-input id="inCreatorDepartment"
                                    type="text"
                                    v-model="form.creator.department"
                                    required
                                    placeholder="สังกัด">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup1"
                                    label="สถานที่ไปราชการ :"
                                    label-for="inTarget">
                        <b-form-input id="inTarget"
                                    type="text"
                                    v-model="form.target"
                                    required
                                    placeholder="สถานที่ไปราชการ">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup2"
                                    label="จังหวัดที่ไป :"
                                    label-for="inProvince">
                        <b-form-select id="inProvince"
                                    :options="provinces"
                                    required
                                    v-model="form.province_code">
                        </b-form-select>
                    </b-form-group>

                    <b-form-group id="inputGroup3"
                                    label="วัตถุประสงค์การเดินทาง :"
                                    label-for="inObjectives">
                        <b-form-input id="inObjectives"
                                    type="text"
                                    v-model="form.objectives"
                                    required
                                    placeholder="วัตถุประสงค์การเดินทาง">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup4"
                                    label="ผู้ร่วมเดินทาง :"
                                    label-for="inCompanion">

                    </b-form-group>

                    <b-form-group id="inputGroup5"
                                    label="จำนวนผู้ร่วมเดินทาง :"
                                    label-for="inNumOfCompanion">
                        <b-form-input id="inNumOfCompanion"
                                    type="text"
                                    v-model="form.num_of_companion"
                                    required
                                    placeholder="จำนวนผู้ร่วมเดินทาง">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup6"
                                    label="สัมภาระ/สิ่งของ :"
                                    label-for="inBaggage">
                        <b-form-input id="inBaggage"
                                    type="text"
                                    v-model="form.baggage"
                                    required
                                    placeholder="สัมภาระ/สิ่งของ">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup7"
                                    label="วันที่เดินทางไป :"
                                    label-for="inputStartDate">
                        <b-form-input id="inputStartDate"
                                    type="text"
                                    v-model="form.start_date"
                                    required
                                    placeholder="วันที่เดินทางไป">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup8"
                                    label="วันที่เดินทางกลับ :"
                                    label-for="inputEndDate">
                        <b-form-input id="inputEndDate"
                                    type="text"
                                    v-model="form.end_date"
                                    required
                                    placeholder="วันที่เดินทางกลับ">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="inputGroup9"
                                    label="จุดขึ้นรถ :"
                                    label-for="input7">
                        <b-form-input id="input7"
                                    type="text"
                                    v-model="form.starting_point"
                                    required
                                    placeholder="จุดขึ้นรถ">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="exampleGroup4">
                        <b-form-checkbox-group v-model="form.checked" id="exampleChecks">
                            <b-form-checkbox value="me">Check me out</b-form-checkbox>
                            <b-form-checkbox value="that">Check that out</b-form-checkbox>
                        </b-form-checkbox-group>
                    </b-form-group>

                    <b-button type="submit" variant="primary">Submit</b-button>
                    <b-button type="reset" variant="danger">Reset</b-button>

            </b-form>
        </div>
    </b-container>
</template>

<script>
    import { Form, FormGroup, FormInput, FormSelect, FormTextarea, FormCheckbox, Button} from 'bootstrap-vue/es/components';

    Vue.use(Form);
    Vue.use(FormGroup);
    Vue.use(FormInput);
    Vue.use(FormSelect);
    Vue.use(FormTextarea);
    Vue.use(FormCheckbox);
    Vue.use(Button);

    export default {
        data() {
            return {
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
                    province_code: '',

                    num_of_companion: '',
                    companion: '',
                    baggage: '',

                    starting_point: ''
                },
                blank_form: {},
                provinces: [
                    { text: 'Select One', value: null },
                    'Carrots', 'Beans', 'Tomatoes', 'Corn'
                ],
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