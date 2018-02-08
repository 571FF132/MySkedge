
<?php
  echo print_r($_POST,1);
?>

<html>
    <header>
        <title>Hello to the World</title>
    </header>
    <body>
        <form /*action=""*/ method="POST">
            <div>Comment: <input type="text" name="comment"></div>
            <div><input type="submit"></div>
        </form>
    </body>
</html>