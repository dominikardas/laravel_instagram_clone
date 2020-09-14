<template>
    <div class="l-post-comment">
        <img class="l-profile-image__preview" :src="comment.profileImage" alt="">
        <div class="l-comment">
            <div class="l-comment-content">
                <span><b>{{ comment.username }}</b></span>
                <span>{{ comment.content }}</span>
            </div>
            <div class="l-comment-actions">
                <a @click.prevent="setCommentAsReply(comment.id, comment.username, comment.content)" class="link">Reply</a>
                <a v-if="comment.replies[0].length > 0" @click.prevent="showCommentReplies" class="link link-replies">
                    {{ repliesText }}
                    {{ !showReplies ? '(' + comment.replies[0].length + ')' : '' }}
                </a>
            </div>
            <div v-if="comment.replies[0].length > 0" class="l-comment-replies" :class="{ 'show-replies': showReplies }">                
                <Fragment v-for="reply in comment.replies[0]" v-bind:key="reply.id">
                    <Comment :comment="reply"></Comment>
                </Fragment>
            </div>
        </div>
    </div>
</template>

<script>

    import { Fragment } from 'vue-fragment';

    export default {

        props: ['comment'],

        components: {
            Fragment, Comment
        },

        data: () => ({
            showReplies: false,
        }),

        computed: {
            repliesText() {
                return this.showReplies ? 'Hide Replies' : 'Show Replies';
            }
        },

        methods: {
            setCommentAsReply(parent_id, username, content) {
                this.$parent.setCommentAsReply(parent_id, username, content);
            },

            showCommentReplies(event) {
                this.showReplies = !this.showReplies;
            }
        }
    }
</script>