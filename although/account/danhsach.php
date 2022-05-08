<?php
    $sql = "SELECT * FROM users where level = 0";
    $query = mysqli_query($connect, $sql);
?>
<div class="container-fluid content">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách tài khoản</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <th class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tên tài khoản</th>
                        <th>Ngày đăng ký</th>
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
                        <td><?php echo $row ['username']; ?></td>
                        <td><?php echo $row ['created_on']; ?></td>
                        <td>
                            <a onclick="return Del('<?php echo $row['username']; ?>')"
                                href="QLTaikhoan.php?page_layout=xoa&user_ID=<?php echo $row['user_ID']; ?>">Xóa
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function Del(username) {
    return confirm("Bạn có chắc chắn muốn xóa tài khoản này không: " + username + "???")
}
</script>