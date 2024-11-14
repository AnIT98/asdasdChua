<?php
    if(!isset($_COOKIE['isLogin'])) {
     header('Location: login.php');
    }
?>
    <div class="row d-flex justify-content-center mb-1">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
        
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dsthu.php">Quản Lý Thu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dschi.php">Quản Lý Chi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="qlcongno.php">Nợ Củ</a>
                            </li>
                        </ul>
    
                    </div>
                </div>
            </nav>
        </div>
    </div>