<template>
    <div>
        <a @click="followUser" v-text="followBtnText" title="Follow User"></a>
    </div>
</template>

<script>
    export default {

        props: ['userId', 'follows'],
        
        mounted() {
            console.log('[vue] FollowButton mounted');
        },

        data: function() {
            return {
                status: this.follows
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)
                    .then(res => {this.status = !this.status; console.log(res.data)});
            }
        },

        computed: {
            followBtnText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }

    }
</script>
