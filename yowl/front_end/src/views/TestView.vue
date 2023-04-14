<template>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<div class="product-card">
  <div class="publisher-info">
    <img src="../assets/logo.png" alt="Publisher Pic">
    <h3>Publisher Name</h3>
  </div>
  <h2>Product Title</h2>
  <div class="product-info">
    <div class="product-image">
      <img src="../assets/newLogo.png" alt="Product Image">
      <ul class="icons">
        <li><i class="fa fa-heart"></i></li>
        <li><i class="fa fa-share"></i></li>
        <li><i class="fa fa-shopping-cart"></i></li>
        <li><i class="fa fa-eye"></i></li>
      </ul>
    </div>
    <div class="product-description">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in bibendum tellus. Fusce luctus orci ut lacus malesuada dapibus. Duis eget felis a turpis rutrum efficitur ac ac nulla.</p>
      <button>Add to Cart</button>
    </div>
  </div>
</div>
</template>

<style>
.product-card {
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows: auto auto 1fr;
  gap: 10px;
  padding: 10px;
  border: 1px solid #ccc;
}

.publisher-info {
  display: flex;
  align-items: center;
  gap: 10px;
}

.publisher-info img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.product-info {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 10px;
}

.product-image img {
  width: 100%;
}

.icons {
  display: flex;
  gap: 10px;
  list-style: none;
  margin: 0;
  padding: 0;
}

.icons li {
  font-size: 1.5em;
}
.product-description {
    width: 300px;
  height: 300px;
}
.product-description button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.product-description button:hover {
  background-color: #0062cc;
}
</style>
