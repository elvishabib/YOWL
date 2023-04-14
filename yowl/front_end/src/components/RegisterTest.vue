<template>
    <button @click="createPost">Register test</button>
</template>
<!-- <script>
import { mapActions } from 'vuex'
export default {
  methods: {
    ...mapActions('user', ['addUsers']),
    createPost () {
      console.log('connection...')
      const register = {
        email: 'user@gmail.com',
        password: 'Phidias2002'
      }
      this.addUsers(register)
    }
  }
}
</script> -->

<script>
// Define the URL of the API endpoint
const API_URL = 'http://localhost:8000/api/users/register'

// Define the data that will be sent in the request
const requestData = {
  username: 'johndoe',
  email: 'johndoe@example.com',
  firstName: 'John',
  lastName: 'Doe',
  password: 'password',
  password_confirmation: 'password',
  birthdate: '1990-01-01'
}

// Define the options for the fetch request
const requestOptions = {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify(requestData)
}

// Send the fetch request
fetch(API_URL, requestOptions)
  .then(response => response.json())
  .then(data => {
    // Handle successful response
    console.log(data)
  })
  .catch(error => {
    // Handle error response
    console.error(error)
  })

</script>
