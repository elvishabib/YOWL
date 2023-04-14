<template>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <div id="login" class="container mt-3">
        <div class="space-y-4">
          <h4 class="text-danger d-block">{{ error }}</h4>
            <span class="form-title">Login</span>
            <div class="relative mt-3">
                <form action=""></form>
                <label for="email">Email</label>
                <input type="email" v-model='users.email' id="name" placeholder="mail@mail.com" required>
            </div>
            <div class="relative mt-4">
                <label for="password">Password</label>
                <input type="password" v-model="users.password" id="name" placeholder="password" required>
                <button id="submit" @click.prevent="log" class="btn-primary"> Login</button>
            </div>
            <div class="log-link">
                <span id="account">
            <RouterLink :to="'/register'">
                    Dont't have an account ?
            </RouterLink>
                </span>
                <span id="forgot">
                    <RouterLink :to="'/reset'">
                    Forgot password ?
            </RouterLink>
                </span>
            </div>
        </div>
    </div>
    <div></div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Cookies from 'js-cookie'
export default {
  computed: { ...mapGetters('user', ['user']) },
  data () {
    return {
      error: '',
      users: {
        email: '',
        password: ''
      }

    }
  },
  methods: {
    ...mapActions('user', ['login']),
    connected () {
      if (Cookies.get('token')) {
        this.$router.push({ name: 'home' })
      }
    },
    log () {
      this.login(this.users).then(() => {
        if (this.user.access_token !== undefined) {
          Cookies.set('token', this.user.access_token, { expires: 1 })
          this.$router.push({ name: 'home' })
        } else {
          this.error = this.user
        }
      })
    }
  },
  mounted () {
    this.connected()
  }
}
</script>
