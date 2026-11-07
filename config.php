<?php
session_start();
$pdo=new PDO('mysql:host=localhost;dbname=toko_sepatu;charset=utf8mb4','root','',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
function e($s){return htmlspecialchars((string)$s,ENT_QUOTES,'UTF-8');}
function rp($n){return 'Rp '.number_format($n,0,',','.');}
function user(){return $_SESSION['user']??null;}
function need_login(){if(!user()){header('Location: login.php');exit;}}
function need_admin(){if(!user()||user()['role']!=='admin'){header('Location: ../login.php');exit;}}
function csrf(){return $_SESSION['t']??=bin2hex(random_bytes(16));}
function check(){if(!hash_equals(csrf(),$_POST['t']??''))die('Token tidak valid');}
function cart_count(){return array_sum($_SESSION['cart']??[]);}
function cart_items($pdo){$r=[];foreach($_SESSION['cart']??[] as $k=>$q){[$id,$s]=explode(':',$k);$st=$pdo->prepare('SELECT * FROM products WHERE id=?');$st->execute([$id]);if($p=$st->fetch()){$p['ukuran']=$s;$p['qty']=$q;$p['key']=$k;$r[]=$p;}}return $r;}
function card_img($p){return $p['gambar']?'<img src="'.e($p['gambar']).'" alt="'.e($p['nama']).'">':'<div class="ph">'.e(mb_substr($p['nama'],0,1)).'</div>';}
