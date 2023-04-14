<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <div v-if="toggle" @click="create" id="product-add"><i class="fa fa-plus add"></i></div>
    <div v-else id="product-add">
    <form id="add">
        <input type="text" placeholder="AAAAAAAAAAAAAAAAAA" id="link">
        <textarea cols="30" rows="5" id="content">
        </textarea>
    </form>
    </div>
</template>

<script>
export default {
  data () {
    return {
      toggle: true
    }
  },
  methods: {
    create () {
      this.toggle = !this.toggle
    }
  }
}
</script>

<style>
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
#add {
    border-radius: 10px;
    border: 1px solid #555;
    z-index: 10;
    background-color: white;
    width: 33%;
    position: fixed;
    top: 30%;
    left:30%;
    padding: 10px;
}
#content {
    display: block;
    background: rgba(238,242,255,1);;
    margin-top: 10px;
    border-radius: 10px;
    margin-left: 5%;
    margin-right: 5%;
    width: 90%;
}
#link {
    border: 0.5px solid #555 !important;
    width: 90% !important;
    height: 40px !important;
    background: rgba(238,242,255,1);;
    margin-top: 10px;
    border-radius: 10px;
    margin-left: 5%;
    margin-right: 5%;
}
</style>
