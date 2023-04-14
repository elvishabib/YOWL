import { createStore } from 'vuex'
import { user } from './module/user'
import { post } from './module/post'
import { comment } from './module/comment'
import { admin } from './module/admin'

export default createStore({
  state: {
  },
  getters: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    user,
    post,
    comment,
    admin
  }
})
