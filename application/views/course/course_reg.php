<div class="containt">
    <h5>Course Registration</h5>
    <p><?php if(isset($success)){
        echo $success;
    } ?></p>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2">
                <label for="">Student ID</label>    
            </div>
            <div class="col-md-3">
                <input type="text" name="student_id" value="<?= set_value('student_id')?>">
            </div>
            <div class="col-md-4"><p><?= form_error('student_id')?></p></div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Course Code</label>
            </div>
            <div class="col-md-3">
                <select name="course_code" id="">
                    <option value="0">Select Course</option>
                    <?php foreach($course->result() as $course):?>
                        <option value="<?= $course->course_code?>"><?= $course->course_name ?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Class Day</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="class_day" placeholder="Class Day">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Class Time</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="class_time" placeholder="Class Time">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Course Fee</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="course_fee" id="course_fee" onchange="payable_withwaiver()">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Course Waiver(%)</label>
            </div>
            <div class="col-md-3">
                <input type="number" name="course_waiver" id="course_waiver" onchange="payable_withwaiver()">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Payable Amount</label>
            </div>
            <div class="col-md-3">
                <input type="number" name="payable_amount" id="payable_amount">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Course Start </label>
            </div>
            <div class="col-md-3">
                <input type="date" name="course_start">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Course End </label>
            </div>
            <div class="col-md-3">
                <input type="date" name="course_end">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Reg. Date </label>
            </div>
            <div class="col-md-3">
                <input type="date" name="reg_date">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1 offset-3">
                <button name="submit">Save</button>
            </div>
            <div class="col-md-1">
                <button>Close</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>

<script>
    function payable_withwaiver(){
        var coursefee = document.getElementById('course_fee').value;
        var waiver = document.getElementById('course_waiver').value;
        payable = coursefee-(coursefee*waiver/100);

        return document.getElementById('payable_amount').value = payable;
    }
</script>

<style>
    input, select{
        width: 236px;
    }
</style>