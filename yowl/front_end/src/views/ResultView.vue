<template>
<Header @searchresult="result"/>
{{ r }}
</template>

<script>
import Header from '../components/HeaderForm.vue'
export default {
  data () {
    return {
      r: []
    }
  },
  components: {
    Header
  },
  methods: {
    result (allPosts) {
      this.r = allPosts
    }
  }
}
</script>
