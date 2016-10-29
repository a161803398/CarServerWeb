<?php
session_start();
$cur_user_id = $_SESSION['user_id'];
include("/tools/db.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
        <script src="dist/js/jquery.min.js"></script>
        <link  rel="stylesheet" href="jquery/jquery.dataTables.css">
        <script type="text/javascript" src="jquery/jquery.min.js"></script>
        <script type="text/javascript" src="jquery/jquery.dataTables.min.js"></script>
        <title>shopping</title>
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="dist/css/docs.min.css">
    </head>
    <body>
        <div class="bs-example">
            <table class="table" id="table1">
                <thead>
                    <tr> 
                        <?php
                        foreach ($carInfoCols as &$value) {
                            echo '<th>' . $value . '</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
//                    $filter = mysql_escape_string($_POST['type_id']);
//                    $filter_name = mysql_fetch_row(mysql_query("SELECT name FROM type WHERE type_id = $filter;"))[0];

                    $data = mysql_query("SELECT `user_id`, `vehicle_id` , `start_time`, `insert_time`, `latitude`, `longitude`, `vehicle_speed`, `instant_fuel_economy`, `total_fuel_economy`, `fuel_rate`, `accel_x`, `accel_y`, `accel_z`, `accel_x_grav`, `accel_y_grav`, `accel_z_grav`, `rotation_rate_x`, `rotation_rate_y`, `rotation_rate_z`, `roll`, `pitch`, `magnetometer_x`, `magnetometer_y`, `magnetometer_z`, `fuel_system_1_status`, `calculated_load_value`, `engine_coolant_temperature`, `short_term_fuel_trim__bank_1`, `long_term_fuel_trim__bank_1`, `engine_rpm`, `ignition_timing_advance_for_1_cylinder`, `intake_air_temperature`, `absolute_throttle_position`, `location_of_oxygen_sensors`, `o2_voltage`, `short_term_fuel_trim`, `obd_requirements_certified`, `time_since_engine_start`, `commanded_evaporative_purge`, `fuel_level_input`, `number_of_warm_ups_since_dtcs_cleared`, `distance_traveled_since_dtcs_cleared`, `barometric_pressure`, `o2_sensor_lambda_wide_range`, `o2_sensor_current_wide_range`, `catalyst_temperature`, `control_module_voltage`, `absolute_load_value`, `fuelair_commanded_equivalence_ratio`, `relative_throttle_position`, `ambient_air_temperature`, `absolute_throttle_position_b`, `accelerator_pedal_position_d`, `accelerator_pedal_position_e`, `commanded_throttle_actuator_control`, `input_voltage_read_by_the_scan_tool`, `acceleration`, `acceleration_avg`, `af_commanded`, `af_actual`, `altitude`, `bearing`, `gps_speed`, `horz_accuracy` FROM `car_info`");

                    while ($row = mysql_fetch_row($data)) {
                        echo'<tr>';
                        for ($i = 0; $i < 64; $i++) {
                            echo' <td>' . $row[$i] . '</td>';
                        }
                        echo'</tr>';
                    }
                    if (mysql_errno() != 0) {
                        echo mysql_errno() . ": " . mysql_error() . "<br>"; //show other error
                    }
                    ?> 
                </tbody>
            </table>
        </div>


        <script>
            $(document).ready(function ()
            {
                $("#table1").dataTable();
            });
            function buy(good_id) {
                $.post('buygoods.php', {good_id: good_id}, function (data) {
                    $('#goodframe').html(data);
                });
            }

            function edit(good_id) {
                $.post('addgoods.php', {good_id: good_id}, function (data) {
                    $('#goodframe').html(data);
                });
            }


        </script>
    </body>
</html>
