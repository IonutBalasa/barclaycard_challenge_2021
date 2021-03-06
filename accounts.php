<?php

$stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
            $values = [
                'user_id' => $_SESSION['loggedin']
            ];
            $stmt->execute($values);
            $data = $stmt->fetch();

if(empty($_SESSION['loggedin']) || $data['user_access']=="0"){
    exit;
}

if(isset($_POST['createemployee'])) {
    // An admin can create other admin account and only admin account because of the role from the users table that is set as 'admin'

    $stmt = $pdo->prepare('INSERT INTO users (user_access, first_name, surname, email, password, country, city, address, postcode, date_of_birth, phone) 
    VALUES ("2", :first_name, :surname, :email, :password, :country, :city, :address, :postcode, :date_of_birth, :phone)');
$values = [
'first_name' => $_POST['first_name'],
'surname' => $_POST['surname'],
'email' => $_POST['email'],
'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
'country' => $_POST['country'],
'city' => $_POST['city'],
'address' => $_POST['address'],
'postcode' => $_POST['postcode'],
'date_of_birth' => $_POST['date_of_birth'],
'phone' => $_POST['phone']
];

$stmt->execute($values);

echo 'You successfully created an admin account. <a href="my-account.php">See accounts.</a>';
    
} 
else {

?>
    <form  action="my-account.php" method="POST">
    <div class="col-8">
    <label>First Name:</label>
    <input class="form-group" type="text" required pattern=".*\S.*" name="first_name" required>
    </div>
    <div class="col-8">  
    <label>Surname:</label>
    <input class="form-group" type="text" required pattern=".*\S.*" name="surname" required>
    </div>

    <div class="col-8">
    <label>Email:</label>
    <input class="form-group" type="email" name="email" required>
    </div>

    <div class="col-8">
    <label>Password:</label>
    <input class="form-group" type="password" name="password" required>
    </div>

    <div class="col-8">
    <label>Country:</label>
    <input class="form-group" type="text" name="country" required>
    </div>

    <div class="col-8">
    <label>City:</label>
    <input class="form-group" type="text" name="city" required>
    </div>

    <div class="col-8">
    <label>Address:</label>
    <input class="form-group" type="text" name="address" required>
    </div>

    <div class="col-8">
    <label>Postcode:</label>
    <input class="form-group" type="text" name="postcode" required>
    </div>    


    <div class="col-8">
    <label>Date of birth:</label>
    <input class="form-group" type="date" name="date_of_birth" required>
    </div>

    <div class="col-8">
    <label>Phone number:</label>
    <input class="form-group" type="text" name="phone" required>
    </div>

    <div class="col-8">
    <input class="form-group" type="submit" value="Create employee account" name="createemployee" >
    </form>
    </div>
<?php

}
?>