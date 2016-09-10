<?php

if (!isset($_REQUEST['firstname'])) // determine whether or not the var is set
{
  include 'form.html.php'; // If not, include the form
}
else // We have a first name
{
  $firstname = $_REQUEST['firstname'];
  $lastname = $_REQUEST['lastname'];
  if ($firstname == 'Scott' and $lastname == 'Lambert')
  {
    $output = 'Welcome, oh glorious leader!';           // It's me!
  }
  else
  {
    $output = 'Welcome to our web site, ' .
        htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') . ' ' .
        htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8') . '!';
  }
  include 'welcome.html.php'; // It's not me!
}
?>