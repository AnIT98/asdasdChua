<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Thu Chi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h3 class="text-center my-4">Danh Sách Thu Chi Chùa Long Thọ</h3>
        <button type="button" class="btn btn-primary" id="btnAddNew">Thêm Mới</button>
        <button type="button" class="btn btn-info" id="btnin" style="margin-left: 10px;">In</button>
        <table id="tbl_thuchi" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ngày Chi/Thu</th>
                    <th>Mô Tả</th>
                    <th>Thu/Chi</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Tổng Tiền</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Form Modal -->
    <div id="formModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Mới Thu/Chi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="thuchiForm">
                        <div class="form-group">
                            <label>Ngày</label>
                            <input type="date" id="ngay" name="ngay" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <textarea id="mota" name="mota" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Thu/Chi</label>
                            <select id="thuorchi" name="thuorchi" class="form-control">
                                <option value="1">Thu</option>
                                <option value="-1">Chi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Số Lượng</label>
                            <input type="number" id="sl" name="sl" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Đơn Giá</label>
                            <input type="number" id="dg" name="dg" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tổng</label>
                            <input type="number" id="tong" name="tong" class="form-control" required>
                        </div>
                        <button type="button" id="saveBtn" class="btn btn-primary mt-3">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const apiUrl = 'https://thoisumoingay.com/api/xuly.php';

        // Fetch data from API
        function fetchThuChi() {
            $.get(apiUrl + '?action=list', function(response) {
                if (response.status === 'success') {
                    renderTable(response.data);
                } else {
                    alert(response.message);
                }
            });
        }

        // Render data to table
        function renderTable(data) {
            const tbody = $('#tbl_thuchi tbody');
            tbody.empty();
            data.forEach((item, index) => {
                const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.ngay}</td>
                    <td>${item.mota}</td>
                    <td>${item.thuorchi == 1 ? 'Thu' : 'Chi'}</td>
                    <td>${item.soluong}</td>
                    <td>${item.dongia}</td>
                    <td>${item.tongtien}</td>
                </tr>`;
                tbody.append(row);
            });
        }

        // Save new entry
        $('#saveBtn').click(function() {
            const data = {
                ngay: $('#ngay').val(),
                mota: $('#mota').val(),
                thuorchi: $('#thuorchi').val(),
                sl: $('#sl').val(),
                dg: $('#dg').val(),
                tong: $('#tong').val()
            };
            $.ajax({
                url: apiUrl + '?action=add',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function(response) {
                    alert(response.message);
                    $('#formModal').modal('hide');
                    fetchThuChi();
                }
            });
        });

        // Open modal on Add New button
        $('#btnAddNew').click(() => $('#formModal').modal('show'));

        // Initialize fetch data
        $(document).ready(() => fetchThuChi());
    </script>

</body>
</html>