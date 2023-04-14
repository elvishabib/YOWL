<script>
import { mapActions, mapGetters } from 'vuex'
import Cookies from 'js-cookie'
export default {
  computed: {
    ...mapGetters('comment', ['allcomments', 'comments'])
  },
  methods: {
    ...mapActions('comment', ['addComment', 'getComments']),
    createPost () {
      const comment = {
        content: this.content,
        id: this.$route.params.id,
        token: Cookies.get('token')
      }
      this.addComment(comment).then(() => {
        alert('comment created')
        this.$router.push({ name: 'home' })
      })
    }
  }
}
</script>

<template>
  <form @submit.prevent="createPost">
  <div class="d-flex pt-3 pb-2 mb-2 comment">
    <input
      type="text"
      name="text"
      v-model="content"
      class="form-control addtxt"
    /><button id="gros"><i class="fa fa-paper-plane" ></i></button>
  </div>
</form>
</template>

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
