<form method="post">
 Name: <input type="text" name="name"><br><br>
 Age : <input type="number" name="age"><br><br>
 <input type="submit"><br><br>
</form>

<?php
if (isset($_POST['name']) && isset($_POST['age'])) { 
  echo "My name is" . $_POST['name'] . "and I am" . $_POST['age'] ." years old.";
} else { 
  echo "Please enter your name and age.";
} 

?>
</body>
</html>