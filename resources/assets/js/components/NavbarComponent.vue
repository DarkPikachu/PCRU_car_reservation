<template>
<b-container fluid>
    <!-- Navbar -->
    <b-navbar type="dark" variant="info" toggleable>

        <!-- As a heading -->
        <b-navbar variant="faded" type="light">
            <b-navbar-brand tag="h1" class="mb-0" href="#"> Car Reservation</b-navbar-brand>
        </b-navbar>

        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-collapse is-nav id="nav_collapse">

            <b-navbar-nav></b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
<!--
                <b-nav-form>
                    <b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search"/>
                    <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
                </b-nav-form>
-->
                <b-nav-item-dropdown text="Lang" right>
                    <b-dropdown-item href="#">EN</b-dropdown-item>
                    <b-dropdown-item href="#">ES</b-dropdown-item>
                    <b-dropdown-item href="#">RU</b-dropdown-item>
                    <b-dropdown-item href="#">FA</b-dropdown-item>
                </b-nav-item-dropdown>

                <b-nav-item-dropdown right>
                    <!-- Using button-content slot -->
                    <template slot="button-content">
                    User
                    </template>
                    <b-dropdown-item href="#">Profile</b-dropdown-item>
                    <b-dropdown-item href="#">Signout</b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>

        </b-collapse>
    </b-navbar>
</b-container> 
</template>

<script>
    import { Navbar, Layout } from 'bootstrap-vue/es/components';

    Vue.use(Layout);
    Vue.use(Navbar);

    export default {
        components: {
        },
        mounted() {
            console.log('Component mounted.')
        }

    }
</script>

<style>
.container-fluid {
    padding: 0px;
}
</style>
