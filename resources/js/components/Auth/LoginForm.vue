<template>
    <Fragment>
        <div class="c-form-container c-form-auth-container">
            <div class="l-form-header">
                Login
            </div>
            <form class="l-auth-form">

                <div class="l-form_row">
                    <Fragment v-if="errors">
                        <Fragment v-if="errors.email">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors.email[0] }}</strong>
                            </span>
                        </Fragment>
                        <Fragment v-else></Fragment>
                    </Fragment>
                    <input v-model="user.email" :class="(errors && errors.email) ? 'is-invalid' : ''" id="email" type="email" name="email" placeholder="E-mail address" autocomplete="email" autofocus>
                </div>

                <div class="l-form_row">                    
                    <Fragment v-if="errors">
                        <Fragment v-if="errors.email">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ errors.password[0] }}</strong>
                            </span>
                        </Fragment>
                        <Fragment v-else></Fragment>
                    </Fragment>
                    <input v-model="user.password" :class="(errors && errors.password) ? 'is-invalid' : ''" id="password" type="password" name="password" placeholder="Password">
                </div>

                <div class="l-form_row">            
                    <button @click.prevent="login" type="submit" class="btn btn-primary">Log In</button>
                    <span class="line-through">OR</span>
                    <a class="btn btn-link center">Forgot password?</a>
                </div>

            </form>
        </div>
        <div class="c-form-container c-form-auth-container">
            <span>Don't have an account? <a class="link" href="/register">Sign up</a></span>
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
                email: '',
                password: ''
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
            login() {
                this.$store.dispatch('currentUser/loginUser', this.user);
            }
        }
    }
</script>