<template>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <div id="login" class="container mt-3">
        <div class="space-y-4">
            <h4 class="text-danger d-block">{{ error }}</h4>
            <span class="form-title">Register</span>
            <div class="load-icon center">
                <span class="active"></span>
                <span class="desactive"></span>
                <span class="desactive"></span>
            </div>
            <form >
                <div class="relative mt-3">
                    <label for="username">Firstname</label>
                    <input type="text" v-model="user.firstname" @blur="firsnameCheck" @focus="hideFirstnameError" id="name" placeholder="Firstname" required>
                </div>
                <span class="form-error-message" v-if="showFistnameError">This firstname is invalid</span>
                <div class="relative mt-3">
                    <label for="username">Lastname</label>
                    <input type="text" v-model="user.lastname" @blur="lastnameCheck" @focus="hideLastnameError" id="name" placeholder="Lastname" required>
                </div>
                <span class="form-error-message" v-if="showLastnameError">This lastname is invalid</span>
                <div class="relative mt-3">
                    <label for="username">Username</label>
                    <input type="text" v-model="user.username" @blur="usernameCheck" @focus="hideUsernameError" id="name" placeholder="username" required>
                </div>
                <span class="form-error-message" v-if="showUsernameError">This username is invalid</span>
                <div class="relative mt-4">
                    <span class="half-form-control" id="day">
                        <label for="password">Day</label>
                    </span>
                    <span class="half-form-control" id="month">
                        <label for="month">Month</label>
                    </span>
                    <span class="half-form-control" id="day">
                        <input type="number" v-model='user.day' class="half-form" placeholder="Day" required>
                    </span>
                    <span class="half-form-control" id="month">
                        <input type="number" v-model='user.month' class="half-form" placeholder="Month" min="1" max="12" required>
                    </span>
                </div>
                <div class="relative mt-4">
                    <label for="password">Birth Year</label>
                    <input type="number" v-model='user.year' id="name" placeholder="Year" style="margin-top: 10px;" required>
                    <button id="submit" class="btn-primary" @click.prevent="step1"> Next</button>
                </div>
            </form>
        <div class="log-link">
            <RouterLink :to="'/login'">
                Already have an account ?
            </RouterLink>
        </div>
        </div>

    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {
  computed: {
    ...mapGetters('user', ['statusCode'])
  },
  data () {
    return {
      error: '',
      showUsernameError: false,
      showFistnameError: false,
      showLastnameError: false,
      user: {
        firstname: '',
        lastname: '',
        username: '',
        day: '',
        month: '',
        year: ''
      }
    }
  },
  methods: {
    ...mapActions('user', ['verifyUsername']),
    usernameCheck () {
      if (/(?=.*[a-zA-ZÀ-ÿ])^[a-zA-ZÀ-ÿ-0-9_]{3,32}$/.test(this.user.username)) {
        // also make request to api to check unicity
        this.showUsernameError = false
        return true
      } else {
        this.showUsernameError = true
        return false
      }
    },
    firsnameCheck () {
      if (/(?=.*[a-zA-ZÀ-ÿ])^[a-zA-ZÀ-ÿ_]{3,32}$/.test(this.user.firstname)) {
        this.showFistnameError = false
        return true
      } else {
        this.showFistnameError = true
        return false
      }
    },
    lastnameCheck () {
      if (/(?=.*[a-zA-ZÀ-ÿ])^[a-zA-ZÀ-ÿ_]{3,15}$/.test(this.user.lastname)) {
        this.showLastnameError = false
        return true
      } else {
        this.showLastnameError = true
        return false
      }
    },
    birthdayCheck () {
      const birthday = this.user.month + '/' + this.user.day + '/' + this.user.year
      const date = new Date(Date.parse(birthday))
      if (isNaN(date.getTime())) {
        this.invalidDate = true
        // this.error = 'Invalid date\n'
        return false
      } else {
        this.invalidDate = false
        const today = new Date()
        // Get timestamp and use it to check if user is more than 13 years old
        if (today - date.getTime() >= 409968000000 && today - date.getTime() <= 1103760000000) {
          return true
        } else {
          this.error = 'Oops 😥 your age don\'t correspond to accepted range '
          return false
        }
      }
    },
    hideFirstnameError () { this.showFistnameError = false },
    hideLastnameError () { this.showLastnameError = false },
    hideUsernameError () { this.showUsernameError = false },
    step1 () {
      this.error = ''
      if (!this.usernameCheck()) {
        this.error += 'Invalid username \r'
      }
      if (!this.firsnameCheck()) {
        this.error += 'Invalid firstname \n'
      }
      if (!this.lastnameCheck()) {
        this.error += 'Invalid lastname\n'
      }
      if (!this.birthdayCheck()) {
        this.error += 'Invalid birthdate\n'
      }
      if (this.usernameCheck() && this.lastnameCheck() && this.firsnameCheck() && this.birthdayCheck()) {
        // this.verifyUsername({ username: this.user.username }).then(() => {
        //   console.log(this.statusCode)
        //   if (this.statusCode.code === 200) {
        //     this.$emit('next', 1)
        //   } else {
        //     alert(this.statusCode.code)
        //     this.error = this.statusCode.data
        //     console.log(this.statusCode.code)
        //   }
        // })
        this.$emit('next', 1, this.user)
      }
    }
  }
}
</script>
