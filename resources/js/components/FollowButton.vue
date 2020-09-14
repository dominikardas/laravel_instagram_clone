<template>
    <div>
        <a @click="followUser" v-text="followBtnText" title="Follow User"></a>
    </div>
</template>

<script>
    export default {

        props: ['userId', 'follows'],

        data: function() {
            return {
                status: this.follows
            }
        },

        computed: {
            followBtnText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        },

        methods: {
            followUser() {
                if (this.$store.dispatch('currentUser/followUser', this.userId))
                    this.status = !this.status;
            }
        }

    }
</script>
