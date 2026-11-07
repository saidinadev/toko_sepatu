<?php require 'config.php';need_login();
$items=cart_items($pdo);if(!$items){header('Location: cart.php');exit;}
$total=array_sum(array_map(fn($i)=>$i['harga']*$i['qty'],$items));$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){check();$alamat=trim($_POST['alamat']);
 if(strlen($alamat)<10)$err='Alamat pengiriman terlalu pendek.';
 else try{$pdo->beginTransaction();
  $pdo->prepare('INSERT INTO orders(user_id,total,alamat) VALUES(?,?,?)')->execute([user()['id'],$total,$alamat]);$oid=$pdo->lastInsertId();
  foreach($items as $i){$u=$pdo->prepare('UPDATE products SET stok=stok-? WHERE id=? AND stok>=?');$u->execute([$i['qty'],$i['id'],$i['qty']]);
   if(!$u->rowCount())throw new Exception('Stok '.$i['nama'].' tidak mencukupi.');
   $pdo->prepare('INSERT INTO order_items(order_id,product_id,ukuran,qty,harga) VALUES(?,?,?,?,?)')->execute([$oid,$i['id'],$i['ukuran'],$i['qty'],$i['harga']]);}
  $pdo->commit();unset($_SESSION['cart']);header('Location: orders.php?ok=1');exit;
 }catch(Exception $x){$pdo->rollBack();$err=$x->getMessage();}}
$title='Checkout';require 'includes/header.php'; ?>
<h1>Checkout</h1><p>Total pembayaran: <b><?=rp($total)?></b></p><?php if($err): ?><p class="err"><?=e($err)?></p><?php endif; ?>
<form method="post"><input type="hidden" name="t" value="<?=csrf()?>"><label>Alamat pengiriman<textarea name="alamat" rows="4" required></textarea></label><button>Buat pesanan</button></form>
<?php require 'includes/footer.php'; ?>
