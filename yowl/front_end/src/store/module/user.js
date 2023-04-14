import Cookies from 'js-cookie'
export const user = {
  namespaced: true,
  state: {
    users: [],
    user: [],
    posts: [],
    post1: [],
    statusCode: [],
    loading: true
  },
  getters: {
    loading: (state) => state.loading,
    allUsers: (state) => state.users,
    allPosts: (state) => state.posts,
    user: (state) => state.user,
    statusCode: (state) => state.statusCode,
    getpostbyuser: (state) => (userId) => {
      return state.posts.filter((note) => note.users.includes(userId))
    }
  },
  actions: {
    //  Get all users from databases
    async getUsers ({ commit }) {
      const response = await fetch(
        'http://127.0.0.1:8000/api/users/allUsers', {
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${Cookies.get('token')}`
          }
        }
      )
      const data = await response.json()
      commit('setUsers', data.data)
      return data
    },
    // Verify username
    async verifyUsername ({ commit }, username) {
      await fetch('http://localhost:8000/api/users/verifyUsername/' + username.username, {
        headers: {
          'Content-Type': 'application/json'
        }
      })
        .then((response) => {
          commit('setStatusCode', response)
          response.json()
        })
    },
    async addUsers ({ commit }, data) {
      commit('setLoading', true)
      await fetch('http://localhost:8000/api/users/register', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
        .then((response) => {
          commit('setStatusCode', response.status)
          response.json()
        })
        .then((newPost) => {
          commit('setUsers', newPost)
          commit('setLoading', false)
        })
    },
    emailVerification ({ commit }, code) {
      fetch('http://localhost:8000/api/users/mailVerification', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(code)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setUser', newPost)
        })
    },
    async login ({ commit }, user) {
      await fetch('http://localhost:8000/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
      })
        .then((response) => {
          return response.json()
        })
        .then((data) => {
          commit('setUser', data)
          console.log(data)
        })
        .catch((error) => {
          console.log(error)
        })
    },
    async logout ({ commit }) {
      await fetch('http://localhost:8000/api/logout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      })
      commit('setUser', [])
        .catch((error) => {
          console.log(error)
        })
    },
    // Register
    // Route::post($users.'/register',[UserController::class,'register']);
    async addUser ({ dispatch }, { name }) {
      const todo = { name }
      const response = await fetch(
        'http://localhost:8000/api/users/allUsers/',
        {
          method: 'POST',
          body: JSON.stringify(todo)
        }
      )
      console.log(response)
      dispatch('getUsers')
      return response
    },
    async addPosts (
      { dispatch },
      { title, excerpt, content, categories, status }
    ) {
      const comment = { title, excerpt, content, categories, status }
      const response = await fetch(
        'http://localhost:8000/api/users/allUsers/posts',
        {
          method: 'POST',
          body: JSON.stringify(comment)
        }
      )
      console.log(response)
      dispatch('getPosts')
    },
    async deleteUser ({ dispatch }, id) {
      const response = await fetch(
        `http://localhost:8000/api/users/allUsers/${id}?force=true`,
        {
          method: 'DELETE'
        }
      )
      console.log(response)
      dispatch('getUsers')
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
    async deleteAllPostsInUser ({ dispatch }, userId) {
      // Récupère tous les ID de post pour la catégorie spécifiée
      const response = await fetch(
        `http://localhost:8000/api/users?allUsers=${userId}`
      )
      const posts = await response.json()
      const postIds = posts.map((post) => post.id)

      // Supprime chaque post un par un
      for (const postId of postIds) {
        await fetch(
          `http://localhost:8000/api/users/posts/${postId}`,
          {
            method: 'DELETE'
          }
        )
      }

      // Actualise la liste des posts
      dispatch('getPosts')
    },
    // D'apres l'API, on ne peut changer que le mot de passe
    async editUserpass ({ dispatch }, { name, id }) {
      const user = { name }
      const response = await fetch(
        'http://localhost:8000/api/users/updatePassword',
        {
          method: 'POST',
          body: JSON.stringify(user)
        }
      )
      console.log(response)
      dispatch('getUsers')
    },
    async editUserprofil ({ dispatch }, { name, id }) {
      const user = { name }
      const response = await fetch(
        'http://localhost:8000/api/users/updateMyProfil',
        {
          method: 'POST',
          body: JSON.stringify(user)
        }
      )
      console.log(response)
      dispatch('getUsers')
    },
    async editPosts ({ dispatch }, { title, excerpt, categories, id }) {
      const todo = { title, excerpt, user, id }
      const response = await fetch(
        `http://localhost:8000/api/users/posts/${id}`,
        {
          method: 'PUT',
          body: JSON.stringify(todo)
        }
      )
      console.log(response)
      dispatch('getPosts')
    },
    async getUserFromToken ({ commit }, token) {
      const response = await fetch(
        'http://localhost:8000/api/users/myProfil/' + token, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            Authorization: 'Bearer ' + token
          },
          body: JSON.stringify()
        })
      const data = await response.json()
      commit('setUser', data)
      return data
    }
  },
  mutations: {
    setUsers: (state, users) => (state.users = users),
    setLoading: (state, loading) => (state.loading = loading),
    setUser: (state, user) => (state.user = user),
    setPosts: (state, posts) => (state.posts = posts),
    setOnePosts: (state, posts) => (state.post1 = posts),
    setStatusCode (state, code) { // mutation pour mettre à jour le code de résultat
      state.statusCode = code
    }
  }
}
