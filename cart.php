<?php require 'config.php';
if($_SERVER['REQUEST_METHOD']==='POST'){check();
 if(isset($_POST['hapus']))unset($_SESSION['cart'][$_POST['hapus']]);
 if(isset($_POST['qty']))foreach($_POST['qty'] as $k=>$v){$v=(int)$v;if($v<1)unset($_SESSION['cart'][$k]);elseif(isset($_SESSION['cart'][$k]))$_SESSION['cart'][$k]=$v;}
 header('Location: cart.php');exit;}
$items=cart_items($pdo);$total=0;$title='Keranjang';require 'includes/header.php'; ?>
<h1>Keranjang belanja</h1>
<?php if(!$items): ?><p>Keranjang masih kosong. <a href="index.php">Lihat produk</a></p><?php else: ?>
<form method="post"><input type="hidden" name="t" value="<?=csrf()?>"><table><tr><th>Produk</th><th>Ukuran</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th></th></tr>
<?php foreach($items as $i): $sub=$i['harga']*$i['qty'];$total+=$sub; ?>
<tr><td><?=e($i['nama'])?></td><td><?=$i['ukuran']?></td><td><?=rp($i['harga'])?></td><td><input type="number" name="qty[<?=e($i['key'])?>]" value="<?=$i['qty']?>" min="0" max="<?=$i['stok']?>"></td><td><?=rp($sub)?></td><td><button name="hapus" value="<?=e($i['key'])?>">Hapus</button></td></tr>
<?php endforeach; ?></table><p class="price">Total: <?=rp($total)?></p><button>Perbarui jumlah</button> <a class="btn" href="checkout.php">Lanjut ke checkout</a></form><?php endif;
require 'includes/footer.php'; ?>
