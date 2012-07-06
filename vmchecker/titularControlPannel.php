<?php
    function hasher($info, $encdata = false)
        {
            $strength = "08";
      //if encrypted data is passed, check it against input ($info)
            if ($encdata)
         {
             $hash2 = hasher($info);
             if (substr($encdata, 0, 7) == substr($hash2, 0, 7))
             {
                  return true;
             }
             else
             {
             return false;
             }
         }
         else
         {
  //make a salt and hash it with input, and add salt to end
             $salt = "";
             for ($i = 0; $i < 22; $i++)
             {
                 $salt .= substr("./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
             }
  //return 82 char string (60 char hash & 22 char salt)
              return crypt($info, "$2a$".$strength."$".$salt).$salt;
         }
        }

    $userInput = $_COOKIE['userName'];
    $hashPass =  $_COOKIE['userPass'];


    $myFile = "username.txt";
    $fh = fopen($myFile, 'r') or die("can't open file");
    $jsonCode = fread($fh, filesize($myFile));


   $user = explode(":",$jsonCode);

   $len = count($user);

   for ($i=0 ; $i<$len; $i++)
   {
        if ( strcmp($user[$i] , $userInput) == 0)
            break;
   }

     $password = $user [$i + 1];
     $type = $user[$i+2];

    if (hasher($password, $hashPass) != true && $i != $len)
        header("Location: /~cdidii/vmchecker/login.php");
?>


<html >




<head>

    <link rel="stylesheet" href="vmchecker.css">
    <link rel="icon" type="image/gif"  width="16"  height="12" href="img/vmchecker-logo-perfect-fit-16x12.png" />

  <title>Vmchecker titular control pannel</title>
</head>

<body>

        <form class = "well">

            <ul id="list-navy" >
                <li><a href="#" onclick="javascript:deleteCookie();">Logoff</a></li>
                <li><a>User : <?php echo $userInput; ?></a></li>
            </ul>

            <ul id="list-nav" >

                <li><a href="https://elf.cs.pub.ro/vmchecker">&#60; &#60;vmchecker</a></li>
                <li><a href="/~cdidii/vmchecker/adminControlPannel.php">Home</a></li>
                <li><a href="/~cdidii/vmchecker/search.php">Noteaza</a></li>
                <p style="text-align: right"><li><a href="/~cdidii/vmchecker/addUser.php">Adauga student</a></li> </p>
                <li><a href="/~cdidii/vmchecker/addHomework.php">Adauga tema</a></li>
                <li><a href="/~cdidii/vmchecker/helpTitular.php">Ajutor titular</a></li>

            </ul>
         </form>

        <br />
        <br />
        <br />

          <table align="center" width="100%">
            <tr>

                <td>
                  <img src="img/vmchecker_logo_large.png" width="300" height="50" alt="" /><br /><br /> &nbsp;&nbsp;
                  Bine ai venit pe pagina de administrare a cursurilor de pe vmchecker si notare a studentilor .
                  Pentru a naviga in interiorul aplicatiei folosete butoanele de navigare de mai sus.
                </td>
                
            </tr>
          </table>

</body>

</html>

<script src="jFunctions.js"></script>