<?php require '../config.php';need_admin();
if($_SERVER['REQUEST_METHOD']==='POST'){check();
 $nama=trim($_POST['nama']??'');
 if(isset($_POST['tambah'])&&$nama!=='')$pdo->prepare('INSERT INTO categories(nama) VALUES(?)')->execute([$nama]);        // Create
 if(isset($_POST['ubah'])&&$nama!=='')$pdo->prepare('UPDATE categories SET nama=? WHERE id=?')->execute([$nama,(int)$_POST['ubah']]); // Update
 if(isset($_POST['hapus']))$pdo->prepare('DELETE FROM categories WHERE id=?')->execute([(int)$_POST['hapus']]);               // Delete
 header('Location: kategori.php');exit;}
$cats=$pdo->query('SELECT c.*,(SELECT COUNT(*) FROM products p WHERE p.category_id=c.id) AS jml FROM categories c ORDER BY c.id')->fetchAll(); // Read
$base='../';$title='Kategori';require '../includes/header.php';$t=csrf(); ?>
<h1>Kelola kategori</h1>
<p><a class="btn" href="index.php">Produk &amp; Pesanan</a> <a class="btn" href="kategori.php">Kategori</a></p>
<h2>Tambah kategori</h2>
<form method="post" class="narrow"><input type="hidden" name="t" value="<?=$t?>"><input type="hidden" name="tambah" value="1">
<label>Nama kategori<input name="nama" required maxlength="50"></label><button>Simpan kategori</button></form>
<h2>Daftar kategori</h2>
<table><tr><th>ID</th><th>Nama</th><th>Jumlah produk</th><th></th></tr>
<?php foreach($cats as $c): ?><tr><td><?=$c['id']?></td>
<td><form method="post" style="display:flex;gap:8px"><input type="hidden" name="t" value="<?=$t?>"><input name="nama" required maxlength="50" value="<?=e($c['nama'])?>" style="width:200px"><button name="ubah" value="<?=$c['id']?>">Ubah</button></form></td>
<td><?=$c['jml']?></td>
<td><form method="post" onsubmit="return confirm('Hapus kategori ini? Produk di dalamnya menjadi tanpa kategori.')"><input type="hidden" name="t" value="<?=$t?>"><button name="hapus" value="<?=$c['id']?>">Hapus</button></form></td></tr>
<?php endforeach; ?></table>
<?php require '../includes/footer.php'; ?>
