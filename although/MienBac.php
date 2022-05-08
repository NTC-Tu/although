<?php
require "public/header.php";
require_once "config/db.php";
?>
<head>
    <link rel="stylesheet" href="./css/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
    <section class="content category">
        <div class="cat-container">
            <div class="cat-head">
                <h2>ẨM THỰC MIỀN BẮC</h2>
                <P>Ẩm thực miền Bắc toát lên sự tinh tế, nhẹ nhàng thanh tao cũng giống như những người con của Hà Nội vậy. Dân dã, dung dị nhưng vẫn đủ tinh tế để tạo ấn tượng sắc nét về một nền ẩm thực của đất kinh kì trên bản đồ ẩm thực Việt Nam. </P>
            </div>
                <?php
                    $sql = "SELECT *, DATE_FORMAT(created_on, '%H:%i %d/%m/%Y') as ngay_dang FROM news WHERE Cat_ID = 1 order by created_on desc";    //limit 5-lấy 5 bài mới nhất
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_array($result)){ ?>            
                    <a href="chitietsanpham.php?ProductID=<?php echo $row['ProductID']?>">
                        <div class="food-item">
                            <div class="food-img">
                                <img src="./img/<?php echo $row ['Img']?>">
                            </div>
                            <div class="food-content">
                                <h2 class="food-name"><?php echo $row ['Name']; ?></h2>
                                <h7 style = "color: rgb(206, 206, 206);"><?php echo $row['ngay_dang']; ?></h7>
                                <div class="line"></div>
                                <h3>Nguyên liệu:</h3>
                                <ul class="ingredient">
                                <?php echo substr($row ['Ingredient'], 0, 300)."..."; ?>
                                </ul>                            
                            </div>
                        </div>
                    </a>
                <?php } ?>
        </div>        
    </section>
</body>
<?php
require "public/footer.php"
?>