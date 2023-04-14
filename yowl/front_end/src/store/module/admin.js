import Cookies from 'js-cookie'
export const admin = {
  namespaced: true,
  /*
Route::get($admin.'/showUserProfil/{id}',[UserController::class,'showUserProfil']);
*/
  state: {
    users: [],
    count: [],
    count2: [],
    admins: []
  },
  getters: {
    allUser: (state) => state.users,
    allAdmins: (state) => state.admins,
    adminCount: (state) => state.count,
    userCount: (state) => state.count2
  },
  actions: {
    // Create admin
    async createAdmin ({ commit }, data) {
      await fetch('http://localhost:8000/api/admin/createAdmin', {
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
        })
    },
    // Get all user who is admin
    async allUserAdmin ({ commit }) {
      const response = await fetch(
        'http://127.0.0.1:8000/api/admin/allUserAdmin', {
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${Cookies.get('token')}`
          }
        }
      )
      const data = await response.json()
      commit('setAdmins', data.data)
      return data
    },
    // Delete User
    deleteUser ({ commit }, post) {
      fetch('http://localhost:8000/api/admin/deleteUser/' + post.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(post)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setUsers', newPost)
        })
    },
    // Delete Admin
    deleteAdmin ({ commit }, post) {
      fetch('http://localhost:8000/api/admin/deleteAdmin/' + post.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(post)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setUsers', newPost)
        })
    },
    // Delete Admin
    UpdateUserByAdminSys ({ commit }, post) {
      fetch('http://localhost:8000/api/admin/UpdateUserByAdminSys/' + post.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(post)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setUsers', newPost)
        })
    },
    // Delete Admin
    UpdateUserByAdmin ({ commit }, post) {
      fetch('http://localhost:8000/api/admin/UpdateUserByAdmin/' + post.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${Cookies.get('token')}`
        },
        body: JSON.stringify(post)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setUsers', newPost)
        })
    },
    async countUser ({ commit }) {
      const response = await fetch(
        'http://localhost:8000/api/admin/countUser', {
          headers: {
            Authorization: `Bearer ${Cookies.get('token')}`
          }
        }
      )
      const data = await response.json()
      //  console.log(data)
      commit('setCount2', data.data)
    },
    async countAdmin ({ commit }) {
      const response = await fetch(
        'http://localhost:8000/api/admin/countAdmin', {
          headers: {
            Authorization: `Bearer ${Cookies.get('token')}`
          }
        }
      )
      const data = await response.json()
      //  console.log(data)
      commit('setCount', data.data)
    }
  },
  mutations: {
    setUsers: (state, users) => (state.users = users),
    setAdmins: (state, users) => (state.admins = users),
    setCount: (state, count) => (state.count = count),
    setCount2: (state, count) => (state.count2 = count)

  }

}
