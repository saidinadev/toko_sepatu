<?php require 'config.php';
$q=trim($_GET['q']??'');$c=(int)($_GET['c']??0);
$sql='SELECT * FROM products WHERE (nama LIKE ?)'.($c?' AND category_id=?':'').' ORDER BY id DESC';
$st=$pdo->prepare($sql);$st->execute($c?["%$q%",$c]:["%$q%"]);$items=$st->fetchAll();
$cats=$pdo->query('SELECT * FROM categories')->fetchAll();
$title='Produk';require 'includes/header.php'; ?>
<h1>Sepatu untuk setiap langkah</h1>
<form class="filter" method="get"><input name="q" value="<?=e($q)?>" placeholder="Cari sepatu"><select name="c"><option value="0">Semua kategori</option>
<?php foreach($cats as $k): ?><option value="<?=$k['id']?>" <?=$c==$k['id']?'selected':''?>><?=e($k['nama'])?></option><?php endforeach; ?></select><button>Cari</button></form>
<div class="grid"><?php foreach($items as $p): ?>
<a class="card" href="product.php?id=<?=$p['id']?>"><?=card_img($p)?><h3><?=e($p['nama'])?></h3><p><?=rp($p['harga'])?></p><?php if($p['stok']<1): ?><small>Stok habis</small><?php endif; ?></a>
<?php endforeach; if(!$items): ?><p>Produk tidak ditemukan. Coba kata kunci lain.</p><?php endif; ?></div>
<?php require 'includes/footer.php'; ?>
