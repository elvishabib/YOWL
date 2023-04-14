<template>
  <section class="section about-section gray-bg" id="about">
    <div class="container">
      <div class="row align-items-center flex-row-reverse">
        <div class="col-lg-3">
                 <div class=" relative mt-3">
                    <button  id="pass-btn" @click="showEditForm()">Change password</button>
                </div>
                <div v-if="changepass">
                    <form @submit.prevent="submitPassForm" >
                      <span class="form-error-message" v-if="showPasswordError">Your password must have at least 8 character and contain at least 1 uppercase, 1 lowercase, 1 number and one special character</span>
                        <div class="relative mt-3">
                            <form action=""></form>
                            <input type="password" v-model='userpass.old_password' id="name" placeholder="Old password" required>
                        </div>
                        <span class="form-error-message" v-if="showPasswordConfirmError">Password dismatch</span>
                        <div class="relative mt-3">
                            <form action=""></form>
                            <input type="password" v-model='userpass.password' id="name" placeholder="New password" required>
                        </div>
                        <div class="relative mt-3">
                            <form action=""></form>
                            <input type="password" v-model='userpass.password_confirm' id="name" placeholder="Confirm new password" required>
                        </div>
                        <div style="margin: 20px; margin-left: 45%;">
                            <button type="submit">
                            <img src="../assets/send.png" style="width: 50px; border: none;">
                        </button>
                        <button type="button" @click="changepass=false">
                            <img src="../assets/cancel.jpeg" style="width: 50px;">
                        </button>
                        </div>
                    </form>
                  </div>
        </div>
        <div class="col-lg-3">
          <div class="about-text go-to">
            <h3 class="dark-color">About Me</h3>
            <p>I services for customers of all sizes, specializing in creating
              stylish, modern websites, web services and online stores.</p>
            <div class="row about-list">
              <div class="col-md-6">
                <div class="media">
                  <label>Birthday</label>
                  <p> {{ birthdate }} </p>
                </div>
                <div class="media">
                  <label>Age</label>
                  <p>22 Yr</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="media">
                  <label>Location</label>
                  <p > {{'location'}} </p>
                </div>
                <div class="media">
                  <label>Phone  </label>
                  <p>67 92 33 38</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="about-text go-to">
            <h3 class="dark-color" @click="editname()">{{ username }} Account created</h3>
            <p>{{ created_at }} </p>
              <div class="col-md-6">
                <p  class="font-bold" >  {{ firstname }} {{ lastname }}  </p>
                <p > {{ email }} </p>
              </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="about-avatar ">
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
          </div>
          <p @click="editprofil()"> {{ 'change profil' }} </p>
        </div>
      </div>
      <ul class="nav nav-tabs mt-4 overflow-x border-0">
        <li class="nav-item ">
      <!-- Appelle la function pour changer l'etat du toggle pour switcher entre posts et comments -->
          <span class="nav-link active" id="postE" @click="this.$emit('active','post')"> Posts </span>
        </li>
        <li class="nav-item">
          <span class="nav-link font-regular" id="commentE" @click="this.$emit('active','comment')">Comments</span>
        </li>
        <li class="nav-item">
        </li>
      </ul>
      <!-- Utilise un toggle ici pour switcher entre les posts et les comments -->
    </div>
  </section>
</template>

<script>
export default ({
  props: {
    email: String,
    firstname: String,
    lastname: String,
    created_at: String,
    birthdate: String,
    username: String
  },
  data () {
    return {
      users: {},
      showError: false,
      showPasswordError: false,
      showPasswordConfirmError: false,
      changepass: false,
      userpass: {
        old_password: '',
        password: '',
        password_confirm: ''
      }
    }
  },
  methods: {
    showEditForm () {
      this.changepass = true
    },
    OldPasscheck () {
      if (/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(this.userpass.old_password)) {
        this.showPasswordError = false
        return true
      } else {
        this.showPasswordError = true
        return false
      }
    },
    Passwordcheck () {
      if (/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(this.userpass.password)) {
        this.showPasswordError = false
        return true
      } else {
        this.showPasswordError = true
        return false
      }
    },
    PasswordConfirmcheck () {
      if (this.userpass.old_password === this.userpass.password) {
        this.showPasswordConfirmError = true
      } else {
        return true
      }
    },
    PasswordConfirmcheck2 () {
      if (this.userpass.password !== this.userpass.password_confirm) {
        this.showPasswordConfirmError = true
      } else {
        return true
      }
    },
    hidePasswordError () { this.showPasswordError = false },
    hidePasswordConfirmError () { this.showPasswordConfirmError = false },
    submitPassForm () {
      if (this.OldPasscheck() && this.Passwordcheck() && this.PasswordConfirmcheck() && this.PasswordConfirmcheck2()) {
        this.$emit(this.userpass)
      }
    },
    getUsers () {
    }
  },
  mounted () {
    this.getUsers()
  }
})
</script>

<style>
.gray-bg {
  background-color: #f5f5f5;
}

img {
  max-width: 100%;
}

img {
  vertical-align: middle;
  border-style: none;
  /* border-radius: 50%; */
}

.about-text h3 {
  font-size: 30px;
  font-weight: 700;
  margin: 0 0 6px;
}

@media (max-width: 767px) {
  .about-text h3 {
    font-size: 16px;
  }
}

.about-text h6 {
  font-weight: 600;
  margin-bottom: 15px;
}

@media (max-width: 767px) {
  .about-text h6 {
    font-size: 14px;
  }
}

.about-text p {
  font-size: 14px;
  max-width: 600px;
}

.about-text p mark {
  font-weight: 600;
  color: #20247b;
}

.about-list .media {
  padding: 5px 0;
}

.about-list label {
  color: #20247b;
  font-weight: 600;
  width: 88px;
  margin: 0;
  position: relative;
}

.about-list label:after {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  right: 11px;
  width: 1px;
  height: 12px;
  background: #20247b;
  -moz-transform: rotate(15deg);
  -o-transform: rotate(15deg);
  -ms-transform: rotate(15deg);
  -webkit-transform: rotate(15deg);
  transform: rotate(15deg);
  margin: auto;
  opacity: 0.5;
}

.about-list p {
  margin: 0;
  font-size: 15px;
}

@media (max-width: 991px) {
  .about-avatar {
    margin-top: 30px;
  }
}

.about-section .counter {
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
  width: 100%;
}

.about-section .counter .count-data {
  margin-top: 5px;
  margin-bottom: 5px;
}

.about-section .counter .count {
  font-weight: 400;
  color: #20247b;
  margin: 0 0 0px;
}

.about-section .counter p {
  font-weight: 400;
  margin: 0;
}

mark {
  background-image: linear-gradient(rgba(252, 83, 86, 0.6), rgba(252, 83, 86, 0.6));
  background-size: 100% 3px;
  background-repeat: no-repeat;
  background-position: 0 bottom;
  background-color: transparent;
  padding: 0;
  color: currentColor;
}

.theme-color {
  color: #fc5356;
}
.form-error-message {
  color:red;
  font-weight:bold;
  padding-left: 20px;
}
.dark-color {
  color: #20247b;
}</style>
