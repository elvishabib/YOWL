<template>
  <HeaderComponent />
  <div v-if="loading" class="loader"><img src='../assets/images/loading.gif' /> </div>
  <template v-if="page === 1">
    <Form1Component @next="next" />
  </template>
  <template v-if="page === 2">
    <Form2Component @next="next" :error="this.error" />
  </template>
  <template v-if="page === 3">
    <Form3Component @next="next" />
  </template>
  <template v-if="page === 4">
    <Form4Component @next="next" />
  </template>
</template>

<script>
import Cookies from 'js-cookie'
import Form1Component from '../components/RegisterForm1'
import Form2Component from '../components/RegisterForm2'
import Form3Component from '../components/EmailConfirmation'
import Form4Component from '../components/RegisterComplete'
import HeaderComponent from '../components/HeaderForm'
import { mapActions, mapGetters } from 'vuex'
export default {
  computed: { ...mapGetters('user', ['statusCode']) },
  components: {
    Form1Component,
    Form2Component,
    Form3Component,
    Form4Component,
    HeaderComponent
  },
  data () {
    return {
      error: '',
      loading: false,
      user: {
        password_confirmation: '',
        firstName: '',
        lastName: '',
        username: '',
        birthdate: '',
        email: '',
        password: ''
      },
      invalidDate: false,
      page: 1

    }
  },
  methods: {
    ...mapActions('user', ['addUsers']),
    // check if is already connected
    connected () {
      if (Cookies.get('token') !== undefined) {
        this.$router.push({ name: 'home' })
      }
    },
    // This function is call when user click in form button
    next (param, user) {
      // if button clicked is next or complete
      if (param === 1) {
        if (this.page === 1) {
          this.user.username = user.username
          this.user.firstName = user.firstname
          this.user.lastName = user.lastname
          this.user.birthdate = user.year + '/' + user.month + '/' + user.day
          this.page += param
        } else if (this.page === 2) {
          this.user.password = user.password
          this.user.password_confirmation = user.password_confirm
          this.user.email = user.email
          console.log(this.user)
          this.addUsers(this.user).then(() => {
            if (this.statusCode === 200) {
              this.page += param
              document.getElementsByClassName('query').disabled = true
            } else {
              this.error = this.statusCode
            }
          })
        }
      } else if (param === -1) {
        this.page += param
      }
    }
  },
  mounted () {
    this.connected()
  }
}
</script>
<style>
.loader {
  position: fixed;
  top: 200px;
  left: 35%;
  z-index: 10;
}
</style>
