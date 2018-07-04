<?php
session_start();
include("functions.php");
chk_ssid();

//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bookkeeping_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td>'.$result["id"].'</td>';
    $view .= '<td>'.$result["debit_subject"].'</td>';
    $view .= '<td>'.$result["debit_detail"].'</td>';
    $view .= '<td>'.$result["cresit_subject"].'</td>';
    $view .= '<td>'.$result["cresit_detail"].'</td>';
    $view .= '<td class="amount">'.$result["amount"].'</td>';
    $view .= '<td>'.$result["tax"].'</td>';
    $view .= '<td>'.$result["comment"].'</td>';
    $view .= '<td>'.$result["initial_date"].'</td>';
    $view .= '<td>'.$result["update_date"].'</td>';
    $view .= '<td><a href="detail.php?id='.$result["id"].'">[更新]</a></td>';
    $view .= '<td><a href="delete.php?id='.$result["id"].'">[削除]</a></td>';
    $view .= '</tr>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>仕訳一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
  div{padding: 10px;font-size:16px;}
  table {
    width: 100%;
  }
  table th {
    white-space: nowrap;
    width: 100px;
  }
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      <a class="navbar-brand" href="logout.php">LOGOUT</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <table>
      <tr>
        <td>id</td>
        <td>借方科目</td>
        <td>借方細目</td>
        <td>貸方科目</td>
        <td>貸方細目</td>
        <td>金額</td>
        <td>消費税</td>
        <td>備考</td>
        <td>登録日付</td>
        <td>更新日付</td>
        <td>更新</td>
        <td>削除</td>
      </tr>
      <?php echo $view?>
    </table>
    <a href="index.php">登録</a>
  </div>
</div>
<!-- Main[End] -->


<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script>
function addFigure(str) {
    var num = new String(str).replace(/,/g, "");
    while(num != (num = num.replace(/^(-?\d+)(\d{3})/, "$1,$2")));
    return num;
}

var amount = addFigure($(".amount").val());
$(".amount").innerHtml=amount;


</script>



</body>
</html>
