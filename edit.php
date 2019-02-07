<?php
include_once("config.php");
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $user = array(
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'email' => $_POST['email']
    );

    $errorMessage = '';
    foreach($user as $key => $value){
        if(empty($value)){
            $errorMessage .= $key . 'field is empty<br/>';
        }
    }
    
    if ($errorMessage) {
        echo '<span style="color:red">'.$errorMessage.'</span>';
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";    
    } else {
        $db->user->update(
                        array('_id' => new MongoId($id)),
                        array('$set' => $user)
                    );
        
        header("Location: index.php");
    }
}

$id = $_GET['id'];

$result = $db->user->findOne(array('_id' => new MongoId($id)));

$name = $result['name'];
$age = $result['age'];
$email = $result['email'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK REL=StyleSheet HREF="style.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
    <a href="index.php">Home</a>
    <br/><br/>

    <form name="form1" method="POST" action="edit.php">
        <table border=0>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="text" name="age" value="<?php echo $age; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>