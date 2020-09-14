import axios from 'axios';

const state = {
    posts: null,
    currentPost: null,
    loading: false
};
const getters = {

};
const actions = {

    getPosts({commit}) {

        state.loading = true;

        axios
            .get('/api/posts/following')
            .then(res => {
                console.log(res.data);
                commit('setPosts', res.data.data);
            });
    },

    getPostById({commit}, postId) {

        state.loading = true;

        axios
            .get('/api/posts/' + postId)
            .then(res => {
                // console.log(res.data);
                commit('saveCurrentPost', res.data);
            });
    },

    likePost({commit}, postId) {
        console.log(postId);
        axios
            .post('/api/posts/' + postId + '/like')
            .then(res => {
                console.log(res);
                commit('toggleLike', postId);
            });
    },

    submitComment({commit}, data) {
        console.log(data.comment);
        console.log(data.postId);
        axios
            .post('/api/comments/new/' + data.postId, {
                comment: data.comment.content,
                parent_id: data.comment.parent_id ?? null 
            })
            .then(res => {
                console.log(res);
            });
    }
    
};
const mutations = {

    setPosts(state, data) {
        state.posts = data.posts;
        state.loading = false;
    },

    saveCurrentPost(state, data) {
        state.currentPost = data;
        state.loading = false;
    },

    toggleLike(state, postId) {
        console.log('toggle like executed');
        console.log(postId);

        var item = null;

        if (state.posts === null) { item = state.currentPost.data; }
        else                      { item = state.posts.find(item => item.post.id === postId); }

        if (item !== null) {
            var change = item.isLiked ? -1 : 1;
            item.isLiked = !item.isLiked;
            item.post.likes += change;
        }
    },

    submitComment(state, data) {

    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};