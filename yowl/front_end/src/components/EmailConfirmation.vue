<template>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <div id="login" class="container mt-3">
        <div class="space-y-4">
            <span class="form-title">Activate your account</span>
            <div class="relative mt-3">
                <label for="email">Code</label>
                <input type="text" v-model='code' id="name" placeholder="1234" required>
            <h4 class="text-danger d-block">{{ error }}</h4>
            </div>
            <div class="relative">
                <span  id="day">
                    <button id="submit" class="btn-primary" @click="activate">Activate</button>
                </span>
            </div>
            <div class="log-link">
                <span>
                    Already have an account ?
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {
  computed: { ...mapGetters('user', ['statusCode']) },
  data () {
    return {
      error: '',
      code: ''
    }
  },
  methods: {
    ...mapActions('user', ['emailVerification']),
    activate () {
      this.emailVerification({ code: this.code }).then(() => {
        if (this.statusCode === 200) {
          this.$router.push({ name: 'login' })
        } else {
          this.error = this.statusCode.data
          console.log(this.statusCode)
        }
      })
    }
  }
}
</script>
