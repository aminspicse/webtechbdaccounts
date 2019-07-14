<div class="containt">
<br>
    <form action="" method="get">
        <div class="row">
            <div class="col-md-2">
                <label for="">From Date</label>
                <input type="date" name="fromdate" value="<?= set_value('fromdate') ?>" class="form-control" >
            </div>
            <div class="col-md-2">
                <label for="">To Date</label>
                <input type="date" name="todate" value="" class="form-control" >
            </div>
            <div class="col-md-2">
                <label for="">Bank </label>
                <select name="collection_method" id="" class="form-control">
                    <?php foreach ($branch as $br) {
                        echo '<option value='.$br->branch_id.'>'.$br->branch_name.'</option>';
                    }?>
                </select>
            </div>
            <div class="col-md-1">
                <label for=""> <br></label>
                <button name="search_delete" class="btn btn-info btn-block">Search</button>
            </div>
            <div class="col-md-2">
                <label for=""><br></label>
                <button name="generate_report" class="btn btn-default btn-block">Generate Report</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered" width="100%">
    <?php $i=1; if($collection->num_rows() > 0){?>
        <tr>
            <th>Sl</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        <?php foreach($collection->result() as $row):?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row->student_id ?></td>
                <td><?= $row->student_name ?></td>
                <td><?= date('d-m-y',strtotime($row->collection_date))?></td>
                <td><?= $row->collection_amount ?></td>
                <td><a href="">Delete</a></td>
            </tr>
        <?php endforeach?>
    <?php }else{
        echo '<tr><p>Data Not Found</p></tr>';
    }?>
    </table>
</div>
</body>
</html>