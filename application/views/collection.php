<div class="containt">

    <form action="" method="post" >
        <div class="row col-md-12">
            <h2>Collection Amount </h2>
            <p><?php if(isset($query['success'])){
                echo $query['success'];
            }?></p>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p>Student Id</p>
            </div>
            <div class="col-md-3">
                <input type="text" name="student_id" value="<?= set_value('student_id')?>" class="" placeholder="">
                
            </div>
            <div class="col-md-7">
                <p class="text-danger"><?= form_error('student_id')?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p>Course Name</p>
            </div>
            <div class="col-md-3">
                <select name="course_code" id="">
                    <?php foreach($course_info->result() as $course):?>
                        <option value="<?= $course->course_code?>"><?= $course->course_name ?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p>Collection method</p>
            </div>
            <div class="col-md-3">
                <select name="collection_method" id="" class="" >
                    <option value="0" selected="">Select</option>
                    <?php foreach($branch as $branch):?>
                        <option value="<?= $branch->branch_id ?>"><?= $branch->branch_name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-7">
                <p class="text-danger"><?= form_error('collection_method')?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p>Collection Date</p>
            </div>
            <div class="col-md-3">
                <input type="date" name="collection_date" value="<?= set_value('collection_date')?>" class="" placeholder="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p>Collection Amount</p>
            </div>
            <div class="col-md-3">
                <input type="number" name="collection_amount" class="" placeholder="Amount">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p><b></b></p>
            </div>
            <div class="col-md-3">
                <input type="submit" name="submit" value="Save" class="btn btn-success" placeholder="">
            </div>
        </div>
    </form>
    <table class="table table-bordered" width="100%">
        <tr>
            <th>Sl</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Collection Method</th>
            <th>User Name</th>
        </tr>
        <tr>
            <?php $i=1;foreach($collection->result() as $collection):?>
            <td><?= $i++ ?></td>
            <?php endforeach?>
        </tr>
    </table>
</div>
</body>
</html>

<style>
    input,select{
        width: 236px;
    }
</style>