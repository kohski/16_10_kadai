<?php
session_start();
include("functions.php");
chk_ssid();
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>仕訳入力</legend>
     <label>
       <span>【借方科目】</span><br>
       <input type="radio" name="debit_subject" value="資産" id="asset">資産&emsp;
       <input type="radio" name="debit_subject" value="費用" id="expense">費用
      </label><br>
     <label id="debit_detail">【借方細目】<br><br><br></label><br>
     <label>【貸方科目】<br>
     <input type="radio" name="cresit_subject" value="負債" id="liability">負債
       <input type="radio" name="cresit_subject" value="純資産" id="net_asset">純資産
       <input type="radio" name="cresit_subject" value="収入" id="revenue">収入
     </label><br>
     <label id="cresit_detail">【貸方細目】<br><br><br></label><br>
     <label>金額<input type="text" name="amount"></label><br>
     <label>消費税額<input type="text" name="tax"></label><br>
     <label><textArea name="comment" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
     <a href="select.php">一覧表示</a>
    </fieldset>
  </div>



<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script>
$("#asset").on("click",function(){
  $("#debit_detail").empty();
  $('<span>【借方細目】</span><br>').appendTo("#debit_detail");
  $('<input type="radio" name="debit_detail" value="現金"><span>現金</span>').appendTo("#debit_detail");
  $('<input type="radio" name="debit_detail" value="売掛金"><span>売掛金</span>').appendTo("#debit_detail");
  $('<input type="radio" name="debit_detail" value="未収入金"><span>未収入金</span>').appendTo("#debit_detail");
  $('<input type="radio" name="debit_detail" value="受取手形"><span>受取手形</span><br><br>').appendTo("#debit_detail");
});

$("#expense").on("click",function(){
  $("#debit_detail").empty();
  $('<span>【借方細目】</span><br>').appendTo("#debit_detail");
  $('<input type="radio" name="debit_detail" value="仕入"><span>仕入</span>').appendTo("#debit_detail");
  $('<input type="radio" name="debit_detail" value="営業費用"><span>営業費用</span>').appendTo("#debit_detail");
  $('<input type="radio" name="debit_detail" value="営業外費用"><span>営業外費用</span><br><br>').appendTo("#debit_detail");
});


$("#liability").on("click",function(){
  $("#cresit_detail").empty();
  $('<span>【貸方細目】</span><br>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="買掛金"><span>買掛金</span>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="未払金"><span>未払金</span>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="借入金"><span>短期借入金</span>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="借受金"><span>仮受金</span><br><br>').appendTo("#cresit_detail");
});

$("#net_asset").on("click",function(){
  $("#cresit_detail").empty();
  $('<span>【貸方細目】</span><br>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="純資産"><span>純資産</span>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="利益剰余金"><span>利益剰余金</span>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="資本剰余金"><span>資本剰余金</span><br><br>').appendTo("#cresit_detail");
});

$("#revenue").on("click",function(){
  $("#cresit_detail").empty();
  $('<span>【貸方細目】</span><br>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="売上高"><span>売上高</span>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="受取利息"><span>受取利息</span>').appendTo("#cresit_detail");
  $('<input type="radio" name="cresit_detail" value="営業外収益"><span>営業外収益</span><br><br>').appendTo("#cresit_detail");
});



</script>
</form>
<!-- Main[End] -->


</body>
</html>
