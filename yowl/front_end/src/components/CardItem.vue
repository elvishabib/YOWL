<template>
    <div class="box">
        <div class="icon icon-shape-sm bg-primary text-white text-lg rounded-circle">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="author d-inline">{{ author }}</div>
        <div><strong>{{ noTitle(title) }}</strong></div>
        <div class="card-container">
            <div class="image">
                <RouterLink :to="'/detail/'+ id "><img :src=" noImage(image) "></RouterLink>
            <div class="media-icon">
                <i class="bi bi-hand-thumbs-up">{{ like }}</i>
                <i class="bi bi-chat"></i>
            </div>
            </div>

            <div class="text">
                    <p>{{ content.slice(0,150) }}</p>
                    <a :href="`${url}`" target="_blank"> <button class="site-name">{{ url.slice(8,15) }} ...</button> </a>
            </div>
        </div>
    </div>
</template>

<script>
import { RouterLink } from 'vue-router'

export default {
  props: {
    author: String,
    title: String,
    like: Number,
    content: String,
    url: String,
    image: String,
    id: Number
  },
  components: { RouterLink },
  methods: {
    // Default image handle
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
</style>
