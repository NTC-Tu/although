<?php
    $sql_category = "SELECT * FROM category ";
    $query_category = mysqli_query($connect, $sql_category);
    if(isset($_POST['submit'])){
        $Name = $_POST['Name'];
        $Img = $_FILES['Img']['name'];
        $Img_tmp = $_FILES['Img']['tmp_name'];
        $Ingredient = $_POST['Ingredient'];
        $Recipe = $_POST['Recipe'];
        $Cat_ID = $_POST['Cat_ID'];
        $user_ID = $_SESSION['user_ID'];
        $sql = "INSERT INTO news (Name, Img, Ingredient, Recipe, Cat_ID, user_ID)
        VALUES ( '$Name','$Img','$Ingredient', '$Recipe','$Cat_ID', '$user_ID')";
        $query = mysqli_query($connect, $sql);
        move_uploaded_file($_FILES['Img']['tmp_name'], 'img/'.$_FILES['Img']['name']);
        header('location: QLBaiViet-user.php?page_layout=danhsach.php');
    }
?>
<head>
    <script src="./css/ckeditor/ckeditor.js"></script>
</head>
<body>
<div class="container-fluid content">
    <div class="card">
        <div class="card-header">
            <h2>Thêm bài</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Tên món</label>
                    <input type="text" name="Name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Ảnh (Tên file không vượt quá 25 ký tự)</label>
                    <input type="file" name="Img" class="form-control" placeholder="VD: Canhcua.png, T1.jpg..." >
                </div>
                <div class="form-group">
                    <label for="">Nguyên liệu</label>
                    <textarea name="Ingredient" class="form-control" id="edit" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Công thức</label>
                    <textarea  name="Recipe" class="form-control" id="edit1" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" name="Cat_ID" required>
                        <?php
                            while($row_category= mysqli_fetch_assoc($query_category)){ ?>
                        <option value="<?php echo $row_category["Cat_ID"] ?>"><?php echo $row_category["Category"] ?>
                        </option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="foot-btn">
                <button name="submit" class="btn btn-success" type="submit">Thêm</button>
                <button class="btn btn-primary back" ><a href="QLBaiViet-user.php">Trở về</a></button>
                </div>            
            </form>
        </div>
    </div>
</div>
<script>
        CKEDITOR.replace('edit');
        CKEDITOR.replace('edit1');
</script>
<div></div>
</body>