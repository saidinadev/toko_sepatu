<?php require '../config.php';need_admin();
if($_SERVER['REQUEST_METHOD']==='POST'){check();
 if(isset($_POST['tambah']))$pdo->prepare('INSERT INTO products(category_id,nama,deskripsi,harga,stok,gambar) VALUES(?,?,?,?,?,?)')->execute([$_POST['cat'],trim($_POST['nama']),trim($_POST['deskripsi']),(int)$_POST['harga'],(int)$_POST['stok'],trim($_POST['gambar'])?:null]);
 if(isset($_POST['hapus'])){try{$pdo->prepare('DELETE FROM products WHERE id=?')->execute([(int)$_POST['hapus']]);}catch(PDOException $x){$_SESSION['flash']='Produk tidak bisa dihapus karena sudah pernah dipesan.';}}
 if(isset($_POST['status']))$pdo->prepare('UPDATE orders SET status=? WHERE id=?')->execute([$_POST['status'],(int)$_POST['oid']]);
 header('Location: index.php');exit;}
$ps=$pdo->query('SELECT * FROM products ORDER BY id DESC')->fetchAll();$cats=$pdo->query('SELECT * FROM categories')->fetchAll();
$os=$pdo->query('SELECT o.*,u.nama FROM orders o JOIN users u ON u.id=o.user_id ORDER BY o.id DESC')->fetchAll();
$base='../';$title='Admin';require '../includes/header.php'; $t=csrf(); ?>
<h1>Kelola toko</h1>
<p><a class="btn" href="index.php">Produk &amp; Pesanan</a> <a class="btn" href="kategori.php">Kategori</a></p>
<?php if(!empty($_SESSION['flash'])): ?><p class="err"><?=e($_SESSION['flash'])?></p><?php unset($_SESSION['flash']); endif; ?>
<h2>Tambah produk</h2>
<form method="post" class="narrow"><input type="hidden" name="t" value="<?=$t?>"><input type="hidden" name="tambah" value="1"><label>Nama<input name="nama" required></label>
<label>Kategori<select name="cat"><?php foreach($cats as $c): ?><option value="<?=$c['id']?>"><?=e($c['nama'])?></option><?php endforeach; ?></select></label>
<label>Deskripsi<textarea name="deskripsi"></textarea></label><label>Harga (Rp)<input type="number" name="harga" required min="0"></label><label>Stok<input type="number" name="stok" required min="0"></label><label>URL gambar (opsional)<input name="gambar"></label><button>Simpan produk</button></form>
<h2>Produk</h2><table><tr><th>Nama</th><th>Harga</th><th>Stok</th><th></th></tr>
<?php foreach($ps as $p): ?><tr><td><?=e($p['nama'])?></td><td><?=rp($p['harga'])?></td><td><?=$p['stok']?></td><td><a class="btn" href="edit.php?id=<?=$p['id']?>">Edit</a> <form method="post" style="display:inline" onsubmit="return confirm('Hapus produk ini?')"><input type="hidden" name="t" value="<?=$t?>"><button name="hapus" value="<?=$p['id']?>">Hapus</button></form></td></tr><?php endforeach; ?></table>
<h2>Pesanan masuk</h2><table><tr><th>#</th><th>Pelanggan</th><th>Total</th><th>Alamat</th><th>Status</th></tr>
<?php foreach($os as $o): ?><tr><td><?=$o['id']?></td><td><?=e($o['nama'])?></td><td><?=rp($o['total'])?></td><td><?=e($o['alamat'])?></td><td><form method="post"><input type="hidden" name="t" value="<?=$t?>"><input type="hidden" name="oid" value="<?=$o['id']?>"><select name="status" onchange="this.form.submit()">
<?php foreach(['pending','dibayar','dikirim','selesai','batal'] as $s) echo "<option ".($o['status']===$s?'selected':'').">$s</option>"; ?></select></form></td></tr><?php endforeach; ?></table>
<?php require '../includes/footer.php'; ?>
