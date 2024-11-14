<?php
$servername = "localhost";
$username = "nguogxaj_chualongtho";
$password = "j?%0e#Yy=Zy+";
$dbname = "nguogxaj_chualongtho";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_GET['xoa'])){
    $id=$_GET['id'];
    $sqlxoa = "DELETE FROM `nocu` WHERE id = '$id'";
    if ($conn->query($sqlxoa) === TRUE) {
        echo "<script type='text/javascript'>alert('Thêm Thành Công');</script>";
      } else {
        echo "<script type='text/javascript'>alert('Thêm thất bại');</script>";
      }
      echo ("<script>location.href='qlcongno.php'</script>");
}
if(isset($_POST['btnluu'])){
    $hoten=$_POST['hoten'];
    $sotien=$_POST['sotien'];
    $laixuat=$_POST['laixuat'];
    
    $sql = "INSERT INTO `nocu`(`hoten`, `sotien`, `laixuat` ) VALUES ('$hoten','$sotien','$laixuat')";
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Thêm Thành Công');</script>";
      } else {
        echo "<script type='text/javascript'>alert('Thêm thất bại');</script>";
      }
      echo ("<script>location.href='qlcongno.php'</script>");
}
$sql1 = "SELECT * FROM `nocu` ORDER by `id` DESC";

$result = $conn->query($sql1);
$tongcong = 0;
$i=0;
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Công Nợ</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="row" id="ds">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-5">
                <h3>QL công nợ Chùa Long Thọ</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-5">
                <button type="button" class="btn btn-primary" id="btnAddNew">Thêm Mới</button>
<button type="button" class="btn btn-info" id="btnin" name="btnin" style="margin-left: 68px;" onclick="printTable()">In</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-5">
                <table id="tbl_thuchi" class="table table-bordered display" style="min-width:800px">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ Tên</th>
                            <th>Số Tiền</th>
                            <th>Lãi Xuất</th>
                            <th class="hide-on-print">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $tongcong = $tongcong + $row["sotien"];
                                $i=$i+1;
                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row["hoten"] ?></td>
                            <td><?php echo number_format($row["sotien"], 0, '', ',');?></td>
                            <td><?php echo $row["laixuat"] ?></td>
                            <td class="hide-on-print">
                            <button type="button" class="btn btn-warning" id="btnxoa" onclick="xoa(<?php echo $row['id']?>)">Xóa</button>
                            <button type="button" class="btn btn-info" id="btnsua" onclick="sua(<?php echo $row['id'] ?>)">Sửa</button>
                            </td>
                        </tr>
                        <?php
                        }} else {
                            echo " <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>";
                          } ?>
                    </tbody>
                    <tfoot class="print-total">
                        <td colspan="1"></td>
                        <td>Tổng:</td>
                        <td colspan="3"><?php echo number_format($tongcong, 0, '', ',');?></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <style>

        @media print {
            .hide-on-print {
                display: none;
            }
        }
        @media print {
    .print-total {
        display: none; /* Mặc định ẩn khi in */
    }

    .show-on-last-page {
        display: table-row-group; /* Chỉ hiển thị trên trang cuối */
    }
}
    </style>
    <div class="row">
        <div id="f-thuchi" class="col-12 d-flex justify-content-center mb-5 d-none">

            <form style="min-width:800px; position: absolute;top: 4%; left: 18%; z-index:999" action="qlcongno.php"
                method="POST">
                <h3>Nợ Củ</h3>
                <div class="form-group">
                    <label for="hoten">Họ Tên</label>
                    <input type="text" class="form-control" id="hoten" name="hoten"></input>
                </div>
                <div class="form-group">
                    <label for="laixuat">Số Tiền</label>
                    <input type="number" class="form-control" id="laixuat" name="sotien"></input>
                </div>
                <div class="form-group">
                    <label for="laixuat">Lãi Xuất</label>
                    <input type="text" class="form-control" id="laixuat" name="laixuat"></input>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="btn-luu" name="btnluu">Lưu</button>
                    <button type="button" class="btn btn-primary" id="btndong" style="margin-left:70px;">Đóng</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    < script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
    integrity = "sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
    crossorigin = "anonymous"
    referrerpolicy = "no-referrer" >
    </script>
    </script>
    <script>
function printTable() {
    // Giả định về số hàng trên mỗi trang
    var firstPageRows = 11; // Số hàng trên trang đầu
    var otherPageRows = 14; // Số hàng trên các trang sau
    var totalRows = document.querySelectorAll('#tbl_thuchi tbody tr').length;

    // Tính tổng số trang
    var totalPages = 1 + Math.ceil((totalRows - firstPageRows) / otherPageRows);
    
    var tfoot = document.querySelector('.print-total');

    if (totalPages > 1) {
        var lastPageFirstRowIndex = firstPageRows + (otherPageRows * (totalPages - 2));
        var rows = document.querySelectorAll('#tbl_thuchi tbody tr');
        var isLastPageRow = false;

        rows.forEach((row, index) => {
            if (index >= lastPageFirstRowIndex) {
                isLastPageRow = true;
            }
        });

        // Nếu có hàng nằm trên trang cuối, hiển thị tfoot
        if (isLastPageRow) {
            tfoot.classList.add('show-on-last-page');
        }
    } else {
        tfoot.style.display = 'table-row-group';
    }

    window.print();
}

window.onbeforeprint = printTable;
    $("#btnin").click(function() {
        window.print();
    });
    $("#datepicker").datepicker();
    $("#btnAddNew").click(function() {
        $("#f-thuchi").removeClass("d-none");
        $("#ds").addClass("d-none");
    });
    $("#btndong").click(function() {
        $("#ds").removeClass("d-none");
        $("#f-thuchi").addClass("d-none");
    });

    $("#btn-luu").click(function() {

    });
    function xoa(id){
        location.href='qlcongno.php?id='+id+'&xoa=true';
    }
    function sua(id){
        location.href='suacongno.php?id='+id;
    }
    </script>

</body>

</html>