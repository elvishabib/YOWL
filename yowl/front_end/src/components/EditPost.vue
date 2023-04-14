<template>
<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<button type="button" v-if="toggle" @click.prevent="create" class="btn btn-sm btn-square btn-neutral text-danger-hover">
<i class="bi bi-pencil"></i>
</button>
<div v-else class="popup">
        <div class="v81_1058"><span class="popup-title">Edit a post</span>
            <div class="v81_1068"><textarea class="opinion" v-model='content' placeholder="Your opinion here"></textarea></div>
            <div class="v81_1070">
              <button class="publish" @click.prevent="createPost">Publish</button>
            </div>
        </div>
<div @click="create" id="product-add"><i class="fa fa-plus add" style="transform: rotate(45deg);"></i></div>
</div>
</template>

<script>
import Cookies from 'js-cookie'
import { mapActions, mapGetters } from 'vuex'
export default {
  computed: {
    ...mapGetters('post', ['statusPostCode', 'loading', 'post'])
  },
  data () {
    return {
      loading: this.loading,
      toggle: true,
      content: this.post
    }
  },
  methods: {
    ...mapActions('post', ['editPost', 'getOnePosts']),
    create (id) {
      this.toggle = !this.toggle
    },
    createPost () {
      const param = this.$route.params.id
      const post = {
        id: param,
        content: this.content,
        token: Cookies.get('token')
      }
      this.loading = false
      this.editPost(post).then(() => {
        this.$router.push({ name: 'user' })
      })
    }
  },
  mounted () {
    this.getOnePosts(this.$route.params.id)
  }
}
</script>

<style>
#product-add{
  position: fixed;
right: 0;
bottom: 0;
text-align: center;
margin-right: 50px;
margin-bottom: 100px;
}
.add {
    font-weight: bolder;
    width: 50px;
    height: 50px;
    color: #fff;
    background-color: blue;
    padding: 10px;
    font-size: xx-large !important;
    border-radius: 50%;
}
.popup{
    width: 100%;
  height: 589px;
  background:#989898;
  opacity: 1;
  position: fixed !important;
  top: 0px;
  left: 0px;
  overflow: hidden;
}
.v81_1058 {
  width: 560px;
  height: 496px;
  background: rgba(255,255,255,1);
  opacity: 1;
  position: absolute;
  top: 46px;
  left: 367px;
  border-top-left-radius: 24px;
  border-top-right-radius: 24px;
  border-bottom-left-radius: 24px;
  border-bottom-right-radius: 24px;
  overflow: hidden;
}
.v81_1068 {
  width: 480px;
  height: 240px;
  background: rgba(238,242,255,1);
  opacity: 1;
  position: absolute;
  top: 97px;
  left: 40px;
  border-top-left-radius: 6px;
  border-top-right-radius: 6px;
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;
  overflow: hidden;
}
.v81_1070 {
  width: 480px;
  height: 40px;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  margin: 20px;
  opacity: 1;
  position: absolute;
  top: 353px;
  left: 40px;
  overflow: hidden;
}
.popup-title{
    width: 153px;
  color: rgba(75,85,99,1);
  position: absolute;
  top: 40px;
  left: 204px;
  font-family: Ubuntu;
  font-weight: Bold;
  font-size: 30px;
  opacity: 1;
  text-align: center;
}
.opinion {
  width: 100%;
  height: 100%;
  color: rgba(17,24,39,1);
  position: absolute;
  top: 0px;
  left: 0px;
  font-family: Ubuntu;
  font-weight: Regular;
  font-size: 16px;
  opacity: 1;
  text-align: left;
  outline-offset: 0px;
  outline-color: transparent;
  background-color: #eef2ff;
}
.v81_1070 {
  width: 480px;
  height: 40px;
  background: #eef2ff;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  margin: 20px;
  opacity: 1;
  position: absolute;
  top: 353px;
  left: 40px;
  overflow: hidden;
}
.post-url {
  width: 100%;
  color: rgba(17,24,39,1);
  position: absolute;
  top: 0px;
  left: 0px;
  font-family: Ubuntu;
  font-weight: Regular;
  font-size: 16px;
  opacity: 1;
  text-align: left;
  outline-offset: 0px;
  outline-color: transparent;
  background-color: #eef2ff;
}
.post-url:focus{
    outline-color: transparent;
  outline-offset: 0px;
}
.loader {
  position: fixed;
  top:200px;
  left:35%;
  z-index: 10;
}
.publish {
  width: 154px;
  height: 40px;
  background: rgba(13,104,210,1);
  color:white;
  opacity: 1;
  position: absolute;
  top: 0px;
  left: 326px;
  border-top-left-radius: 6px;
  border-top-right-radius: 6px;
  border-bottom-left-radius: 6px;
  border-bottom-right-radius: 6px;
  overflow: hidden;
}

</style>
