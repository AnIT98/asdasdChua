<?php
$servername = "localhost";
$username = "nguogxaj_chualongtho";
$password = "j?%0e#Yy=Zy+";
$dbname = "nguogxaj_chualongtho";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_GET['id'])){
$id=$_GET['id'];
    $sql = "SELECT * FROM `nocu` WHERE id = $id ";
    // echo $sql;
    // exit();
    $result = $conn->query($sql);
    if ($result === TRUE) {

      } else {

      }
}else{
    // $sql1 = "SELECT * FROM `thuchi` where `thuorchi` = '-1' ORDER by `ngay` DESC LIMIT 0,200";

    // $result = $conn->query($sql1);
}
if(isset($_POST['btnluu'])){
    $idluu=$_POST['id_sua'];
    $hoten=$_POST['hoten'];
    $sotien=$_POST['sotien'];
    $laixuat=$_POST['laixuat'];

    $sqlluu="UPDATE `nocu` SET `hoten`='$hoten',`sotien`='$sotien',`laixuat`='$laixuat' WHERE `id` =  $idluu";
  
    if ($conn->query($sqlluu) === TRUE) {
        echo "<script type='text/javascript'>alert('Sửa Thành Công');</script>";
      } else {
        echo "<script type='text/javascript'>alert('Sửa thất bại');</script>";
      }
      echo ("<script>location.href='qlcongno.php'</script>");
}
$row = $result->fetch_assoc();
$tongcong = 0;
$conn->close();
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
    </div>
    <div class="row">
        <div id="f-thuchi" class="col-12 d-flex justify-content-center mb-5" style="">
            <form style="min-width:800px; position: absolute;top: 9%; left: 18%; z-index:999" action="suacongno.php"
                method="POST">
                <h3>Sửa Lại</h3>
                <div class="form-group d-none">
                    <label for="exampleFormControlTextarea1">STT</label><br>
                    <input type="text" id="text" name="id_sua" value="<?php echo $row["id"]?>"></input>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Họ Tên</label><br>
                    <input type="text" id="date" name="hoten" value="<?php echo $row["hoten"]?>"></input>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Số Tiền</label>
                    <input class="form-control" id="sotien" 
                        name="sotien" value="<?php echo $row["sotien"] ?>"></input>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Lãi Xuất</label>
                    <input class="form-control" id="exampleFormControlTextarea1" 
                        name="laixuat" value="<?php echo $row["laixuat"] ?>"></input>
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

    $("#btnAddNew").click(function() {
        $("#f-thuchi").removeClass("d-none");
        $("#ds").addClass("d-none");
    });
    $("#btndong").click(function() {
        location.href = 'index.php';
    });

    // function xoa(id) {
    //     if (confirm("Bạn chắc chắn muốn xóa!") == true) {
    //         $.ajax({
    //             url: "xoa.php", //the page containing php script
    //             type: "post", //request type,
    //             dataType: 'json',
    //             data: {
    //                 id: id
    //             },
    //             success: function(result) {
    //                 console.log(result);
    //                 alert('xóa thành công!');
    //                 location.href = 'dschi.php';
    //             }
    //         });
    //         location.href = 'dschi.php';
    //     }
    // }
    </script>
 
</body>

</html>