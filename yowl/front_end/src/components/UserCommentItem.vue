<template>
    <tr>
        <td>
            <a class="text-heading font-semibold" href="#">
                {{ content }}
            </a>
        </td>
        <td>
            {{ created_at }}
        </td>
        <td class="text-end">
            <RouterLink :to="''" class="btn btn-sm btn-neutral">View</RouterLink>
            <RouterLink :to="'/editcomment/'+id" class="btn btn-sm btn-neutral"><button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
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
    content: String,
    created_at: String,
    status: Number,
    id: Number
  },
  data () {
    return {
    }
  },
  methods: {
    ...mapActions('comment', ['deletecomment', 'editcomment']),
    DeletePost (postId) {
      const post = {
        id: postId,
        statut: 1
      }
      this.deletecomment(post)
    },
    EditPost (postId) {
      const post = {
        id: postId,
        statut: 1
      }
      this.comment(post)
    }
  }
}
</script>
