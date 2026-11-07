<?php require 'config.php';
$st=$pdo->prepare('SELECT * FROM products WHERE id=?');$st->execute([(int)($_GET['id']??0)]);$p=$st->fetch();
if(!$p){http_response_code(404);die('Produk tidak ditemukan');}
if($_SERVER['REQUEST_METHOD']==='POST'){check();
 $s=(int)$_POST['ukuran'];$q=max(1,(int)$_POST['qty']);
 if($s>=36&&$s<=45&&$p['stok']>=$q){$k=$p['id'].':'.$s;$_SESSION['cart'][$k]=min($p['stok'],($_SESSION['cart'][$k]??0)+$q);header('Location: cart.php');exit;}
 $err='Pilih ukuran dan pastikan jumlah tidak melebihi stok.';}
$title=$p['nama'];require 'includes/header.php'; ?>
<div class="detail"><div><?=card_img($p)?></div><div><h1><?=e($p['nama'])?></h1><p class="price"><?=rp($p['harga'])?></p><p><?=nl2br(e($p['deskripsi']))?></p><p>Stok: <?=$p['stok']?></p>
<?php if(!empty($err)): ?><p class="err"><?=$err?></p><?php endif; if($p['stok']>0): ?>
<form method="post"><input type="hidden" name="t" value="<?=csrf()?>"><label>Ukuran <select name="ukuran"><?php for($i=36;$i<=45;$i++) echo "<option>$i</option>"; ?></select></label>
<label>Jumlah <input type="number" name="qty" value="1" min="1" max="<?=$p['stok']?>"></label><button>Tambah ke keranjang</button></form><?php endif; ?></div></div>
<?php require 'includes/footer.php'; ?>
