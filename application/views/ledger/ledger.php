    <div class="containt">
        <div class="row">
            <div class="col-md-2"><a href="">Step 1</a></div>
            <div class="col-md-2"><a href="">Step 2</a></div>
        </div>
        <?php foreach($student_info as $stdinfo):?>
            <div class="row">
                <div class="col-md-2"><p>StudentName</p></div>
                <div class="col-md-3">
                    <p><b><?= $stdinfo->student_name ?></b></p>
                </div>
                <div class="col-md-2"><p>Father's Name</p></div>
                <div class="col-md-4"><p><b><?= $stdinfo->fathername ?></b></p></div>
            </div>
            <div class="row">
                <div class="col-md-2"><p>Mother's Name</p></div>
                <div class="col-md-3"><p><b><?= $stdinfo->mothername ?></b></p></div>
                <div class="col-md-2"><p>Date of Birth</p></div>
                <div class="col-md-4"><p><b><?= $stdinfo->dateofbirth ?></b></p></div>
            </div>
            <div class="row">
                <div class="col-md-2"><p>Email</p></div>
                <div class="col-md-3"><p><b><?= $stdinfo->email ?></b></p></div>
                <div class="col-md-2"><p>Mobile</p></div>
                <div class="col-md-4"><p><b><?= $stdinfo->phone ?></b></p></div>
            </div>
            <div class="row">
                <div class="col-md-2"><p>Student Id(inst)</p></div>
                <div class="col-md-3"><p><b><?= $stdinfo->std_inst_id ?></b></p></div>
                <div class="col-md-2"><p>Institute</p></div>
                <div class="col-md-4"><p><b><?= $stdinfo->institute_name ?></b></p></div>
            </div>
            <div class="row">
                <div class="col-md-2"><p>Present Address</p></div>
                <div class="col-md-3"><p><b><?= $stdinfo->present_address ?></b></p></div>
                <div class="col-md-2"><p>Permanent Address</p></div>
                <div class="col-md-4"><p><b><?= $stdinfo->permanent_address ?></b></p></div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered">
                        <p><b>Course Information</b></p>
                        <tr>
                            <th>sl</th>
                            <th><p>code</p> </th>
                            <th><p>fee</p> </th>
                            <th><p>waiver</p> </th>
                            <th><p>payable</p> </th>
                            <th><p>start</p> </th>
                            <th><p>end</p> </th>
                            <th><p>day</p> </th>
                            <th><p>time</p> </th>
                        </tr>
                        <?php $i=1;$totalpayable=0; foreach($registration_info as $reginfo):?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><p><b title="<?= $reginfo->course_name ?>"><?= $reginfo->course_code ?></b></p></td>
                                <td><?= $reginfo->course_fee ?></td>
                                <td><?= $reginfo->course_waiver.'%'?></td>
                                <td><?= $reginfo->payable_amount ?></td>
                                <td><?= $reginfo->course_start ?></td>
                                <td><?= $reginfo->course_end ?></td>
                                <td><?= $reginfo->class_day ?></td>
                                <td><?= $reginfo->class_time ?></td>
                            </tr>
                            <?php $totalpayable += $reginfo->payable_amount?>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="4"><b>Grand Total </b><small>(Payable)</small></td>
                            <td><b><?= $totalpayable?></b></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-5">
                    <table class="table table-bordered">
                        <p><b>Payment Information</b></p>
                        <tr>
                            <th>sl</th>
                            <th>Code</th>
                            <th>amount</th>
                            <th>date</th>
                            <th>method</th>
                        </tr>
                        <?php $i=1; $totalcollection=0; foreach($collection_info as $collection):?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $collection->course_code ?></td>
                                <td><?= $collection->collection_amount?></td>
                                <td><?= $collection->collection_date?></td>
                                <td><?= $collection->branch_name?></td>
                            </tr>
                            <?php $totalcollection += $collection->collection_amount ?>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="2"><b>Grand Total: </b></td>
                            <td><b><?= $totalcollection ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</body>
</html>