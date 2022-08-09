<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './classes/Server.php';
$result = "";
$doctors = "";
$output = "";
$delete = "";
$update ="";

$server = new Server();
$result = $server->adminData();
$doctors = $server->viewDoctorlist();

if (isset($_POST['update'])) {
    $update = $server->updateSchedule($_POST);
}
if (isset($_POST['delete'])) {
    $delete = $server->DeleteSchedule($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>CMS</title>

        <?php
        include './parts/css-links.php';
        ?>
        <style>
            table{
                text-align: center !important;
                font-family: 'Titillium Web', sans-serif !important;
            }
            th{
                background-color: blueviolet;
                color:white
            }
            input,button{
                text-align: center;
                font-family: 'Titillium Web', sans-serif !important;
            }
            input[type="submit"]{
                width: 100%
            }
            h4{
                font-family: 'Titillium Web', sans-serif !important;
            }
            h4 mark{
                color: blue
            }
        </style>

    </head>

    <body>

        <div class="main-wrapper">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="header">
                    <?php include './parts/top-nav.php'; ?>
                </div>

                <div class="sidebar" id="sidebar">
                    <?php include './parts/side-nav.php'; ?>
                </div>
            <?php } ?>
            <div class="page-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-8 col-6">
                            <form method = "POST" action = "">
                                <table>
                                    <td><input type="" placeholder="Doctor's ID..." name="doctor_id" list="doctors" class="form-control" style="min-width: 200px" autocomplete="off" required></td>
                                    <td><input type="submit" value="Search" class="btn btn-primary" name="search" style="height: 40px"></td>
                                    <datalist id = "doctors">
                                        <?php while ($row = $doctors->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['user_id'] ?>">
                                                <?php echo $row['first_name'] . ' ' . $row['last_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </datalist>
                                </table>
                            </form>
                            </h4>
                        </div>

                        <div class = "col-sm-4 col-6 text-right m-b-30">
                            <a href = "add-schedule.php" class = "btn btn-primary btn-rounded"><i class = "fa fa-plus"></i> New</a>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-sm-2"></div>
                        <div class = "col-sm-8">
                            <form method="POST" action="">
                                <?php
                                if (isset($_POST['search'])) {
                                    $output = $server->ScheduleData($_POST);
                                    if ($output->num_rows > 0) {
                                        while ($row = $output->fetch_assoc()) {
                                            ?>
                                            <mark>DOCTOR ID:</mark><?php echo $row['doctor_id'] ?>
                                            <input type="hidden" name="doctor_id"  value="<?php echo $row['doctor_id'] ?>"/>
                                            <table class="table table-striped table-hover">
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Time Range</th>
                                                    <th>
                                                        Select &emsp;<input type="checkbox" class="select-all checkbox" name="select-all" />
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td><input value="Saturday" readonly name="day_1"/></td>
                                                    <td><input  name="day1_time" value="<?php echo $row['day1_time'] ?>"/></td>
                                                    <td>
                                                        <input type="hidden" name="day1_status" value="0"/>
                                                        <input type="checkbox" class="select-item checkbox" name="day1_status" value="1" <?php
                                                        if ($row['day1_status'] == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?>/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input value="Sunday" readonly name="day_2"/></td>
                                                    <td><input  name="day2_time" value="<?php echo $row['day2_time'] ?>"/></td>
                                                    <td>
                                                        <input type="hidden" name="day2_status" value="0"/>
                                                        <input type="checkbox" class="select-item checkbox" name="day2_status" value="1" <?php
                                                        if ($row['day2_status'] == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?>/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input value="Monday" readonly name="day_3"/></td>
                                                    <td><input  name="day3_time" value="<?php echo $row['day3_time'] ?>"/></td>
                                                    <td>
                                                        <input type="hidden" name="day3_status" value="0"/>
                                                        <input type="checkbox" class="select-item checkbox" name="day3_status" value="1" <?php
                                                        if ($row['day3_status'] == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?>/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input value="Tuesday" readonly name="day_4"/></td>
                                                    <td><input  name="day4_time" value="<?php echo $row['day4_time'] ?>"/></td>
                                                    <td>
                                                        <input type="hidden" name="day4_status" value="0"/>
                                                        <input type="checkbox" class="select-item checkbox" name="day4_status" value="1" <?php
                                                        if ($row['day4_status'] == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?>/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input value="Wednesday" readonly name="day_5"/></td>
                                                    <td><input  name="day5_time" value="<?php echo $row['day5_time'] ?>"/></td>
                                                    <td>
                                                        <input type="hidden" name="day5_status" value="0"/>
                                                        <input type="checkbox" class="select-item checkbox" name="day5_status" value="1" <?php
                                                        if ($row['day5_status'] == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?>/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input value="Thursday" readonly name="day_6"/></td>
                                                    <td><input  name="day6_time" value="<?php echo $row['day6_time'] ?>"/></td>
                                                    <td>
                                                        <input type="hidden" name="day6_status" value="0"/>
                                                        <input type="checkbox" class="select-item checkbox" name="day6_status" value="1" <?php
                                                        if ($row['day6_status'] == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?>/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input value="Friday" readonly name="day_7"/></td>
                                                    <td><input  name="day7_time" value="<?php echo $row['day7_time'] ?>"/></td>
                                                    <td>
                                                        <input type="hidden" name="day7_status" value="0"/>
                                                        <input type="checkbox" class="select-item checkbox" name="day7_status" value="1" <?php
                                                        if ($row['day7_status'] == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?>/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><input class="btn btn-primary" type="submit" name="update" value="Update" /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><input class="btn btn-danger" type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure?');"/></td>
                                                </tr>
                                            </table>

                                        </form>
                                        <button id="select-all" class="btn button-default">SELECT All/CANCEL</button>
                                        <button id="select-invert" class="btn button-default">INVERT</button>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-md-12 col-sm-12  col-lg-12">
                                        <div class="profile-widget">
                                            <center>
                                                <img alt="" src="../gallery/NoRecordFound.jpg" alt="" style="height: 100%;width: 100%">
                                            </center>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
<?php include './parts/messages.php'; ?>
            </div>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>

        <!--scripts-->
<?php include './parts/js-links.php'; ?>
        <script>
            $(function () {

                //button select all or cancel
                $("#select-all").click(function () {
                    var all = $("input.select-all")[0];
                    all.checked = !all.checked
                    var checked = all.checked;
                    $("input.select-item").each(function (index, item) {
                        item.checked = checked;
                    });
                });

                //button select invert
                $("#select-invert").click(function () {
                    $("input.select-item").each(function (index, item) {
                        item.checked = !item.checked;
                    });
                    checkSelected();
                });

                //button get selected info
                $("#selected").click(function () {
                    var items = [];
                    $("input.select-item:checked:checked").each(function (index, item) {
                        items[index] = item.value;
                    });
                    if (items.length < 1) {
                        alert("no selected items!!!");
                    } else {
                        var values = items.join(',');
                        console.log(values);
                        var html = $("<div></div>");
                        html.html("selected:" + values);
                        html.appendTo("body");
                    }
                });

                //column checkbox select all or cancel
                $("input.select-all").click(function () {
                    var checked = this.checked;
                    $("input.select-item").each(function (index, item) {
                        item.checked = checked;
                    });
                });

                //check selected items
                $("input.select-item").click(function () {
                    var checked = this.checked;
                    console.log(checked);
                    checkSelected();
                });

                //check is all selected
                function checkSelected() {
                    var all = $("input.select-all")[0];
                    var total = $("input.select-item").length;
                    var len = $("input.select-item:checked:checked").length;
                    console.log("total:" + total);
                    console.log("len:" + len);
                    all.checked = len === total;
                }
            });
        </script>
    </body>
</html>