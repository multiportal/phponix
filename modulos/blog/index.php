<?php include 'admin/functions.php';
if($tema=='porto'){
    include 'porto.php';
}else if($tema=='portophponix'){
    include 'portophponix.php';
}
else{
    include 'default.php';
}
?>