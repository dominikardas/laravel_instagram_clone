<template>
    <Fragment>
        <div class="c-form-container c-form-auth-container">
            <div class="l-form-header">
                Sign Up
            </div>
            <form class="l-auth-form">

                <div class="l-form_row">
                    <Fragment v-if="errors">
                        <Fragment v-if="errors.username">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors.username[0] }}</strong>
                            </span>
                        </Fragment>
                        <Fragment v-else></Fragment>
                    </Fragment>
                    <input v-model="user.username" :class="(errors && errors.username) ? 'is-invalid' : ''" id="username" type="text" name="username" placeholder="Username" autocomplete="username" autofocus>
                </div>

                <div class="l-form_row">
                    <Fragment v-if="errors">
                        <Fragment v-if="errors.name">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors.name[0] }}</strong>
                            </span>
                        </Fragment>
                        <Fragment v-else></Fragment>
                    </Fragment>
                    <input v-model="user.name" :class="(errors && errors.name) ? 'is-invalid' : ''" id="name" type="text" name="name" placeholder="Full Name" autocomplete="name">
                </div>

                <div class="l-form_row">
                    <Fragment v-if="errors">
                        <Fragment v-if="errors.email">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors.email[0] }}</strong>
                            </span>
                        </Fragment>
                        <Fragment v-else></Fragment>
                    </Fragment>
                    <input v-model="user.email" :class="(errors && errors.email) ? 'is-invalid' : ''" id="email" type="email" name="email" placeholder="E-mail address" autocomplete="email">
                </div>

                <div class="l-form_row">                    
                    <Fragment v-if="errors">
                        <Fragment v-if="errors.password">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors.password[0] }}</strong>
                            </span>
                        </Fragment>
                        <Fragment v-else></Fragment>
                    </Fragment>
                    <input v-model="user.password" :class="(errors && errors.password) ? 'is-invalid' : ''" id="password" type="password" name="password" placeholder="Password">
                </div>

                <div class="l-form_row">
                    <input v-model="user.password_confirmation" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
                </div>

                <div class="l-form_row">            
                    <button @click.prevent="register" type="submit" class="btn btn-primary">Register</button>
                </div>

            </form>
        </div>
        <div class="c-form-container c-form-auth-container">
            <span>Have an account? <a class="link" href="/login">Log In</a></span>
        </div>
    </Fragment>
</template>

<script>

    import { Fragment } from 'vue-fragment';

    import ValidationErrors from '../ValidationErrors';

    export default {

        components: {
            Fragment, ValidationErrors
        },

        data: () => ({
            user: {
                username: '',
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }),

        computed: {
            errors: {
                get() {
                    return this.$store.state.currentUser.errors;
                }
            }
        },
        
        methods: {
            register() {
                this.$store.dispatch('currentUser/registerUser', this.user);
            }
        }
    }
</script>