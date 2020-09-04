<template>
    <div>
        <a href="#" @click="followUser" v-text="followBtnText"></a>
    </div>
</template>

<script>
    export default {

        props: ['userId', 'follows'],
        
        mounted() {
            console.log('[vue] FollowButton mounted.');
        },

        data: function() {
            return {
                status: this.follows
            }
        },

        methods: {
            followUser() {
                axios.post('/follows/' + this.userId)
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
