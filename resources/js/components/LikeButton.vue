<template>
    <div>
        <a title="Like Post" @click="likePost">
            <span v-bind:class="postClass"></span>
        </a>
    </div>
</template>

<script>
    export default {

        props: ['postId', 'isLiked'],

        data: function() {
            return {
                status: this.isLiked
            }
        },

        computed: {     
            postClass() {
                return (this.status) ? 'icon-liked' : 'icon-like';
            }
        },

        methods: {
            likePost() {
                if (this.$store.dispatch('posts/likePost', this.postId))
                    this.status = !this.status;
            }
        }        
    }
</script>