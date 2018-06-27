<?php
    session_start();
    $mysqli  = mysqli_connect("localhost","root","","dump");
    if (!$mysqli) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $res = $mysqli->query("SELECT * FROM books");
    $i=0;
?>
  <style>
    table {
        border-spacing: 0;
        border-collapse: collapse;
    }
    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }
    table th {
        background: #eee;
    }
<?php
    $_SESSION["isbn"] = $_GET["isbn"];
    $isbnecho=$_SESSION["isbn"];
    $_SESSION["name"] = $_GET["name"];
    $nameecho=$_SESSION["name"];
    $_SESSION["author"] = $_GET["author"];
    $authorecho=$_SESSION["author"];
?>
  </style>
  <form action="index.php" method="GET">
    <input type="text" name="isbn" placeholder="<?php echo(!empty($_GET["isbn"])) ? "$isbnecho":'IBSN' ;?>"value="" />
    <input type="text" name="name" placeholder="<?php echo(!empty($_GET["name"])) ? "$nameecho":'Название книги' ;?>" value="" />
    <input type="text" name="author" placeholder="<?php echo(!empty($_GET["author"])) ? "$authorecho":'Автор' ;?>" value="" />
    <input type="submit" value="Поиск" />
    <input type="button" value="Сбросить" onclick="location='index.php' "/>
  </form>
  <table>
    <tr>
      <th>N</th>
      <th>Книга</th>
      <th>Автор</th>
      <th>Год выпуска</th>
      <th>ISBN</th>
      <th>Раздел</th>
    </tr>
<?php
      if (!empty($_GET["name"])&&!empty($_GET["isbn"])) {
      $author = $_GET["name"];
      $isbn = $_GET["isbn"];
      $res = $mysqli->query("SELECT * FROM books  WHERE isbn='$isbn' and name='$name' ");
      $row = $res->fetch_assoc();
      ?>
    <tr>
      <td style="width:6px valign=" center" align="center"><?php echo $row['id']; ?> </td>
      <td style="width:400px valign=" center" align="center"><?php echo $row['name']; ?></td>
      <td style="width:180px valign=" center" align="center"><?php echo $row['author']; ?></td>
      <td style="width:50px valign=" center" align="center"><?php echo $row['year']; ?></td>
      <td style="width:150px valign=" center" align="center""><?php echo $row['isbn']; ?></td>
      <td style="width:200px valign=" center" align="center""><?php echo $row['genre']; ?></td>
    </tr>
<?php
    }

    if (!empty($_GET["author"])&&!empty($_GET["isbn"])) {
        $author = $_GET["author"];
        $isbn = $_GET["isbn"];
        $res = $mysqli->query("SELECT * FROM books  WHERE isbn='$isbn' and author='$author' ");
        $row = $res->fetch_assoc();
        ?>
    <tr>
      <td style="width:6px valign=" center" align="center"><?php echo $row['id']; ?> </td>
      <td style="width:400px valign=" center" align="center"><?php echo $row['name']; ?></td>
      <td style="width:180px valign=" center" align="center"><?php echo $row['author']; ?></td>
      <td style="width:50px valign=" center" align="center"><?php echo $row['year']; ?></td>
      <td style="width:150px valign=" center" align="center""><?php echo $row['isbn']; ?></td>
      <td style="width:200px valign=" center" align="center""><?php echo $row['genre']; ?></td>
    </tr>
<?php
    }
    if (!empty($_GET["author"])&&!empty($_GET["name"])){
        $author = $_GET["author"];
        $name=$_GET["name"];
        $res = $mysqli->query("SELECT * FROM books  WHERE name='$name' and author='$author' ");
        $row = $res->fetch_assoc();
?>
    <tr>
      <td style="width:6px valign="center" align="center"><?php echo $row['id']; ?> </td>
      <td style="width:400px valign=" center" align="center"><?php echo $row['name']; ?></td>
      <td style="width:180px valign=" center" align="center"><?php echo $row['author']; ?></td>
      <td style="width:50px valign=" center" align="center"><?php echo $row['year']; ?></td>
      <td style="width:150px valign=" center" align="center""><?php echo $row['isbn']; ?></td>
      <td style="width:200px valign=" center" align="center""><?php echo $row['genre']; ?></td>
    </tr>
<?php exit;
    }
    if (!empty($_GET["isbn"])&&empty($_GET["name"])&&empty($_GET["author"])){
        $isbn=$_GET["isbn"];
        $res=$mysqli->query("SELECT * FROM books  WHERE isbn='$isbn' ");
        $row = $res->fetch_assoc();
        ?>
  <tr>
    <td style="width:6px valign="center" align="center"><?php echo $row['id'];?> </td>
    <td style="width:400px valign="center" align="center"><?php echo $row['name'];?></td>
    <td style="width:180px valign="center" align="center"><?php echo $row['author'];?></td>
    <td style="width:50px valign="center" align="center"><?php echo $row['year'];?></td>
    <td style="width:150px valign="center" align="center""><?php echo $row['isbn'];?></td>
    <td style="width:200px valign="center" align="center""><?php echo $row['genre'];?></td>
  </tr>
 <?php exit;
    }
    if (!empty($_GET["name"])&&empty($_GET["isbn"])&&empty($_GET["author"])){
        $name=$_GET["name"];
        $res=$mysqli->query("SELECT * FROM books WHERE name='$name'" );
        $row = $res->fetch_assoc();
        ?>
  <tr>
    <td style="width:6px valign="center" align="center"><?php echo $row['id'];?> </td>
    <td style="width:400px valign="center" align="center"><?php echo $row['name'];?></td>
    <td style="width:180px valign="center" align="center"><?php echo $row['author'];?></td>
    <td style="width:50px valign="center" align="center"><?php echo $row['year'];?></td>
    <td style="width:150px valign="center" align="center""><?php echo $row['isbn'];?></td>
    <td style="width:200px valign="center" align="center""><?php echo $row['genre'];?></td>
  </tr>
  <?php exit;
    }
    if (!empty($_GET["author"])&&empty($_GET["name"])&&empty($_GET["isbn"])){
        $author=$_GET["author"];
        $res=$mysqli->query("SELECT * FROM books WHERE author='$author'");
        $row = $res->fetch_assoc();
        ?>
   <tr>
     <td style="width:6px valign="center" align="center"><?php echo $row['id'];?> </td>
     <td style="width:400px valign="center" align="center"><?php echo $row['name'];?></td>
     <td style="width:180px valign="center" align="center"><?php echo $row['author'];?></td>
     <td style="width:50px valign="center" align="center"><?php echo $row['year'];?></td>
     <td style="width:150px valign="center" align="center""><?php echo $row['isbn'];?></td>
     <td style="width:200px valign="center" align="center""><?php echo $row['genre'];?></td>
   </tr>
 <?php
    }
    while($row = $res->fetch_assoc()){
        $i++;
?>
  <tr>
    <td style="width:6px valign="center" align="center"><?php echo $row['id'];?> </td>
    <td style="width:400px valign="center" align="center"><?php echo $row['name'];?></td>
    <td style="width:180px valign="center" align="center"><?php echo $row['author'];?></td>
    <td style="width:50px valign="center" align="center"><?php echo $row['year'];?></td>
    <td style="width:150px valign="center" align="center""><?php echo $row['isbn'];?></td>
    <td style="width:200px valign="center" align="center""><?php echo $row['genre'];?></td>
  </tr>
<?php
    }
?>
  </table>

<?php

















