<template>
    <div>
      <h1>{{ pageTitle }}</h1>
      <p>{{ pageDescription }}</p>
    </div>
  </template>

<script>
export default {
  data () {
    return {
      pageTitle: '',
      pageDescription: ''
    }
  },
  mounted () {
    fetch('https://epitech.eu')
      .then(response => response.json())
      .then(data => {
        this.pageTitle = data.pageTitle
        this.pageDescription = data.pageDescription
      })
      .catch(error => {
        console.log(error)
      })
  }
}
</script>

<!-- import Cookies from 'js-cookie';

export default {
  data() {
    return {
      name: '',
    };
  },
  mounted() {
    // Get the value of the "name" cookie, if it exists
    this.name = Cookies.get('name');

    // Set the value of the "name" cookie to "John Doe"
    Cookies.set('name', 'John Doe', { expires: 7 });

    // Delete the "name" cookie
    Cookies.remove('name');
  }, -->
};
