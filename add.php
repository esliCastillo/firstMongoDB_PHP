<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
    include_once("config.php");
    if(isset($_POST['Submit'])){
        $user = array(
            'name' => $_POST['name'],
            'age' => $_POST['age'],
            'email' => $_POST['email']
        );

        $errorMessage = '';

        foreach($user as $key => $value){
            if(empty($value)){
                $errorMessage .= $key . "field is empty<br/>";
            }
        }

        if($errorMessage){
            echo '<span style="color:red">'.$errorMessage.'</span>';
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>"; 
        }
        else{
            $db->user->insert($user);
        
            echo "<font color='green'>Data added successfully.";
            echo "<br/><a href='index.php'>View Result</a>";
        }
    }
    ?>
</body>
</html>