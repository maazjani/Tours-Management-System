# Tours-Management-System
This is a PHP OOP task as a part of my Job Interview
# How to run this file?
Step: 1 -> Clone or download the file as a zip.
Step: 2 -> Then extract this file in C:/xampp/htdocs (The installation drive of your WAMP or XAMPP localhost)
Step: 3 -> After extracting this file, go to sql folder and you will find the database file of this system. You will have to goto PHPMYADMIN or Mysql database and import the sql file.
Step: 4 -> Once the database importing is completed then go to the XAMPP/WAMP folder and configure the database connection. Open the database php file in lib folder and Database.php file in your text editor and add your server details into these
    
    private $host = '<your-database-server>'; //localhost
    private $username = '<your-database-username>'; //root
    private $password = '<your-database-password>'; //12345
    private $dbname = '<your-database-name>'; //tours_db
    
Step: 5 -> After configuring the database connection then the final step is to configure SMTP server settings. Open the Email.php file in lib folder and write your details into these

  $this->mail->Host       = 'enter-email-server';                   //Set the SMTP server to send through
  $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $this->mail->Username   = 'enter-email-address';                  //SMTP username
  $this->mail->Password   = 'enter-password';                       //SMTP Password
  
  # Project Features:
  1) Secure user signup and login
  2) Email verification upon registration
  3) Tour Types CRUD
  4) Tour Packages CRUD
  5) Email notification upon user registration and successfull Tour package booking
  6) Unable to singin when the email is not verified

# More features coming soon :)
