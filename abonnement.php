<?php
require_once('functions.php');
?>

<html>
<style>
 .pricing-table {
  display: flex;
  flex-flow: row wrap;
  max-width: 80%;
}

.item { 
  flex: 1 0 280px;
  display: flex;
  flex-flow: column;
}

.item__info {
  display: flex;
  align-items: center;
  margin-top: auto;
}

.pricing-table {
  margin: 0 auto;
  font-family: Helvetica;
  margin-bottom :70px;
  margin-top :70px;
}

.item {
  margin: 0 10px 10px;
  border: 3px solid #a6a6a6;
}
.item--cta {
  border-color: #9dc7e3;
}

.item__header {
  font-size: 2.5rem;
  margin: 0 0 0.6rem;
  background: #212121;
  color: #ededed;
  padding: 10px;
  text-align: center;
}
.item__header--cta {
  background: #0476bd;
}
.item__info {
  border-top: 1px solid #ccc;
}
.item__info__price {
  font-size: 2rem;
}

.btn {
  margin: 10px;
  background: #9cc23c;
  display: inline-block;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  color: #fff;
  font-size: 1rem;
  text-decoration: none;
  transition: background 0.3s ease;
}

.btn:hover {
  background: #8cb12d;
}

</style>
<body>
    
<section class="pricing-table">
  <section class='item'>
    <h1 class="item__header">Basic</h1>
    <ul>
      <li>Reduced access
    </ul>
    <div class="item__info">
      <a button class="btn" href="index.php">Choose this plan></a>
      <div class="item__info__price">free</div>
    </div>
  </section>
  <section class='item item--cta'>
    <h1 class="item__header item__header--cta">Premium</h1>
    <ul>
      <li>Full access
      <li>Promotion code
      <li>More advantage
    </ul>
    <div class="item__info">
      <a button class="btn" href="Premium.php">Choose this plan></a>
      <div class="item__info__price">20.00€</div>
    </div>
  </section>
</section>

<script>
  const items = document.querySelectorAll('.item');
  
  items.forEach(item => {
    item.addEventListener('mouseover', () => {
      item.classList.add('item--hover');
    });
    
    item.addEventListener('mouseout', () => {
      item.classList.remove('item--hover');
    });
  });
</script>
</body>
</html>
