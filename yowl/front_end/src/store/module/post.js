import Cookies from 'js-cookie'
export const post = {
  namespaced: true,
  state: {
    posts: [],
    post1: [],
    count: [],
    statusCode: [],
    loading: true
  },
  getters: {
    statusPostCode: (state) => state.statusCode,
    loading: (state) => state.loading,
    allPosts: (state) => state.posts,
    post: (state) => state.post1,
    count: (state) => state.count,
    getpostbyuser: (state) => (userId) => {
      return state.posts.filter((note) => note.users.includes(userId))
    }
  },
  actions: {
    async getPosts ({ commit }) {
      const response = await fetch(
        'http://localhost:8000/api/posts/allposts'
      )
      const data = await response.json()
      //  console.log(data)
      commit('setPosts', data)
    },
    // return total number of posts in database
    async countPosts ({ commit }) {
      const response = await fetch(
        'http://localhost:8000/api/posts/post_count', {
          headers: {
            Authorization: `Bearer ${Cookies.get('token')}`
          }
        }
      )
      const data = await response.json()
      //  console.log(data)
      commit('setCount', data)
    },
    // Get specific user posts
    async getUserPosts ({ commit }, post) {
      const response = await fetch(
        'http://localhost:8000/api/posts/show_posts', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${Cookies.get('token')}`
          },
          body: JSON.stringify(post)
        })
      const data = await response.json()
      console.log(data)
      commit('setPosts', data)
    },
    async getOnePosts ({ commit }, id) {
      try {
        const response = await fetch(
          `http://localhost:8000/api/posts/post/${id}`
        )
        const data = await response.json()
        console.log(data)
        commit('setOnePosts', data)
        return data
      } catch (error) {
        console.log(error)
      }
    },
    async addPost ({ commit }, post) {
      commit('setLoading', true)
      await fetch('http://localhost:8000/api/posts/create', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${Cookies.get('token')}`
        },
        body: JSON.stringify(post)
      })
        .then(async (response) => {
          await response.json().then((newPost) => {
            commit('setStatusCode', response.status)
            commit('setPosts', newPost)
            commit('setLoading', false)
          })
        })
    },
    editPost ({ commit }, post) {
      fetch('http://localhost:8000/api/posts/edit/' + post.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(post)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setPosts', newPost)
        })
    },
    deletePost ({ commit }, post) {
      fetch('http://localhost:8000/api/posts/delete/' + post.id.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(post)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setPosts', newPost)
        })
    },
    likePost ({ commit }, id) {
      fetch('http://localhost:8001/api/posts/likes/' + id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(post)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setPosts', newPost)
        })
    },
    unlikePost ({ commit }, id) {
      fetch('http://localhost:8001/api/posts/unlikes/' + id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(post)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setPosts', newPost)
        })
    },
    async addPosts (
      { dispatch },
      { title, excerpt, content, categories, status }
    ) {
      const comment = { title, excerpt, content, categories, status }
      const response = await fetch(
        'http://localhost:8000/api/posts/create',
        {
          method: 'POST',
          body: JSON.stringify(comment)
        }
      )
      console.log(response)
      dispatch('getPosts')
    },
    async deletePosts ({ dispatch }, id) {
      const response = await fetch(
        `http://localhost:8000/api/users/posts/${id}`,
        {
          method: 'DELETE'
        }
      )
      console.log(response)
      dispatch('getPosts')
    },
    async search ({ commit }, query) {
    // Make a search request to the server
      fetch('http://localhost:8000/api/posts/search', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(query)
      })
        .then(response => response.json())
        .then(data => {
          commit('setPosts', data)
          console.log(data)
        })
        .catch(error => {
          console.error(error)
        })
    }
  },
  mutations: {
    setStatusCode (state, code) { // mutation pour mettre à jour le code de résultat
      state.statusCode = code
    },
    setUsers: (state, users) => (state.users = users),
    setLoading: (state, loading) => (state.loading = loading),
    setCount: (state, count) => (state.count = count),
    setPosts: (state, posts) => (state.posts = posts),
    setOnePosts: (state, posts) => (state.post1 = posts)
  }
}
