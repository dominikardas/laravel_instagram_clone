import axios from 'axios';

const state = {
    user: {},
    errors: null,
    loading: false
};
const getters = {

};
const actions = {

    getUser({commit}) {

        state.loading = true;

        axios
            .get('/api/auth/user')
            .then(res => { commit('setUser', res.data); });
    },

    loginUser( {commit}, user ) {

        state.loading = true;

        axios
            .post('/api/auth/login', user)
            .then(res => {
                var res = res.data;

                if (res.success) {
                    
                    // Set Access Token
                    localStorage.setItem(
                        'access_token',
                        res.data.access_token
                    );
                    
                    state.loading = false;

                    window.location.replace('/');
                }
            })
            .catch(err => {
                commit('setErrors', err.response.data.errors);
            });
    },

    registerUser( {commit}, user ) {

        state.loading = true;

        axios
            .post('/api/auth/register', user)
            .then(res => {
                var res = res.data;

                if (res.success) {
                    
                    // Set Access Token
                    localStorage.setItem(
                        'access_token',
                        res.data.access_token
                    );
                    
                    state.loading = false;

                    window.location.replace('/');
                }
            })
            .catch(err => {
                commit('setErrors', err.response.data.errors);
            });
    },

    followUser( {commit}, id) {
        axios
            .post('/api/profiles/' + id + '/follow/')
            .then(res => {
                console.log(res);
                commit('toggleFollow', id);
            });

        return false;
    }

};
const mutations = {

    setUser(state, data) {
        state.user = data;
        state.loading = false;
    },

    setErrors(state, data) {
        state.errors = data;
    },

    toggleFollow(state, id) {
        console.log('toggle follow executed');
        console.log(id);
        // this.$store.state.posts = this.$store.state.posts.map(item => item.author.profile_id === id ? { ...item, isFollowingUser: !item.post.isFollowingUser } : item);
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};