<template>
  <Fragment>
  </Fragment>
</template>

<script>

    import { Fragment } from 'vue-fragment';

    export default {

        mounted() {
            console.log('[vue] AppContainer mounted');
        },

        created() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
            // axios.defaults.headers.common['Accept'] = 'application/json';
            this.$store.dispatch('currentUser/getUser'); 
        }
    }
</script>