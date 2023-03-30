<?php
$mongo= new MongoClient();
$db=$mongo->local;
$db=$collection=$db->help;
if($_POST)
{
    $insert= array(
        'name'=> $_POST['update_name'],
        'mobile'=> $_POST['mobile_number'],
        'email'=> $_POST['update_email'],
        'old_pass'=> $_POST['old_pass'],
        'nem_pass'=> $_POST['new_pass'],
        'confirm_pass'=> $_POST['confirm_pass'],
    );

        if($collection->insert($insert))
        {
            echo "data is inserted";
        }
        else {
            echo "some Issue";
        }
}
else {
    echo "no data to store";
}
?>