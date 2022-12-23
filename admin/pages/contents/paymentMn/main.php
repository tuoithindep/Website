
<?php
    $sql_unpaid = 'SELECT * FROM customer WHERE status=0';
    $query_unpaid = mysqli_query($mysqli, $sql_unpaid);

    $sql_paid = 'SELECT * FROM customer WHERE status=1';
    $query_paid = mysqli_query($mysqli, $sql_paid);

    function handle_status($status_id){
        $status = 'Chưa thanh toán';
        if ($status_id == 1){
            $status = 'Đã thanh toán';
        }
        return $status;
    }
?>

<!-- unpaid -->
<h3>Customer unpaid list</h3>
<table>
    <tr>
        <th>No</th>
        <th style="width: 150px;">Name</th>             
        <th>Gender</th>             
        <th>Phone</th>
        <th>Address</th>
        <th style="width: 164px;">Order date</th>
        <th style="width: 100px;">Action</th>
    </tr>
    <?php
        $i = 1;
        while ($customers = mysqli_fetch_array($query_unpaid)) {
    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $customers['name'] ?></td>
            <td><?php echo $customers['gender'] ?></td>
            <td><?php echo $customers['phone'] ?></td>
            <td><?php echo $customers['address'] ?></td>
            <td><?php echo $customers['createdAt'] ?></td>
            <td>
                <a class='btn_action' style="background-color: #076c9c; width: 100px; margin-bottom: 10px;" href="?management&payment&detail&id=<?php echo $customers['id'] ?>">View detail</a>
                <a class='paid_btn btn_action' style="background-color: #e40000; width: 100px;" href="pages/contents/paymentMn/handle.php?paid&id=<?php echo $customers['id'] ?>">Paid</a>
            </td>
        </tr>
    <?php
            $i+=1;
        }
    ?>
                
</table>

<!-- paid -->
<h3>Customer paid list</h3>
<table>
    <tr>
        <th>No</th>
        <th style="width: 150px;">Name</th>             
        <th>Gender</th>             
        <th>Phone</th>
        <th>Address</th>
        <th style="width: 164px;">Order date</th>
        <th style="width: 100px;">Action</th>
    </tr>
    <?php
        $i = 1;
        while ($customers = mysqli_fetch_array($query_paid)) {
    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $customers['name'] ?></td>
            <td><?php echo $customers['gender'] ?></td>
            <td><?php echo $customers['phone'] ?></td>
            <td><?php echo $customers['address'] ?></td>
            <td><?php echo $customers['createdAt'] ?></td>
            <td>
                <a class='btn_action' style="background-color: #076c9c; width: 100px; margin-bottom: 10px;" href="?management&payment&detail&id=<?php echo $customers['id'] ?>">View detail</a>
                <a class='paid_btn btn_action' style="background-color: #e40000; width: 100px;" href="pages/contents/paymentMn/handle.php?unpaid&id=<?php echo $customers['id'] ?>">Unpaid</a>
            </td>
        </tr>
    <?php
            $i+=1;
        }
    ?>
                
</table>