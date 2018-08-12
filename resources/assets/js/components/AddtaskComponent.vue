<template>
    <b-container>
        <div>
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                <b-form-group id="exampleInputGroup1"
                                label="Email address:"
                                label-for="exampleInput1"
                                description="We'll never share your email with anyone else.">
                    <b-form-input id="exampleInput1"
                                type="email"
                                v-model="form.email"
                                required
                                placeholder="Enter email">
                    </b-form-input>
                </b-form-group>
                <b-form-group id="exampleInputGroup2"
                                label="ผู้ขอใช้รถยนต์ :"
                                label-for="exampleInput2">
                    <b-form-input id="exampleInput2"
                                type="text"
                                v-model="form.name"
                                required
                                placeholder="Enter name">
                    </b-form-input>
                </b-form-group>
                <b-form-group id="exampleInputGroup3"
                                label="Food:"
                                label-for="exampleInput3">
                    <b-form-select id="exampleInput3"
                                :options="foods"
                                required
                                v-model="form.food">
                    </b-form-select>
                </b-form-group>
                <b-form-group id="exampleInputGroup2"
                                label="จุดขึ้นรถ :"
                                label-for="exampleInput5">
                    <b-form-input id="exampleInput5"
                                type="text"
                                v-model="form.name"
                                required
                                placeholder="Enter name">
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
                    email: '',
                    name: '',
                    food: null,
                    checked: [],
                    start_date:'',
                    start_time:'',
                    end_date:'',
                    end_time:'',
                    num_date:'',

                    target:'',
                    objectives:'',
                    province_code:'',

                    num_of_companion:'',
                    companion:'',
                    baggage:'',

                    starting_point:''
                },
                foods: [
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
            },
            onReset (evt) {
                evt.preventDefault();
                /* Reset our form values */
                this.form.email = '';
                this.form.name = '';
                this.form.food = null;
                this.form.checked = [];
                /* Trick to reset/clear native browser form validation state */
                this.show = false;
                this.$nextTick(() => { this.show = true });
            }
        }
    }
</script>