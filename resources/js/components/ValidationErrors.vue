<template>
    <Fragment>
        <div v-if="errors">
            <ul>
                <li v-for="(value, key, index) in errors" v-bind:key="key">{{ value }}</li>
            </ul>
        </div>
    </Fragment>
</template>

<script>

    import { Fragment } from 'vue-fragment';

    export default {        
        props: ['errors'],

        components: {
            Fragment
        }
    }

</script>