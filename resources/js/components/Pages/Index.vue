<template>
    <Fragment>
        <div v-if="this.loggedIn">
            <div v-if="this.posts.length > 0">
                <div class="c-post-container c-post-container-index" v-for="item in this.posts" v-bind:key="item.post.id">
                    <div class="l-post-author">
                        <span class="l-author-image">
                            <img class="l-profile-image__preview" :src="item.author.profileImage" alt="">
                        </span>
                        <span class="dot-separator"></span>
                        <span class="l-author-username">
                            <a :href="'/profile/' + item.author.profile_id"><b>{{ item.author.username }}</b></a>
                        </span>
                    </div>
                    <div class="l-post-image">
                        <a :href="'/p/' + item.post.id">
                            <span><img :src="'/storage/' + item.post.image" alt=""></span>
                        </a>
                    </div>
                    <div class="l-post-desc">
                        <div class="l-post-description">
                            <span>{{ item.post.description }}</span>
                        </div>
                        <span class="line-separator"></span>
                        <div class="l-post-likes">
                            <div class="l-post-options">
                                <like-button v-if="loggedIn" :post-id="item.post.id" :isLiked="item.isLiked"></like-button>
                                <!-- @can('update', $post->user->profile)
                                    <div>
                                        <span class="icon-delete" title="Delete Post"></span>
                                    </div>
                                @endcan -->
                            </div>
                            <div class="l-post-info">
                                <span><b>{{ item.post.likes }} {{ item.post.likes === 1 ? 'like' : 'likes' }}</b></span>
                                <span>{{ formatDate(item.post.created_at) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <p>No posts</p>
            </div>
        </div>
        <div v-else>
            <div class="l-index_login">
                Welcome
            </div>
        </div>
    </Fragment>
</template>

<script>

    import { Fragment } from 'vue-fragment';
    import moment from 'moment';    

    export default {

        components: {
            Fragment
        },

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
            posts: {
                get() {
                    return this.$store.state.posts.posts;
                }
            }
        },

        mounted() {
            console.log('[vue] Index Mounted');
        },

        created() {
            this.$store.dispatch('posts/getPosts');
        },

        methods: {
            formatDate(date) {
                return moment(date).startOf('seconds').fromNow();
            }
        }
    }
</script>