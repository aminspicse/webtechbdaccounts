<div class="containt">
<br>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2">
                <input type="date" name="collection_date" value="" class="form-control" >
            </div>
            <div class="col-md-2">
                <select name="collection_method" id="" class="form-control">

                    <option value="4">On Cash</option>
                    <option value="Bkash">Bkash</option>
                    <option value="Rocket">Rocket</option>
                </select>
            </div>
            <div class="col-md-1">
                <button name="search_delete" class="btn btn-info btn-block">Search</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered" width="100%">
    <?php $i=1; if($collection->num_rows() > 0){?>
        <tr>
            <th>Sl</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        <?php foreach($collection->result() as $row):?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row->student_id ?></td>
                <td><?= 'name' ?></td>
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