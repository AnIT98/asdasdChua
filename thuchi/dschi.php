<?php
$servername = "localhost";
$username = "nguogxaj_chualongtho";
$password = "j?%0e#Yy=Zy+";
$dbname = "nguogxaj_chualongtho";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_GET['btntim'])){
    $tungay=date("Y-m-d", strtotime($_GET['tungay']));
    $denngay=date("Y-m-d", strtotime($_GET['denngay']));
    
    $sql = "SELECT * FROM `thuchi` WHERE thuorchi =-'1'  and `ngay` BETWEEN '$tungay' AND '$denngay' ORDER by `ngay` DESC";
    // echo $sql;
    // exit();
    $result = $conn->query($sql);
    if ($result === TRUE) {
       
      } else {
      
      }
}else{
    $sql1 = "SELECT * FROM `thuchi` where `thuorchi` = '-1' ORDER by `ngay` DESC";

    $result = $conn->query($sql1);
}
$tongcong = 0;
$i = 0;
$conn->close();
setlocale(LC_MONETARY, 'en_IN');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Thu Chi</title>
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
        <div class="col-12 d-flex justify-content-center mb-1">
            <h3>Danh Sách Chi Chùa Long Thọ 
<?php 
if(isset($_GET['tungay']) && isset($_GET['denngay'])){
   echo "Từ ngày ".date("d-m-Y", strtotime($_GET['tungay']))." đến ngày ".date("d-m-Y", strtotime($_GET['denngay']));
}
?>

            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center mb-1">
        <form action="dschi.php" method="GET">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1 mb-2">Từ Ngày</label><br>
                        <input type="text" id="datepickertu" name="tungay">
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleFormControlTextarea1">Đến Ngày</label><br>
                        <input type="text" id="datepickerden" name="denngay">
                    </div>
                    <button type="submit" class="btn btn-primary" id="btntim" name="btntim">Tìm</button>
                    <button type="button" class="btn btn-info" id="btnin" name="btnin" style="margin-left: 68px;" onclick="printTable()">In</button>
                </form>
            
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center mb-1">
        <table id="tbl_thuchi" class="table table-bordered display" style="min-width:800px">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày Chi</th>
                            <th>Mô Tả</th>
                            <th>Chi</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Tổng Tiền</th>
                            <th class="hide-on-print">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $tongcong = $tongcong +  $row["tongtien"];
                                $i=$i+1;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["ngay"]))  ?></td>
                            <td><?php echo $row["mota"] ?></td>
                            <td>
                                <?php
                                    if($row["thuorchi"]==1){
                                        echo "Thu";
                                    }
                                    else{
                                        echo "Chi";
                                    } 
                                ?>
                             </td>
                            <td><?php echo $row["soluong"] ?></td>
                            <td><?php echo $row["dongia"] ?></td>
                            <td><?php echo number_format($row["tongtien"], 0, '', ','); ?></td>
                            <td class="hide-on-print">
                            <button type="button" class="btn btn-warning" id="btnxoa" onclick="xoa(<?php echo $row['id'] ?>)">Xóa</button>
                             <button type="button" class="btn btn-info" id="btnxoa" onclick="sua(<?php echo $row['id'] ?>)">Sửa</button>
                            </td>
                        </tr>
                        <?php
                        }} else {
                            echo " <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>";
                          } ?>
                    </tbody>
                    <tfoot class="print-total">
                        <td colspan="5"></td>
                        <td>Tổng:</td>
                        <td colspan="2"><?php echo number_format($tongcong, 0, '', ','); ?></td>
                    </tfoot>
                </table>
        </div>
    </div>
    </div>

    <div class="row">
        <div id="f-thuchi" class="col-12 d-flex justify-content-center mb-5 d-none">

            <form style="min-width:800px; position: absolute;top: 4%; left: 18%; z-index:999">
                <h3>Thu/Chi</h3>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ngày</label><br>
                    <input type="text" id="datepicker">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Lý Do</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Số Lượng</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Đơn Giá</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Đơn Giá</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group mb-5">
                    <label for="exampleFormControlSelect1">Hành Động
                    </label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Thu</option>
                        <option>Chi</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-primary" id="btndong">Đóng</button>
                </div>
            </form>
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
}
    </style>
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
    var firstPageRows = 10; // Số hàng trên trang đầu
    var otherPageRows = 13; // Số hàng trên các trang sau
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

window.onbeforeprint = printTable;
    $("#datepicker").datepicker();
    $("#datepickertu").datepicker();
    $("#datepickerden").datepicker();
    $("#btnAddNew").click(function() {
        $("#f-thuchi").removeClass("d-none");
        $("#ds").addClass("d-none");
    });
    $("#btndong").click(function() {
        $("#ds").removeClass("d-none");
        $("#f-thuchi").addClass("d-none");
    });
    $("#btnin").click(function() {
        window.print();
    });
    function xoa (id) {
        if (confirm("Bạn chắc chắn muốn xóa!") == true) {
            console.log("a");
            $.ajax({
            url:"xoa.php",    //the page containing php script
            type: "post",    //request type,
            dataType: 'json',
            data: {id: id},
            success:function(result){
                console.log(result);
                alert('xóa thành công!');
                location.href='dschi.php';
            }
        });
        location.href='dschi.php';
        }
    }
    function sua(id){
        location.href='sua.php?id='+id;
    }
    </script>

</body>

</html>