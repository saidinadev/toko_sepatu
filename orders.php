<?php require 'config.php';need_login();
$st=$pdo->prepare('SELECT * FROM orders WHERE user_id=? ORDER BY id DESC');$st->execute([user()['id']]);$os=$st->fetchAll();
$title='Pesanan saya';require 'includes/header.php'; ?>
<h1>Pesanan saya</h1><?php if(isset($_GET['ok'])): ?><p class="ok">Pesanan berhasil dibuat. Silakan lakukan pembayaran.</p><?php endif; ?>
<?php foreach($os as $o): $it=$pdo->prepare('SELECT oi.*,p.nama FROM order_items oi JOIN products p ON p.id=oi.product_id WHERE order_id=?');$it->execute([$o['id']]); ?>
<div class="box"><b>Pesanan #<?=$o['id']?></b> - <?=e($o['status'])?> - <?=rp($o['total'])?> <small><?=$o['created_at']?></small><ul>
<?php foreach($it as $r): ?><li><?=e($r['nama'])?> (ukuran <?=$r['ukuran']?>) x<?=$r['qty']?></li><?php endforeach; ?></ul></div>
<?php endforeach; if(!$os): ?><p>Belum ada pesanan.</p><?php endif; require 'includes/footer.php'; ?>
