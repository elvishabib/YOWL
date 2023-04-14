<template>
    <tr>
        <td>
            <img alt="..."
                src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
                class="avatar avatar-sm rounded-circle me-2">
            <a class="text-heading font-semibold" href="#">
                {{ firstname }} {{ lastname }}
            </a>
        </td>
        <td>
            {{ created_at }}
        </td>
        <td>
                {{ birthdate }}
        </td>
        <td>
            {{ email }}
        </td>
        <td>
            <span class="badge badge-lg badge-dot">
                <template v-if="status === 0">
                    <i class="bg-warning"></i>
                </template>
                <template v-if="status === 1">
                    <i class="bg-success"></i>
                </template>
                <template v-if="status === -1">
                    <i class="bg-danger"></i>
                </template>
            </span>
        </td>
        <td class="text-end">
            <a href="#" class="btn btn-sm btn-neutral">View</a>
            <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                <i class="bi bi-trash"></i>
            </button>
        </td>
    </tr>
    </template>

<script>
export default {
  props: {
    firstname: String,
    lastname: String,
    birthdate: String,
    created_at: String,
    email: String,
    status: Number
  },
  data () {
    return {
    }
  }
}
</script>
