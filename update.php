<?php
session_start();
include("functions.php");
chk_ssid();

if(
  !isset($_POST["debit_subject"])||$_POST["debit_subject"]==""||
  !isset($_POST["debit_detail"])||$_POST["debit_detail"]==""||
  !isset($_POST["cresit_subject"])||$_POST["cresit_subject"]==""||
  !isset($_POST["cresit_detail"])||$_POST["cresit_detail"]==""||
  !isset($_POST["amount"])||$_POST["amount"]==""||
  !isset($_POST["tax"])||$_POST["tax"]==""  
  ){
  exit('ParamError');
}

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$id= $_POST["id"];
$debit_subject = $_POST["debit_subject"];
$debit_detail = $_POST["debit_detail"];
$cresit_subject = $_POST["cresit_subject"];
$cresit_detail = $_POST["cresit_detail"];
$amount = $_POST["amount"];
$tax = $_POST["tax"];
$comment = $_POST["comment"];
$update_date=date("Y-m-d H:i:s");

//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_10_kadai;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

// //３．データ登録SQL作成
$sql="UPDATE gs_bookkeeping_table SET debit_subject=:a1,debit_detail=:a2,cresit_subject=:a3,cresit_detail=:a4,amount=:a5,tax=:a6,comment=:a7,update_date=:a8 WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $debit_subject, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $debit_detail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $cresit_subject, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $cresit_detail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $tax, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a7', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a8', $update_date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
// //４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: select.php"); //ここの半角スペースは必須！！！！
}
?>
