<?php
    require_once 'config/db.php';
    require "public/header.php";
?>
<head>
    <link rel="stylesheet" href="./css/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<?php
    if(isset($_GET['page_layout'])){
        switch($_GET['page_layout']){
            case 'danhsach':
                require_once 'Products-user/danhsach.php';
                break;
                
            case 'them':
                require_once 'Products-user/them.php';
                break;

            case 'sua':
                require_once 'Products-user/sua.php';
                break;
                
            case 'xoa':
                require_once 'Products-user/xoa.php';
                break;
            
            default:
                require_once 'Products-user/danhsach.php';
                break;
        }
    }
    else{
        require_once 'Products-user/danhsach.php';
    }
require "public/footer.php";
?>