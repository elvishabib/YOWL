import Cookies from 'js-cookie'
export const comment = {
  namespaced: true,
  state: {
    comments: [],
    comment1: [],
    countComments: []
  },
  getters: {
    countComments: (state) => state.countComments,
    allcomments: (state) => state.comments,
    comment: (state) => state.comment1,
    getcommentbyuser: (state) => (userId) => {
      return state.comments.filter((note) => note.users.includes(userId))
    }
  },
  actions: {
    getToken () {
      return Cookies.get('token')
    },
    // Get comments of connected user
    async getComments ({ commit }, comment) {
      const response = await fetch(
        'http://localhost:8000/api/comments/show_comments', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${Cookies.get('token')}`
          },
          body: JSON.stringify(comment)
        })
      const data = await response.json()
      //  console.log(data)
      commit('setcomments', data)
    },
    async getPostComments ({ commit }, comment) {
      const response = await fetch(
        `http://localhost:8000/api/comments/comment/${comment.id}`, {
          headers: {
            Authorization: `Bearer ${comment.token}`
          }
        }
      )
      const data = await response.json()
      console.log(data)
      commit('setcomments', data)
    },
    // return total number of posts in database
    async countCom ({ commit }) {
      const response = await fetch(
        'http://localhost:8000/api/comments/comment_count', {
          headers: {
            Authorization: `Bearer ${Cookies.get('token')}`
          }
        }
      )
      const data = await response.json()
      //  console.log(data)
      commit('setCount', data)
    },
    async getOneComments ({ commit }, id) {
      try {
        const response = await fetch(
          `http://localhost:8000/api/comments/comment/${id}`
        )
        const data = await response.json()
        console.log(data)
        commit('setOnecomments', data)
        return data
      } catch (error) {
        console.log(error)
      }
    },
    addComment ({ commit }, comment) {
      fetch('http://localhost:8000/api/comments/addcomment/' + comment.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${comment.token}`
        },
        body: JSON.stringify(comment)
      })
        .then((response) => response.json())
        .then((newcomment) => {
          commit('setcomments', newcomment)
        })
    },
    editComment ({ commit }, comment) {
      fetch('http://localhost:8000/api/comments/edit/' + comment.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(comment)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setcomments', newPost)
        })
    },
    deleteComment ({ commit }, comment) {
      fetch('http://localhost:8000/api/comments/delete/' + comment.id, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(comment)
      })
        .then((response) => response.json())
        .then((newPost) => {
          commit('setcomments', newPost)
        })
    },
    // async addcomments (
    //   { dispatch },
    //   { title, excerpt, content, categories, status }
    // ) {
    //   const comment = { title, excerpt, content, categories, status }
    //   const response = await fetch(
    //     'http://localhost:8000/api/comments/create',
    //     {
    //       method: 'comment',
    //       body: JSON.stringify(comment)
    //     }
    //   )
    //   console.log(response)
    //   dispatch('getcomments')
    // },
    async deletecomments ({ dispatch }, id) {
      const response = await fetch(
        `http://localhost:8000/api/users/comments/${id}`,
        {
          method: 'DELETE'
        }
      )
      console.log(response)
      dispatch('getcomments')
    }
  },
  mutations: {
    setUsers: (state, users) => (state.users = users),
    setcomments: (state, comments) => (state.comments = comments),
    setCount: (state, count) => (state.countComments = count),
    setOnecomments: (state, comments) => (state.comment1 = comments)
  }
}
