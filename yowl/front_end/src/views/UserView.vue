<template>
  <HeaderForm />
  <!-- userprofil-->
  <ProfileItem @active="switcher" :firstname="data.firstName" :lastname="data.lastName" :email="data.email"
    :created_at="data.created_at" :username="data.username" :birthdate="data.birthdate" :error='this.error' @submitPassForm ="submitPassForm() " />
  <!-- Post Management -->
  <div class="card" v-if="postActivate">
    <table>
      <thead class="thead-light">
        <tr>
          <th scope="col">Content</th>
          <th scope="col">Created at</th>
          <th scope="col">Like</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <template v-for="post in allPosts" :key="post.id">
          <template v-if="post.statut == 0">
    <PostItem :title="post.title" :created_at="post.created_at" :status="post.statut" :like="post.likes" :id="post.id"/>
  </template>
  </template>
      </tbody>
    </table>
    </div>
    <!-- Post Management end -->
      <!-- Post Management -->
  <div class="card" v-if="commentActivate">
   <div class="table-responsive">
    <table class="table table-hover table-nowrap">
      <thead class="thead-light">
        <tr>
          <th scope="col">Content</th>
          <th scope="col">Created at</th>
          <th scope="col">Action</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <template v-for="comment in allcomments" :key="comment.id">
          <template v-if="comment.statut == 0">
    <CommentItem :content="comment.content" :id="comment.id" :created_at="comment.created_at" />
  </template>
  </template>
      </tbody>
    </table>
  </div>

    </div>
    <!-- Post Management end -->
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import HeaderForm from '../components/HeaderForm'
import ProfileItem from '../components/ProfileItem'
import PostItem from '../components/PostItem'
import CommentItem from '../components/UserCommentItem'
import Cookie from 'js-cookie'

export default ({
  components: {
    HeaderForm,
    PostItem,
    ProfileItem,
    CommentItem
  },
  data () {
    return {
      data: '',
      error: '',
      user: {
        password_confirmation: '',
        old_password: '',
        password: ''
      },
      changepass: false,
      postActivate: true,
      commentActivate: false
    }
  },
  computed: {
    ...mapGetters('user', ['user']),
    ...mapGetters('post', ['allPosts']),
    ...mapGetters('comment', ['allcomments'])
  },
  methods: {
    ...mapActions('post', ['getUserPosts']),
    ...mapActions('comment', ['getComments']),
    ...mapActions('user', ['getUserFromToken', 'editUser', 'editUserprofil', 'editUserpass', 'getUsers']),
    showEditForm () {
      this.changepass = true
    },
    submitPassForm () {
      console.log(this.user.password)
      this.editUserpass(this.user.password)
        .then(response => {
          alert('Password successfully updated')
          this.changepass = false
        })
        .catch(error => {
          alert('Error updating password')
          console.error(error)
        })
    },
    switcher (toswitch) {
      const p = document.getElementById('postE')
      const c = document.getElementById('commentE')
      if (toswitch === 'comment') {
        this.commentActivate = true
        this.postActivate = false
        c.classList.add('active')
        p.classList.remove('active')
      } else if (toswitch === 'post') {
        this.postActivate = true
        this.commentActivate = false
        p.classList.add('active')
        c.classList.remove('active')
      }
    },
    getUsers () {
      this.getComments({ token: Cookie.get('token') })
      this.getUserPosts({ token: Cookie.get('token') })
    }
  },
  mounted () {
    this.getUsers()
    this.getUserFromToken(Cookie.get('token')).then((response) => {
      this.data = response.data
    })
  }
})
</script>

<style>
.hd {
  display: inline-flex;
  gap: 20px;
  padding: 40px;
  align-items: center;
  /* Align items vertically */
}

.hd img {
  margin-right: 30px;
  width: 100px;
}

.hd p {
  margin-bottom: 5px;
  margin-right: 50px;
  justify-content: left;
  font-weight: bold;
  /* Add this line to make the text bold */
}

.cont {
  display: left;
  width: 100%;
  height: 100%;
  gap: 20px;
  padding: 20px;
  flex-wrap: wrap;
  position: relative;
}

#pass-btn {
  display: flex;
  width: 365px;
  height: 40px;
  background-color: rgb(31, 50, 219);
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  border-radius: 10px;
}

.hdr2 nav {
  display: flex;
  flex-direction: row;
  width: 1200px;
  bottom: -10px;
  left: 500px;
  height: 70px;
  gap: 22px;
  bottom: 800px;
  justify-content: flex-end;
  background-color: rgb(232, 233, 243);
  flex-wrap: wrap;
  position: absolute;
  margin-bottom: 0px;
}

.hdr2 nav p {
  display: flex;
  position: relative;
  width: 280px;
  height: 50px;
  background-color: rgb(31, 50, 219);
  color: #fff;
  font-size: 17px;
  font-weight: bold;
  padding: 10px;
  border-radius: 10px;
  justify-content: center;
  /* added this line */
}

.hdr2 a {
  display: flex;
  flex-direction: row;
  left: 1700px;
  padding: 10px;
  justify-content: flex-end;
  flex-wrap: wrap;
  position: absolute;
  margin-bottom: 0px;
  font-weight: bold;
  bottom: 780px;
  padding-top: 5px;
}

.post {
  display: flex;
  flex-direction: row;
  width: 70%;
  height: 60%;
  left: 490px;
  padding: 20px;
  bottom: 100px;
  justify-content: flex-end;
  /* Adjusted property */
  flex-wrap: wrap;
  position: absolute;
  overflow: auto;
}
</style>
