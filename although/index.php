<?php
require "public/header.php";
require_once "config/db.php";
?>
<body>
    <section class="slider">
        <div class="aspect-ratio-169">
            <img src="./img/slide1.gif">
            <img src="./img/slide2.png">
            <img src="./img/slide3.png">
            <img src="./img/slide4.png">
            <img src="./img/slide5.png">
        </div>
        <div class="dot-content">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </section>
    <section class="content">
        <div id="wrapper">
            <div class="headline">
                <h3>CÔNG THỨC MỚI CHO SINH VIÊN</h3>
            </div>
            <ul class="products">
                <?php
                    $sql = "SELECT * FROM news INNER JOIN category on news.Cat_ID = category.Cat_ID ORDER BY created_on DESC LIMIT 8";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_array($result)){ ?> 
                    <li>         
                    <a href="chitietsanpham.php?ProductID=<?php echo $row['ProductID']?>">
                    <div class="product-item">
                        <div class="product-top">
                            <div class="product-thumb">
                                <img src="./img/<?php echo $row ['Img']?>">
                            </div>
                        </div>
                        <div class="product-info">
                            <p class="product-cat">Món <?php echo $row ['Category']; ?></p>
                            <p class="product-name"><?php echo $row ['Name']; ?>
                        </div>
                    </div>
                    </a>
                    </li>  
                <?php } ?>
            </ul>
        </div>
    </section>
</body>
<?php
require "public/footer.php";
?>
<script>
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
    const imgContainer = document.querySelector(".aspect-ratio-169")
    const dotItem = document.querySelectorAll(".dot")
    let imgNumber = imgPosition.length
    let index = 0;
    imgPosition.forEach(function(image,index){
        image.style.left = index*100+"%"
        dotItem[index].addEventListener("click",function(){
        slider(index)
        })
    })
    function imgSlide(){
        index++;
        console.log(index)
        if(index >= imgNumber){index=0}
        slider(index)
    }
    function slider(index) {
        imgContainer.style.left = "-" + index*100 + "%"
        const dotActive = document.querySelector('.active')
        dotActive.classList.remove("active")
        dotItem[index].classList.add("active")
    }
    setInterval(imgSlide,5000)
</script>