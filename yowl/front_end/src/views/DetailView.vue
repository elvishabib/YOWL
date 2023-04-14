<template>
  <Header />
      <div class="containers">
    <div class="cards">
    <div class="card" style="width:500px; overflow-y: scroll; height: 300px;">
      <div class="box" style="">
        <div class="icon icon-shape-sm bg-primary text-white text-lg rounded-circle">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="author d-inline">{{ post.username }}</div>
        <div><strong>{{ noTitle(post.title) }}</strong></div>
        <div class="card-container">
            <div class="image">
              <img :src=" noImage(post.image) ">
            </div>

            <div class="text">
                    <p>{{ post.content }}</p>
            </div>
        </div>
    </div>
</div>
    </div>
    <CreateComment />
    <template v-for="comment in allcomments" :key="comment.id">
    <CommentComponent :author="comment.username" :comment="comment.content" :created_at="comment.created_at"/>
    </template>
</div>

</template>
<script>
import CommentComponent from '../components/CommentComponent.vue'
import CreateComment from '../components/CreateComment.vue'
import Header from '../components/HeaderForm.vue'
import { mapGetters, mapActions } from 'vuex'
export default {
  components: {
    CommentComponent,
    CreateComment,
    Header
  },
  computed: {
    ...mapGetters('post', ['post']),
    ...mapGetters('comment', ['allcomments'])
  },
  methods: {
    ...mapActions('post', ['getOnePosts']),
    ...mapActions('comment', ['getPostComments']),
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
    }
  },
  mounted () {
    const id = this.$route.params.id
    const param = {
      id: id
    }
    console.log(param)
    this.getOnePosts(id)
    this.getPostComments(param)
  }
}
</script>

<style>
#gros {
background-color: transparent;
border: 0px transparent;
}
.fa-paper-plane {
margin-left: -30px;
margin-top: 10px;
}

.comment {
color: blue;
width: 40%;
border-radius: 50px;
}
</style>
