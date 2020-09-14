<template>
    <Fragment>
        <div class="c-post-container" v-if="!this.loading">
            <div class="l-post-image">
                <span><img :src="'/storage/' + this.post.data.post.image" alt=""></span>
            </div>
            <div class="l-post-desc">
                <div class="l-post-author">
                    <span class="l-author-image">
                        <img class="l-profile-image__preview" :src="this.post.data.author.profileImage" alt="">
                    </span>
                    <span class="dot-separator"></span>
                    <span class="l-author-username">
                        <a :href="'/profile/' + this.post.data.author.id"><b>{{ this.post.data.author.username }}</b></a>
                    </span>
                    <span class="dot-separator" v-if="this.loggedIn"></span>
                    <FollowButton class="link" :user-id="this.post.data.author.id" :follows="this.post.data.isFollowingUser" v-if="this.loggedIn"></FollowButton>
                </div>
                <span class="line-separator"></span>
                <div class="l-post-description">
                    <span>{{ this.post.data.post.description }}</span>
                </div>
                <span class="line-separator"></span>
                <div class="l-post-comments">
                    <div v-if="this.post.data.comments[0].length > 0">
                        <div v-for="comment in this.post.data.comments[0]" v-bind:key="comment.id">
                            <Comment :comment="comment"></Comment>
                        </div>
                    </div>
                    <div v-else class="l-post-comment">
                        <div class="l-comment">
                            <b><p style="text-align: center">No comments yet.<br>Be the first one to submit a comment!</p></b>
                        </div>
                    </div>
                </div>
                <span class="line-separator"></span>
                <div class="l-post-likes">
                    <div class="l-post-options">
                        <div>
                            <LikeButton v-if="loggedIn" :post-id="this.post.data.post.id" :isLiked="this.post.data.isLiked"></LikeButton>
                            <!-- <span class="icon-comment"></span>
                            <span class="icon-favorite"></span> -->
                        </div>
                        <!-- @can('update', $post->user->profile)
                            <div>
                                <span class="icon-delete" title="Delete Post"></span>
                            </div>
                        @endcan -->
                    </div>
                    <div class="l-post-info">
                        <span><b>{{ this.post.data.post.likes }} {{ this.post.data.post.likes === 1 ? 'like' : 'likes' }}</b></span>
                        <span>{{ formatDate(this.post.data.post.created_at) }}</span>
                    </div>
                </div>
                <span class="line-separator"></span>
                <div class="l-post_new-comment">
                    <form @submit.prevent="submitComment">
                        <span class="l-post_comment-reply">{{ this.comment.reply }}</span>
                        <input v-model="comment.parent_id" id="parent_id" name="parent_id" type="hidden" value="null"> 
                        <input v-model="comment.content" id="comment" name="comment" type="text" placeholder="Add a comment..." required>
                        <button type="submit" class="hidden">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </Fragment>
</template>

<script>

    import { Fragment } from 'vue-fragment';

    import moment from 'moment';

    import FollowButton from '../FollowButton';
    import LikeButton from '../LikeButton';

    import Comment from '../Comment';

    export default {

        props: ['postId'],

        components: {
            Fragment, FollowButton, LikeButton, Comment
        },

        data: () => ({
            comment: {
                reply: null,
                content: null,
                parent_id: null
            }
        }),

        computed: {
            loading: {
                get() {
                    return this.$store.state.posts.loading
                }
            },
            loggedIn: {
                get() {
                    return this.$store.state.currentUser.user.isAuthenticated;
                }
            },
            currentUser: {
                get() {
                    return this.$store.state.currentUser.user.data;
                }
            },
            post: {
                get() {
                    return this.$store.state.posts.currentPost;
                }
            }
        },

        mounted() {
            console.log('[vue] Post Mounted');
        },

        created() {
            this.$store.dispatch('posts/getPostById', this.postId);
        },

        methods: {

            formatDate(date) {
                return moment(date).startOf('seconds').fromNow();
            },

            submitComment() {
                this.$store.dispatch('posts/submitComment', {
                    comment: this.comment,
                    postId: this.postId
                });

                this.comment.parent_id = null;
                this.comment.content = '';
                this.comment.reply = '';
            },
            
            setCommentAsReply(parent_id, user, content) {
                this.comment.parent_id = parent_id;
                this.comment.reply = 'Replying to @' + user + ' - ' + content;
            }
        }
    }
</script>