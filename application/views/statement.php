<div class="containt">

    <table class="table table-bordered" width="100%">
        <tr>
            <th>Sl</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course_code</th>
            <th>Course_fee</th>
            <th>Waiver(%)</th>
            <th>Debit(Tk)</th>
            <th>Credit(Tk)</th>
            <th>Due(Tk)</th>
            <th>User</th>
        </tr>
        <?php 
        $i = 1; 
        $total_coursefee = 0;
        $total_debit = 0;
        $total_credit = 0;
        $total_due = 0;
        foreach($qry->result() as $row){ 
        //$debit_amount = $this->Collection_Model->total_debit_amount($row->student_id);
        $credit_amount = $this->Collection_Model->total_collection_amount($row->student_id,$row->course_code);
        
        $total_coursefee += $row->course_fee;
        $total_debit += $row->payable_amount;
        
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $row->student_id ?></td>
            <td><?= $row->student_name ?></td>
            <td><?= $row->course_code ?></td>
            <td><?= $row->course_fee ?></td>
            <td><?= $row->course_waiver."%" ?></td>
            <td><?= $row->payable_amount ?></td>
            <td><?php foreach($credit_amount as $credit){
                echo $credit->collectionamount;
                $total_credit += $credit->collectionamount;
            } ?></td>
            <td><?php  echo $row->payable_amount - $credit->collectionamount;
                $total_due += $row->payable_amount - $credit->collectionamount;
            ?></td>
            <td><?php echo ""; ?></td>
        </tr>
        
        <?php } ?>
        <tr>
            <th colspan="4">Grand Total </th>
            <th> <?= $total_coursefee ?></th>
            <th> <?= '' ?></th>
            <th> <?= $total_debit ?></th>
            <th> <?= $total_credit ?></th>
            <th> <?= $total_due ?></th>
        </tr>
    </table>
</div>
</body>
</html>