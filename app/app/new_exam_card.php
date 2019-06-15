<?php
    require_once ('connect.php');
    $exam_id = $_GET['exam_commission_id'];
    $exam_date = $_GET['exam_date'];
    $room_name = $_GET['room_name'];
?>
<h2>EGZAMIN DYPLOMOWY </br></h2>
<?php
 echo "DATA: " . $exam_date . "         " . " Pokoj: " . $room_name . "</br>";

?>
<table>
                                    <thead>
                                        <th>Godzina rozpoczecia</th>
                                        <th>Dyplomant</th>
                                        <th>Przewodniczacy komisji</th>
                                        <th>Promotor</th>
                                        <th>Recenznent</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $db_connection = new DatabaseConnection();
                                        $db_connection->establishConnection();
//                                        $query = "SELECT * FROM EXAM_COMMISSION WHERE exam_commission_id = '$exam_id' ";


//                                        echo $query;
                                        if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                            die("Error occured while attempting to connect to the datebase!");

                                        }
                                        else {
                                            $query = "SELECT  ec.exam_commission_id
                                                        , ec.PK_exam_group_1_id
                                                        , ec.PK_exam_group_2_id
                                                        , ec.PK_exam_group_3_id
                                                        , ec.PK_exam_group_4_id
                                                        , ec.PK_leader_id
                                                        , eg1.PK_student_id as g1_id_student
                                                        , eg1.PK_promotor_id as g1_id_promotor
                                                        , eg1.PK_reviewer_id as g1_id_reviewer
                                                        , eg2.PK_student_id as g2_id_student
                                                        , eg2.PK_promotor_id as g2_id_promotor
                                                        , eg2.PK_reviewer_id as g2_id_reviewer
                                                        , eg3.PK_student_id as g3_id_student
                                                        , eg3.PK_promotor_id as g3_id_promotor
                                                        , eg3.PK_reviewer_id as g3_id_reviewer
                                                        , eg4.PK_student_id as g4_id_student
                                                        , eg4.PK_promotor_id as g4_id_promotor
                                                        , eg4.PK_reviewer_id as g4_id_reviewer
                                                        , ec.start_time
                                                        , ec.start_time
                                                        , ec.exam_date
                                                        , ec.exam_confirmed
                                                FROM EXAM_COMMISSION AS ec
                                                INNER JOIN faculty AS f ON ec.PK_faculty_id=f.faculty_id
                                                INNER JOIN exam_group eg1 on ec.PK_exam_group_1_id = eg1.exam_group_id
                                                INNER JOIN exam_group eg2 on ec.PK_exam_group_2_id = eg2.exam_group_id
                                                INNER JOIN exam_group eg3 on ec.PK_exam_group_3_id = eg3.exam_group_id
                                                INNER JOIN exam_group eg4 on ec.PK_exam_group_4_id = eg4.exam_group_id
                                                WHERE exam_commission_id = '$exam_id' ";

                                            if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                echo "Invalid query!";
                                            }
                                            else {
                                                while ($row = $result->fetch_assoc()) {


                                                    $head_id = $row['PK_leader_id'];
                                                    $student_id_1 = $row['g1_id_student'];
                                                    $student_id_2 = $row['g2_id_student'];
                                                    $student_id_3 = $row['g3_id_student'];
                                                    $student_id_4 = $row['g4_id_student'];
                                                    $promotor_id_1 = $row['g1_id_promotor'];
                                                    $promotor_id_2 = $row['g2_id_promotor'];
                                                    $promotor_id_3 = $row['g3_id_promotor'];
                                                    $promotor_id_4 = $row['g4_id_promotor'];
                                                    $reviewer_id_1 = $row['g1_id_reviewer'];
                                                    $reviewer_id_2 = $row['g2_id_reviewer'];
                                                    $reviewer_id_3 = $row['g3_id_reviewer'];
                                                    $reviewer_id_4 = $row['g4_id_reviewer'];
                                                    $start_time = $row['start_time'];
                                                    $exam_group_1 = $row['PK_exam_group_1_id'];
                                                    $exam_group_2 = $row['PK_exam_group_2_id'];
                                                    $exam_group_3 = $row['PK_exam_group_3_id'];
                                                    $exam_group_4 = $row['PK_exam_group_4_id'];


                                                    ?>
                                                    <tr>

                                                        <td>
                                                            <?php

//                                                                echo $head_id;
                                                                echo $start_time;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(surname,' ',firstname) as full_student_name from student WHERE student_id='$student_id_1'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_student_name'];
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $db_connection = new DatabaseConnection();
                                                            $db_connection->establishConnection();
//                                                            echo $head_id;
                                                            if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                die("Error occured while attempting to connect to the datebase!");

                                                            }
                                                            else {
                                                                $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$head_id'";
//echo $query;
                                                                if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                    echo "Invalid query!";
                                                                }
                                                                else {

                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo $row['full_head_name'];
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $db_connection = new DatabaseConnection();
                                                            $db_connection->establishConnection();

                                                            if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                die("Error occured while attempting to connect to the datebase!");

                                                            }
                                                            else {
                                                                $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$promotor_id_1'";
//echo $query;
                                                                if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                    echo "Invalid query!";
                                                                }
                                                                else {

                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo $row['full_head_name'];
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if ($reviewer_id_1 == null ) {
                                                                    echo '-';
                                                                }
                                                                else {
                                                                    $db_connection = new DatabaseConnection();
                                                                    $db_connection->establishConnection();

                                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                        die("Error occured while attempting to connect to the datebase!");

                                                                    }
                                                                    else {
                                                                        $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$reviewer_id_1'";
//echo $query;
                                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                            echo "Invalid query!";
                                                                        }
                                                                        else {

                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo $row['full_head_name'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    if ($exam_group_2 != 1) {
                                                        ?>
                                                        <tr>

                                                            <td>
                                                                <?php

                                                                    $start_time = strtotime("15 minutes", strtotime($start_time));
                                                                    $start_time = date('H:i:s',$start_time);
                                                                    echo $start_time;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(surname,' ',firstname) as full_student_name from student WHERE student_id='$student_id_2'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_student_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                //                                                            echo $head_id;
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$head_id'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();

                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$promotor_id_2'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($reviewer_id_2 == null ) {
                                                                    echo '-';
                                                                }
                                                                else {
                                                                    $db_connection = new DatabaseConnection();
                                                                    $db_connection->establishConnection();

                                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                        die("Error occured while attempting to connect to the datebase!");

                                                                    }
                                                                    else {
                                                                        $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$reviewer_id_2'";

                                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                            echo "Invalid query!";
                                                                        }
                                                                        else {

                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo $row['full_head_name'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    if ( $exam_group_3 != 1) {
                                                        ?>
                                                        <tr>

                                                            <td>
                                                                <?php

                                                                $start_time = strtotime("15 minutes", strtotime($start_time));
                                                                $start_time = date('H:i:s',$start_time);
                                                                echo $start_time;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(surname,' ',firstname) as full_student_name from student WHERE student_id='$student_id_3'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_student_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                //                                                            echo $head_id;
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$head_id'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();

                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$promotor_id_3'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($reviewer_id_3 == null ) {
                                                                    echo '-';
                                                                }
                                                                else {
                                                                    $db_connection = new DatabaseConnection();
                                                                    $db_connection->establishConnection();

                                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                        die("Error occured while attempting to connect to the datebase!");

                                                                    }
                                                                    else {
                                                                        $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$reviewer_id_3'";

                                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                            echo "Invalid query!";
                                                                        }
                                                                        else {

                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo $row['full_head_name'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php

                                                    }
                                                    if ( $exam_group_4 != 1) {
                                                        ?>
                                                        <tr>

                                                            <td>
                                                                <?php

                                                                $start_time = strtotime("15 minutes", strtotime($start_time));
                                                                $start_time = date('H:i:s',$start_time);
                                                                echo $start_time;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(surname,' ',firstname) as full_student_name from student WHERE student_id='$student_id_4'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_student_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                //                                                            echo $head_id;
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$head_id'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();

                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$promotor_id_4'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($reviewer_id_4 == null ) {
                                                                    echo '-';
                                                                }
                                                                else {
                                                                    $db_connection = new DatabaseConnection();
                                                                    $db_connection->establishConnection();

                                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                        die("Error occured while attempting to connect to the datebase!");

                                                                    }
                                                                    else {
                                                                        $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$reviewer_id_4'";

                                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                            echo "Invalid query!";
                                                                        }
                                                                        else {

                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo $row['full_head_name'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>