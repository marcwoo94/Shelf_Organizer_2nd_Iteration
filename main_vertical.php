<!DOCTYPE html>
<html>
<head>
  <title>Shelf Organizer</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/style_vertical.css">


  <?php
  // MySQL 접속
    $conn=mysqli_connect('localhost', 'root', '4243109', 'songdolib');

    $from = $_GET['from'];
    $to = $_GET['to'];

    if (isset($_GET['checkbox'])){
      $checkbox_value = $_GET['checkbox'];
      $checkbox_count = count($checkbox_value);
        foreach ($checkbox_value as $checkbox_count){
          $sql_nip_fix = "UPDATE booklist SET nip = NOT nip WHERE id = $checkbox_count";
          $sql_nip_fix_result = mysqli_query($conn, $sql_nip_fix);
        };
    }

    $sql="SELECT * FROM booklist WHERE id>=$from and id <=$to";
    $sql_result = mysqli_query($conn, $sql);
  ?>

</head>

<body>
  <div class="main">
  <div style="font-family:noto sans;">

  <div style="position:fixed; top:2%; left:2%;">
    <span style="font-size:100px; font-weight:700;">
      <a href="home.html" style="text-decoration:none; color:#000;">
        Shelf Organizer
      </a>
    </span>
    <span style="font-size:40px; font-weight:700; margin:10px 10px;">
      ID: <?php echo $from.'~'.$to; ?>
    </span>
  </div>

  <div style="position:fixed; top:8%; left:0%; z-index:1;"><img src="images/whitebar.png"></div>

  <div style='writing-mode:vertical-lr;'>
    <table style="z-index:1; position:fixed; top:9%; left:2%;">
      <tr>
        <th class='id'>ID</th>
        <th class='title'>Title</th>
        <th class='id'>CO</th>
        <th class='id'>NP</th>
        <th class='id'>CB</th>
      </tr>
    </table>

  <?php
//책 리스트 head 출력.

//책 리스트 테이블로 출력
echo "<table style='position:relative; top:231.3px; left:6%;'>";
  while($row=mysqli_fetch_assoc($sql_result)){
    $id=$row['id'];
    $title=$row['title'];

      if ($row['checkout'] == false){
        $checkout = 'F';
      }
      else {
        $checkout = 'T';
      }

      if ($row['nip'] == false){
        $nip = 'F';
      }
      else {
        $nip = 'T';
      }

    echo "<tr>";
      if ($row['sample'] == false){
        echo "<td class='id'>$id</td>
              <td class='title'>$title</td>
              <td class='conip'>$checkout</td>
              <td class='conip'>$nip</td>
            <form action='/main_vertical.php', method='get'>
              <td class='conip'>
                <input type='checkbox' id='$id' name='checkbox[]' value='$id' style='position:relative; right:10px; width:35px; height:35px;'>
              </td>
          </tr>";
      }
      else{
        echo "<td class='id2'>$id</td>
              <td class='title2'>$title</td>
              <td class='conip2'>$checkout</td>
              <td class='conip2'>$nip</td>
            <form action='/main_vertical.php', method='get'>
              <td class='id2'>
                <input type='checkbox' id='$id' name='checkbox[]' value='$id' style='position:relative; right:10px; width:35px; height:35px;'>
              </td>
          </tr>";
      }
  };
echo "</table>";
    ?>
  </div>

  <input style="display:none;" name="from" value="<?php echo $from; ?>">
  <input style="display:none;" name="to" value="<?php echo $to; ?>">
  <input type="submit" value="Update" style="font-family:noto sans; position:fixed; top:2.8%; right:2%;">
  </form>

</div>
</div>

</body>
</html>
