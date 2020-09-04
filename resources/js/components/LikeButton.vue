<template>
    <div>
        <a title="Like Post" @click="likePost">
            <span v-bind:class="postClass"></span>
        </a>
    </div>
</template>

<script>
    export default {

        props: ['postId', 'liked'],

        mounted: function() {
            console.log('[vue] LikeButton mounted');
        },

        data: function() {
            return {
                status: this.liked
            }
        },

        methods: {
            likePost() {
                axios.post('/like/' + this.postId)
                    .then(res => {this.status = !this.status; console.log(res)});
            }
        },

        computed: {
            postClass() {
                return (this.status) ? 'icon-liked' : 'icon-like';
            }
        }

        
    }
</script>