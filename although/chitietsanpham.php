<?php
require "public/header.php";
require_once 'config/db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
        <?php
            $ProductID =  $_GET['ProductID'];
            $sql = "SELECT * FROM news left join users on news.user_ID = users.user_ID WHERE ProductID='$ProductID'";
            $result = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_array($result)){
            ?>
            <section class="content prd-detail"> 
                <h1 class="food-name"><?php echo $row ['Name']; ?></h1>
                <div class="product">
                    <img src="./img/<?php echo $row ['Img']?>">
                    <div class="product-recipe">
                        <h2>Nguyên liệu:</h2>
                        <div class="line"></div>
                        <ul class="recipe"><?php echo $row ['Ingredient']; ?>
                    </div>
                    <div class="product-content">
                        <h2>Công thức:</h2>
                        <div class="line"></div>
                        <ul class="	Recipe"><?php echo $row ['Recipe']; ?></ul>                                                  
                    </div>
                    <div class="product-end">
                        <h4 class="product-author">Đăng bởi: <?php echo $row ['username']; ?></h4> 
                    </div>
                </div>
        <?php } ?>
            <?php   
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btncomment']) && ($_POST['btncomment'])){
                if(isset($_SESSION['username']) && $_SESSION['level']==0){
                    if(!empty($_POST['comment'])){
                        if(!empty($_POST['review'])){
                        $review = $_POST['review'];
                        $comment = $_POST['comment'];
                        $SQL = "INSERT INTO comments (name, comment,review,newsID)
                        VALUES ('".$_SESSION['username']."', '".$comment."','".$review."','".$_GET['ProductID']."');";
                        $result = mysqli_query($connect, $SQL) or die( mysqli_error($connect));
                    }
                    else{
                        echo "<span class='danger moidangnhap'>please select an item in the list!</span>";
                    }
                }
                    else {
                        echo "<span class='danger moidangnhap'>please select an item in the list!</span>";
                    }
                }
                    else {
                        echo "<span class='danger moidangnhap'>Bạn phải là thành viên để thực hiện thao tác này. Đăng ký Thành viên <a href='DangNhap.html'> Tại Đây</a></span>";
                    }
                }
            if(isset($_GET['xoa']) && ($_GET['id'] > 0)){
                $SQL = "DELETE FROM comments WHERE id=".$_GET['id']."";
                $result = mysqli_query($connect, $SQL) or die( mysqli_error($connect));
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnsua']) && ($_POST['btnsua'])){
                $comment = $_POST['commentsua'];
                $review = $_POST['review'];
                $id = $_POST['commentId'];
                $SQL = "UPDATE comments SET comment='".$comment."',review='".$review."'WHERE id=".$id.";";
                $result = mysqli_query($connect, $SQL) or die( mysqli_error($connect));
            }
            ?>
            <div class="product">
                <h2>Bình luận:</h2>
                <div class="line"></div>
                <br/>        
            <?php
            if(isset($_GET['ProductID'])){
                $SQL = "SELECT * FROM comments WHERE NewsID=".$_GET['ProductID'];
                $result = mysqli_query($connect, $SQL) or die( mysqli_error($connect));
                while ($item = mysqli_fetch_array($result)){
                    if(isset($_SESSION['username']) && ($_SESSION['username'] == $item[1] || ($_SESSION['level'] == 1))){
                        if(isset($_SESSION['level']) && $_SESSION['level'] == 1){
                            $linkDel = '<a href="?xoa&id='.$item[0].'&ProductID='.$_GET['ProductID'].'">   <i class="fa fa-trash danger" aria-hidden="true"></i></a> ';
                        }else{
                            $linkEdit = '<a href="?sua&id='.$item[0].'&ProductID='.$_GET['ProductID'].'">    <i class="fa fa-pencil success" aria-hidden="true"></i></a>';
                            $linkDel = '<a href="?xoa&id='.$item[0].'&ProductID='.$_GET['ProductID'].'">   <i class="fa fa-trash danger" aria-hidden="true"></i></a> ';
                        }
                    }else{
                        $linkEdit = '';
                        $linkDel = '';
                    }
                    if(isset($_GET['sua']) && ($_GET['id']  == $item[0])){
                        if(isset($_SESSION['level']) && $_SESSION['level']==1){
                            echo '
                                <div class="show"  style="padding: 10px 0 10px 0">
                                <div class="strong" style="font-size: 1.2rem; font-weight: 700;">'.$item[1].'</div>
                                <div class="strong">'.$item[3].' '.$linkDel.'</div>
                                <span class="by" style="font-size: 1.2rem; font-weight: 500;">'.$item[2].'</span>
                                </div>';                     
                        }else{
                        echo ' 
                            <div class="show"  style="padding: 10px 0 10px 0">
                            <div class="strong" style="font-size: 1.2rem; font-weight: 700;">'.$item[1].':</div>
                            <div class="strong">'.$item[3].' '.$linkDel.''.$linkEdit.'</div>
                            <span class="by" style="font-size: 1.2rem; font-weight: 500;">'.$item[2].'</span>
                            </div>';
                        }
                        ?>
                        <br/>
                        <form action="?ProductID=<?=$_GET['ProductID']?>"  method="post" class="cmt">
                            <div class="new-comment w-30">
                                <section class="comment">
                                    <div class="new-comment">
                                        <input type="text" name="commentsua" class="text" placeholder="Sửa bình luận..." value="<?php echo $item[2];?>"> 
                                        <select name="review" class="review" required value="<?php echo $item[3];?>" style="width: 180px;height: 30px;">
                                            <option value="" >-----đánh giá-----</option>
                                            <option <?php if (isset($review) && $review == '⭐ ') echo "selected=\"selected\"";  ?> value="⭐ " >⭐ </option>
                                            <option <?php if (isset($review) && $review == '⭐ ⭐ ') echo "selected=\"selected\"";  ?> value="⭐ ⭐ ">⭐ ⭐ </option>
                                            <option <?php if (isset($review) && $review == '⭐ ⭐ ⭐ ') echo "selected=\"selected\"";  ?> value="⭐ ⭐ ⭐ ">⭐ ⭐ ⭐ </option>
                                            <option <?php if (isset($review) && $review == '⭐ ⭐ ⭐ ⭐ ') echo "selected=\"selected\"";  ?> value="⭐ ⭐ ⭐ ⭐ ">⭐ ⭐ ⭐ ⭐ </option>
                                            <option <?php if (isset($review) && $review == '⭐ ⭐ ⭐ ⭐ ⭐ ') echo "selected=\"selected\"";  ?> value="⭐ ⭐ ⭐ ⭐ ⭐ ">⭐ ⭐ ⭐ ⭐ ⭐ </option>
                                        </select> 
                                    </div>
                                </section>
                                <section class="comment">
                                    <input type="submit" name="btnsua" class="btn btn-cmt" value="Sửa"> 
                                    <input type="hidden" name="commentId" value="<?php echo $item[0];?>"> 
                                </section>
                            </div>
                        </form>
                        </div>
                        <?php 
                    }else if(isset($_SESSION['level']) && $_SESSION['level'] == 1){
                        echo '
                        <div class="show"  style="padding: 10px 0 10px 0">
                        <div class="strong" style="font-size: 1.2rem; font-weight: 700;">'.$item[1].':</div>
                        <div class="strong">'.$item[3].' '.$linkDel.''.'</div>
                        <span class="by" style="font-size: 1.2rem; font-weight: 500;">'.$item[2].'</span>
                        </div>';
                    }else{
                        echo '
                        <div class="show"  style="padding: 10px 0 10px 0">
                        <div class="strong" style="font-size: 1.2rem; font-weight: 700;">'.$item[1].':</div>
                        <div class="strong">'.$item[3].' '.$linkDel.''.$linkEdit.'</div>
                        <span class="by" style="font-size: 1.2rem; font-weight: 500;">'.$item[2].'</span>
                        </div>';
                    }
                }
            }
            ?>
            </div>
            <br/>
            <form action="?ProductID=<?=$_GET['ProductID']?>"  method="post" class="cmt">
                <section class="comment">
                    <div class="new-comment">
                        <select name="review" class="review" required style="width: 180px;height: 30px;">
                            <option value="">-----đánh giá-----</option>
                            <option <?php if (isset($review) && $review == '⭐ ') echo "selected=\"selected\"";  ?> value="⭐ " >⭐ </option>
                            <option <?php if (isset($review) && $review == '⭐ ⭐ ') echo "selected=\"selected\"";  ?> value="⭐ ⭐ ">⭐ ⭐ </option>
                            <option <?php if (isset($review) && $review == '⭐ ⭐ ⭐ ') echo "selected=\"selected\"";  ?> value="⭐ ⭐ ⭐ ">⭐ ⭐ ⭐ </option>
                            <option <?php if (isset($review) && $review == '⭐ ⭐ ⭐ ⭐ ') echo "selected=\"selected\"";  ?> value="⭐ ⭐ ⭐ ⭐ ">⭐ ⭐ ⭐ ⭐ </option>
                            <option <?php if (isset($review) && $review == '⭐ ⭐ ⭐ ⭐ ⭐ ') echo "selected=\"selected\"";  ?> value="⭐ ⭐ ⭐ ⭐ ⭐ ">⭐ ⭐ ⭐ ⭐ ⭐ </option>
                        </select> 
                        <input type="text" name="comment" class="text" placeholder="Nhập bình luận..."   />
                    </div>
                </section>
                <section class="comment">
                    <input type="submit" name="btncomment" class="btn btn-cmt" value="Gửi"> 
                </section>
            </form>
            </section>
<?php
require "public/footer.php";
?>
