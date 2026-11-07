<?php require 'config.php';$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){check();$n=trim($_POST['nama']);$m=trim($_POST['email']);$p=$_POST['password'];
 if(!$n||!filter_var($m,FILTER_VALIDATE_EMAIL)||strlen($p)<6)$err='Isi nama, email valid, dan kata sandi minimal 6 karakter.';
 else try{$pdo->prepare('INSERT INTO users(nama,email,password) VALUES(?,?,?)')->execute([$n,$m,password_hash($p,PASSWORD_DEFAULT)]);header('Location: login.php');exit;}
 catch(PDOException $x){$err='Email sudah terdaftar.';}}
$title='Daftar';require 'includes/header.php'; ?>
<h1>Buat akun</h1><?php if($err): ?><p class="err"><?=$err?></p><?php endif; ?>
<form method="post" class="narrow"><input type="hidden" name="t" value="<?=csrf()?>"><label>Nama<input name="nama" required></label><label>Email<input type="email" name="email" required></label><label>Kata sandi<input type="password" name="password" required minlength="6"></label><button>Daftar</button></form>
<?php require 'includes/footer.php'; ?>
