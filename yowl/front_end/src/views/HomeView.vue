<template>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  <HeaderComponent />
  <div class="containers">
    <div class="cards">
      <template v-for="post in allPosts" :key="post.id">
        <template v-if="post.statut===0">
        <div class="card">
          <div class="box">
        <div class="icon icon-shape-sm bg-primary text-white text-lg rounded-circle">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="author d-inline">{{ post.username }}</div>
        <div><strong>{{ noTitle(post.title) }}</strong></div>
        <div class="card-container">
            <div class="image">
                <RouterLink :to="'/detail/'+ post.id "><img :src=" noImage(post.image) "></RouterLink>
            <div class="media-icon">
                <i class="bi bi-hand-thumbs-up">{{ post.likes }}</i>
                <i class="bi bi-chat"></i>
            </div>
            </div>

            <div class="text">
                    <p>{{ post.content.slice(0,150) }}</p>
                    <a :href="`${post.url}`" target="_blank"> <button class="site-name">{{ post.url.slice(8,15) }} ...</button> </a>
            </div>
        </div>
    </div>
  </div>
  </template>
      </template>
    </div>
  </div>
  <AddComponent class="addItem" />
</template>

<script>
import HeaderComponent from '../components/HeaderForm.vue'
import AddComponent from '../components/CreatePost.vue'
import Cookies from 'js-cookie'
import { mapGetters, mapActions } from 'vuex'
export default {
  components: {
    HeaderComponent,
    AddComponent
  },
  data () {
    return {
      posts: [],
      token: ''
    }
  },
  computed: {
    ...mapGetters('post', ['allPosts'])
  },
  methods: {
    ...mapActions('post', ['getPosts']),
    noImage (url) {
      if (url === '') {
        url = 'https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg'
      }
      return url
    },
    noTitle (url) {
      if (url === '') {
        url = this.url
      }
      return url
    },
    truncateText (str, maxLength) {
      if (str.length > maxLength) {
        return str.slice(0, maxLength) + '...'
      } else {
        return str
      }
    }
  },
  mounted () {
    this.token = Cookies.get('token')
    this.getPosts()
  }
}
</script>

<style>
.author {
    margin-left: 10px;
}
.card-container {
    display: flex;
}
.media-icon .bi {
    margin: 5px;
    color: #0d68d1;
}
img {
    width: 200px;
    height: 200px;
    border-radius: 10px;
    padding: 5px;
}

.text {
    font-size: 14px;
    padding-left: 20px;
    width:50%;
    overflow-y: scroll;
}
.site-name {
bottom: 0;
position: absolute;
right: 0;
margin: 10px;
border-radius: 5px;
padding: 5px;
color: #fff;
background-color: #0d68d1;width: 100px;
height:40px;
}

.addItem {
  position: fixed;
  top: 0px;
  left: 0px;
}

.body {
  text-transform: uppercase;
  text-align: center;
}

.card {
  padding: .1rem;
  cursor: pointer;
  margin: 10px 5px 10px 5px;
}

.cards {
  margin: 0 auto;
  display: grid;
  gap: .5rem;
}

@media (min-width: 900px) {
  .cards {
    grid-template-columns: repeat(3, 1fr);
  }
}</style>
