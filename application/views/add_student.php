    <div class="containt">
        <div class="row col-md-12">
            <h3 class="text-center">Add New Student</h3>
        </div>
        <form action="" method="post">
        <div class="row">
            <div class="col-md-2">
                <label for="" class="">Name*</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="student_name" class="" placeholder="Student Name" required>
            </div>
            <div class="col-md-2">
                <label for="" class="">Fathers Name* </label>
            </div>
            <div class="col-md-3">
                <input type="text" name="fathername" class="" placeholder="Fathers Name">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="" class="">Mothers Name</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="mothername" class="" placeholder="Mothers Name">
            </div>
            <div class="col-md-2"><label for="" class="">Date of Birth*</label></div>
            <div class="col-md-3">
                <input type="date" name="dateofbirth" class="" placeholder="Date" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"><label for="" class="">Email*</label></div>
            <div class="col-md-3">
                <input type="text" name="email" class="" placeholder="Email" required>
            </div>
            <div class="col-md-2"><label for="" class="">Mobile* </label></div>
            <div class="col-md-3">
                <input type="text" name="phone" class="" placeholder="Mobile Number">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"><label for="" class="">Course Name</label></div>
            <div class="col-md-3">
                <select name="course_name" id="" class="">
                    <option value="0">Select Course</option>
                    <option value="1">Web Design</option>
                    <option value="2">Web Design</option>
                    <option value="3">Web Design && Develop</option>
                    <option value="4">HSC ICT</option>
                </select>
            </div>
            <div class="col-md-2"><label for="" class="">Student Inst. Id</label></div>
            <div class="col-md-3">
                <input type="text" name="std_inst_id" class="" placeholder="Student ID" required>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-2"><label for="" class="">Institute Name</label></div>
            <div class="col-md-3">
                <input type="text" name="institute_name" class="" placeholder="Institute name" required>
            </div>
            <div class="col-md-2"><label for="" class="">Application Date</label></div>
            <div class="col-md-3">
                <input type="date" name="applicationdate" class="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"><label for="" class="">Present Address</label></div>
            <div class="col-md-3">
                <textarea name="present_address" class="" id="" cols="18" rows="1" placeholder="Present Address"></textarea>
            </div>
            <div class="col-md-2"><label for="" class="">Permanent Address</label></div>
            <div class="col-md-3">
                <textarea name="permanent_address" class="" id="" cols="18" rows="1" placeholder="Permanent Address"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <button name="submit" class="btn btn-success">Save</button>
            </div>
        </div>
        </form>
    </div>
</body>
</html>
<style>
    input, select, textarea{
        width: 236px;
    }
</style>