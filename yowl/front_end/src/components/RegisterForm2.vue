<template>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <div id="login" class="container mt-3">
        <div class="space-y-4">
          <h4 class="text-danger d-block">{{ error }}</h4>
            <span class="form-title">Register</span>
            <div class="load-icon center">
                <span class="active"></span>
                <span class="active"></span>
                <span class="desactive"></span>
            </div>
            <form>
            <div class="relative mt-3">
                <label for="email">Email</label>
                <input type="email" v-model='user.email' @blur="Emailcheck" @focus="hideEmailError" id="name" placeholder="example@email.com" required>
            </div>
            <span class="form-error-message" v-if="showError">Something went wrong</span>
            <div class="relative mt-3">
                <label for="email">Your Password</label>
                <input type="password" v-model='user.password' @blur="Passwordcheck" @focus="hidePasswordError" id="name" required>
            </div>
            <span class="form-error-message" v-if="showPasswordError">Your password must have at least 8 character and contain at least 1 uppercase, 1 lowercase, 1 number and one special character</span>
            <div class="relative mt-3">
                <label for="email">Your Password Confirm</label>
                <input type="password" v-model='user.password_confirm' @blur="PasswordConfirmcheck" @focus="hidePasswordConfirmError" id="name" required>
            </div>
            <span class="form-error-message" v-if="showPasswordConfirmError">Password dismatch</span>
            <div class="relative mt-4">
                <span class="half-form-control" id="day">
                    <button id="submit" class="half-form btn-gray text-gray" style="color: #555;" @click.prevent="prev">Previous</button>
                </span>
                <span class="half-form-control" id="day">
                    <button id="submit" class="half-form btn-primary query" @click.prevent="next">Next</button>
                </span>
            </div>
            <div class="log-link">
                <span>
                    Already have an account ?
                </span>
            </div>
        </form>
        </div>
    </div>
</template>

<script>
export default {
  props: { error: String },
  data () {
    return {
      showError: false,
      showPasswordError: false,
      showPasswordConfirmError: false,
      user: {
        email: '',
        password: '',
        password_confirm: ''
      }
    }
  },
  methods: {
    Emailcheck () {
      // eslint-disable-next-line no-useless-escape
      if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,4})$/.test(this.user.email)) {
        this.showError = false
        return true
      } else {
        this.showError = true
        return false
      }
    },
    Passwordcheck () {
      if (/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(this.user.password)) {
        this.showPasswordError = false
        return true
      } else {
        this.showPasswordError = true
        return false
      }
    },
    PasswordConfirmcheck () {
      if (this.user.password !== this.user.password_confirm) {
        this.showPasswordConfirmError = true
      } else {
        return true
      }
    },
    hidePasswordError () { this.showPasswordError = false },
    hidePasswordConfirmError () { this.showPasswordConfirmError = false },
    hideEmailError () {
      this.showError = false
    },
    next () {
      if (this.Emailcheck() && this.Passwordcheck() && this.PasswordConfirmcheck()) {
        this.$emit('next', 1, this.user)
      }
    },
    prev () {
      this.$emit('next', -1, this.user)
    }
  }
}
</script>

<style>
.form-error-message {
  color:red;
  font-weight:bold;
  padding-left: 20px;
}

</style>
