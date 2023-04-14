<template>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  <header>
    <div class="containers row1">
      <button class="nav-toggle" aria-label="open navigation">
        <span class="hamburger"></span>
      </button>
      <RouterLink :to="'/'" class="logo"><img src='../assets/images/newLogo.png'></RouterLink>
      <ul class="mobile-search">
        <input type='search' placeholder='search' v-model="search" id='search-input' />
        <i class='fa fa-search' @click="searcher"></i>
      </ul>
      <nav class="nav">
        <ul class="nav__list nav__list--primary">
          <input type='search' placeholder='search' id='search' />
          <i class='fa fa-search desktop-search'></i>
        </ul>
        <ul v-if="connected" class="nav__list log">
          <li class="nav__item">
            <RouterLink :to="'/register'" class="nav__link nav__link--button">Register</RouterLink>
          </li>
          <li class="nav__item">
            <RouterLink :to="'/login'" class="nav__link nav__link--button btn-blue">Login</RouterLink>
          </li>
        </ul>
        <div v-else class="nav__list log">
          <div class="icon icon-shape bg-primary mt-1 text-white text rounded-circle nav__list">
            <i class="bi bi-person-fill" @click="user" ></i>
          </div>
          <li class="nav_item">
            <button class="nav__link nav_link--button btn-blue" @click="Logout">Logout</button>
          </li>
        </div>
      </nav>
    </div>
  </header>
</template>

<script>
import Cookies from 'js-cookie'
import { mapActions, mapGetters } from 'vuex'
export default {
  data () {
    return {
      connected: false,
      search: ''
    }
  },
  computed: {
    ...mapGetters('post', ['result'])
  },
  methods: {
    ...mapActions('user', ['logout']),
    ...mapActions('post', ['searchs']),
    searcher () {
      if (this.search !== '') {
        this.searchs(this.search)
        this.$emit('searchresult', this.allPosts)
      }
    },
    Logout () {
      Cookies.remove('token')
      this.logout()
      this.$router.push({ name: 'home' })
    },
    user () {
      this.$router.push({ name: 'user' })
    }
  },
  mounted () {
    const token = Cookies.get('token')
    if (Cookies.get('token') === undefined) {
      this.connected = true
    } else {
      if (token) {
        if (token) {
          fetch(`http://127.0.0.1:8000/api/users/myProfil/${token}`, {
            headers: {
            }
          })
            .then(response => {
            })
            .catch(error => {
              console.error(error)
            })
        } else {
          // l'utilisateur n'est pas authentifié
        }
      }
      this.connected = false
    }
    const hamburger = document.querySelector('.nav-toggle')
    const nav = document.querySelector('.nav')
    hamburger.addEventListener('click', () => {
      nav.classList.toggle('nav--visible')
    })
  }
}
</script>

<style>
#search-input {
  border-radius: 15px;
  height: 30px;
  display: inline;
  position: absolute;
  top: 0;
  right: 0;
  margin-top: 10px;
  margin-right: 30px;
  width: 50%;

}

.mobile-search .fa-search {
  position: absolute;
  right: 0;
  top: 0;
  display: inline;
  margin-top: 10px;
  margin-right: 30px;
  background-color: #0d68d1;
  width: 50px;
  height: 30px;
  border-radius: 10px;
  padding-top: 5px;
  color: #ffffff;
}
</style>
