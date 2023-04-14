<template>
    <tr>
        <td>
            <span class="text-heading font-semibold" >
                {{ title }}
            </span>
        </td>
        <td>
            {{ created_at }}
        </td>
        <td>
                {{ like }}
        </td>
        <td>
            <span class="badge badge-lg badge-dot">
                <template v-if="status===1">
                    <i class="bg-warning"></i>
                </template>
                <template v-if="status===0">
                    <i class="bg-success"></i>
                </template>
            </span>
        </td>
        <td class="text-end">
            <RouterLink :to="'/detail/'+id" class="btn btn-sm btn-neutral">View</RouterLink>
            <RouterLink :to="'/editpost/'+id" class="btn btn-sm btn-neutral"><button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                <i class="bi bi-pencil"></i>
            </button></RouterLink>
            <button type="button" @click.prevent="DeletePost({id})" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                <i class="bi bi-trash"></i>
            </button>
        </td>
    </tr>
    </template>

<script>
import { mapActions } from 'vuex'
export default {
  props: {
    title: String,
    content: String,
    url: String,
    created_at: String,
    status: Number,
    like: Number,
    id: Number
  },
  data () {
    return {
    }
  },
  methods: {
    ...mapActions('post', ['deletePost', 'editPost']),
    DeletePost (postId) {
      const post = {
        id: postId,
        statut: 1
      }
      this.deletePost(post)
    },
    noTitle (url) {
      if (url === '') {
        url = this.url
      }
      return url
    },
    EditPost (postId) {
      const post = {
        id: postId,
        statut: 1
      }
      this.editPost(post)
    }
  }
}
</script>
