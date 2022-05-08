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
                <h2>ẨM THỰC MIỀN TRUNG</h2>
                <P>Miền Trung với đặc trưng khí hậu cận nhiệt đới, thời tiết khắc nghiệt quanh năm đã tạo nên những nét đặc biệt trong tính cách và đời sống văn hóa của con người ở đây. Cùng với đời sống văn hóa đa dạng này, ẩm thực của người dân miền Trung cũng mang hương vị rất độc đáo, rất riêng biệt.. </P>
            </div>
                 <?php
                    $sql = "SELECT *, DATE_FORMAT(created_on, '%H:%i %d/%m/%Y') as ngay_dang FROM news WHERE Cat_ID = 2 order by created_on desc";
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
        </div>        
    </section>
</body>
<?php
require "public/footer.php"
?>