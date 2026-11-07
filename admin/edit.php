<?php require '../config.php';need_admin();
$id=(int)($_GET['id']??0);
$st=$pdo->prepare('SELECT * FROM products WHERE id=?');$st->execute([$id]);$p=$st->fetch();
if(!$p){header('Location: index.php');exit;}
if($_SERVER['REQUEST_METHOD']==='POST'){check();
 $pdo->prepare('UPDATE products SET category_id=?,nama=?,deskripsi=?,harga=?,stok=?,gambar=? WHERE id=?')
     ->execute([$_POST['cat']?:null,trim($_POST['nama']),trim($_POST['deskripsi']),(int)$_POST['harga'],(int)$_POST['stok'],trim($_POST['gambar'])?:null,$id]);
 header('Location: index.php');exit;}
$cats=$pdo->query('SELECT * FROM categories')->fetchAll();
$base='../';$title='Edit produk';require '../includes/header.php'; ?>
<h1>Edit produk</h1>
<form method="post" class="narrow"><input type="hidden" name="t" value="<?=csrf()?>">
<label>Nama<input name="nama" required value="<?=e($p['nama'])?>"></label>
<label>Kategori<select name="cat"><option value="">- Tanpa kategori -</option><?php foreach($cats as $c): ?><option value="<?=$c['id']?>" <?=$c['id']==$p['category_id']?'selected':''?>><?=e($c['nama'])?></option><?php endforeach; ?></select></label>
<label>Deskripsi<textarea name="deskripsi"><?=e($p['deskripsi'])?></textarea></label>
<label>Harga (Rp)<input type="number" name="harga" required min="0" value="<?=(int)$p['harga']?>"></label>
<label>Stok<input type="number" name="stok" required min="0" value="<?=(int)$p['stok']?>"></label>
<label>URL gambar (opsional)<input name="gambar" value="<?=e($p['gambar'])?>"></label>
<button>Simpan perubahan</button> <a class="btn" style="background:var(--mut)" href="index.php">Batal</a></form>
<?php require '../includes/footer.php'; ?>
