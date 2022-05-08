<?php
    require_once 'config/db.php';
    $user_ID = $_SESSION['user_ID'];
    $sql = "SELECT * FROM news INNER JOIN category on news.Cat_ID = category.Cat_ID WHERE user_ID = '$user_ID' ORDER BY created_on DESC";
    $query = mysqli_query($connect, $sql);
?>
<div class="container-fluid content">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách bài viết</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <th class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên Món</th>
                        <th>Ảnh</th>
                        <th>Nguyên liệu</th>
                        <th>Cách làm</th>
                        <th>Danh mục</th>
                        <th>Ngày đăng</th>
                        <th>Chi tiết</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </th>
                    <tbody>
                        <?php
                        $i = 1;
                            while($row = mysqli_fetch_assoc($query)){ ?>
                        <tr>
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td><?php echo $row ['Name']; ?></td>
                                <td>
                                    <img style="width: 200px;" src=" ./img/<?php echo $row ['Img']?>">
                                </td>
                                <td><?php echo substr($row ['Ingredient'], 0, 300)."..."; ?></td>
                                <td><?php echo substr($row ['Recipe'], 0, 500). "..."; ?></th>
                                <td><?php echo $row ['Category']; ?></td>
                                <td><?php echo $row ['created_on']; ?></td>
                                <td>
                                    <a href="chitietsanpham.php?ProductID=<?php echo $row['ProductID']; ?>">Xem</a>
                                </td>
                                <td>
                                    <a href="QLBaiViet-user.php?page_layout=sua&ProductID=<?php echo $row['ProductID']; ?>">Sửa</a>
                                </td>
                                <td>
                                    <a onclick="return Del('<?php echo $row['Name']; ?>')"
                                        href="QLBaiViet-user.php?page_layout=xoa&ProductID=<?php echo $row['ProductID']; ?>">Xóa</a>
                                </td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
            <a class="btn btn-primary" href="QLBaiViet-user.php?page_layout=them">Thêm</a>
        </div>
    </div>
</div>
<script>
function Del(Name) {
    return confirm("Bạn có chắc chắn muốn xóa bài viết này không: " + Name + "???")
}
</script>