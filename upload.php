<?php
  $connect = new PDO("mysql:host=localhost;dbname=senhas", "root", "");
  $msg = false;

  if(isset($_FILES['arquivo'])) {

    $ext = strtolower(substr($_FILES['arquivo']['name'], -4));
    $novo_nome = md5(time()) . $ext;
    $diretorio = "upload/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

    $sql = "INSERT INTO arquivo (arquivo, data) VALUES ('$novo_nome', NOW())";
    if($connect->query($sql)) {
      $msg = "Arquivo enviado com sucesso!";
    }else {
      $msg = "Falha ao enviar arquivo.";
    }
  }


?>
<h1>Upload de arquivo</h1>
<?php
if($msg != false) {
  echo "<p>$msg</p>";
}?>
<form action="upload.php" method="POST" enctype="multipart/form-data">
  Arquivo: <input type="file" required name="arquivo">
  <input type="submit" value="Salvar">
</form>