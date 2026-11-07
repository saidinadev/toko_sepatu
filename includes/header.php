<?php $base=$base??''; ?><!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=e($title??'Beranda')?> - Langkah</title><link rel="stylesheet" href="<?=$base?>assets/style.css"></head><body>
<header class="top"><a class="logo" href="<?=$base?>index.php">Langkah</a><nav>
<a href="<?=$base?>index.php">Produk</a><a href="<?=$base?>cart.php">Keranjang (<?=cart_count()?>)</a>
<?php if(user()): ?><a href="<?=$base?>orders.php">Pesanan</a><?php if(user()['role']==='admin'): ?><a href="<?=$base?>admin/">Admin</a><?php endif; ?><a href="<?=$base?>logout.php">Keluar</a>
<?php else: ?><a href="<?=$base?>login.php">Masuk</a><a href="<?=$base?>register.php">Daftar</a><?php endif; ?></nav></header><main>
