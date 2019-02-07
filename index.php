<?php
include_once("config.php");

if(!empty($_POST['search'])){
    $regex = new MongoRegex("/".$_POST['searchName']."/i");
    $result = $db->user->find(array("name" => $regex))->sort(array('_id' => -1));
}
else{
    $result = $db->user->find()->sort(array('_id' => -1));
}
?>
<html>
    <head>
        <title>HomePage</title>
        <LINK REL=StyleSheet HREF="style.css" TYPE="text/css" MEDIA=screen>
    </head>
    <body>
        <a href="add.html">Add</a><br/><br/>
        <form action="index.php" method="POST">
            <input type="text" name="searchName" value="<?php echo (!empty($_POST['searchName']))? $_POST['searchName']: ""; ?>" />
            <input type="submit" name="search" value="Buscar" />
        </form>
        <table width="80%" border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($result as $res){
                echo "<tr>";
                echo "<td>". $res['name'] ."</td>";
                echo "<td>". $res['age'] ."</td>";
                echo "<td>". $res['email'] ."</td>";
                echo "<td><a href='edit.php?id=" . $res['_id'] . "'>Edit</a>  <a href='delete.php?id=" . $res['_id'] . "' onclick='return confirm(\"Are you sure you want to delete\")'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </body>
</html>