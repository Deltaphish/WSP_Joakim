<head>
  <link rel="stylesheet" type="text/css" href="./CSS/main.css">
  <link rel="stylesheet" type="text/css" href="./CSS/home.css">
  <link rel="stylesheet" type="text/css" href="./CSS/new-record.css">
</head>
<body>
  <nav>
    <h1>GainzQuest</h1>
    <a href="logout.php" id="link1">Logout</a>
    <a href="new-record.php" id="link2">New record</a>
    <a href="view-records.php" id="link3">View Records</a>
  </nav>

  <?php
  session_start();
  if(empty($_SESSION['User'])){
    header('Location: login.php?error=1');
    die();
  }

  ?>
  <form action="new-record-handler.php" method="POST">
    <input type="number" name="weight" placeholder="Kg"/>
    <input type="submit"/>
  </form>
</body>
