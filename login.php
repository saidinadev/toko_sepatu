<?php require 'config.php';$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){check();$st=$pdo->prepare('SELECT * FROM users WHERE email=?');$st->execute([trim($_POST['email'])]);$u=$st->fetch();
 if($u&&password_verify($_POST['password'],$u['password'])){session_regenerate_id(true);$_SESSION['user']=['id'=>$u['id'],'nama'=>$u['nama'],'role'=>$u['role']];header('Location: '.($u['role']==='admin'?'admin/':'index.php'));exit;}
 $err='Email atau kata sandi salah.';}
$title='Masuk';require 'includes/header.php'; ?>
<h1>Masuk</h1><?php if($err): ?><p class="err"><?=$err?></p><?php endif; ?>
<form method="post" class="narrow"><input type="hidden" name="t" value="<?=csrf()?>"><label>Email<input type="email" name="email" required></label><label>Kata sandi<input type="password" name="password" required></label><button>Masuk</button></form>
<?php require 'includes/footer.php'; ?>
