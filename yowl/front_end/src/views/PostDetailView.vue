<template>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  <HeaderComponent />
      <div class="containers">
        <div class="cards">
          <div class="card">
            <PostComponent />
          </div>

       </div>
      </div>
      <AddComponent class="addItem"/>
      {{ post }}
      <template v-for="post in allPosts" :key="post.id">
        {{ allPosts }}
      </template>
</template>

<script>
import PostComponent from '../components/PostItem2.vue'
import HeaderComponent from '../components/HeaderForm.vue'
import AddComponent from '../components/PostAddItem.vue'
import { mapGetters, mapActions } from 'vuex'
export default {
  components: {
    PostComponent,
    HeaderComponent,
    AddComponent
  },
  data () {
    return {
      posts: []
    }
  },
  computed: {
    ...mapGetters('post', ['allPosts', 'post'])
  },
  methods: {
    ...mapActions('post', ['getPosts', 'getOnePosts'])
  },
  mounted () {
    const id = this.$route.params.id
    this.getOnePosts(id)
  }
}
</script>

<style>
.body {
  max-width: 1200px;
    text-transform: uppercase;
    text-align: center;
}
.card{
    padding: .1rem;
    cursor: pointer;
    width: 350px;
    margin: 10px 5px 10px 5px;
}

.cards {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    gap: .5rem;
}
@media (min-width: 900px) {
    .cards {grid-template-columns: repeat(3, 1fr);}
}

</style>
