<?php

session_start();

if (!$_SESSION['user_id']) {
    header("Location:login.php");
}
header("Content-Type:text/html; charset=utf-8");

switch ($_POST['apiFun']) {
    case 'infoAdd':
        infoAdd();
        break;
}

function infoAdd() {
    include("/tools/db.php");
    $cur_user_id = $_SESSION['user_id'];
    $sqlStr = "INSERT INTO `car_info`(`user_id`, `vehicle_id`, `start_time`, `latitude`, `longitude`, `vehicle_speed`, `instant_fuel_economy`, `total_fuel_economy`, `fuel_rate`, `accel_x`, `accel_y`, `accel_z`, `accel_x_grav`, `accel_y_grav`, `accel_z_grav`, `rotation_rate_x`, `rotation_rate_y`, `rotation_rate_z`, `roll`, `pitch`, `magnetometer_x`, `magnetometer_y`, `magnetometer_z`, `fuel_system_1_status`, `calculated_load_value`, `engine_coolant_temperature`, `short_term_fuel_trim__bank_1`, `long_term_fuel_trim__bank_1`, `engine_rpm`, `ignition_timing_advance_for_1_cylinder`, `intake_air_temperature`, `absolute_throttle_position`, `location_of_oxygen_sensors`, `o2_voltage`, `short_term_fuel_trim`, `obd_requirements_certified`, `time_since_engine_start`, `commanded_evaporative_purge`, `fuel_level_input`, `number_of_warm_ups_since_dtcs_cleared`, `distance_traveled_since_dtcs_cleared`, `barometric_pressure`, `o2_sensor_lambda_wide_range`, `o2_sensor_current_wide_range`, `catalyst_temperature`, `control_module_voltage`, `absolute_load_value`, `fuelair_commanded_equivalence_ratio`, `relative_throttle_position`, `ambient_air_temperature`, `absolute_throttle_position_b`, `accelerator_pedal_position_d`, `accelerator_pedal_position_e`, `commanded_throttle_actuator_control`, `input_voltage_read_by_the_scan_tool`, `acceleration`, `acceleration_avg`, `af_commanded`, `af_actual`, `altitude`, `bearing`, `gps_speed`, `horz_accuracy`) " .
            "VALUES ('$cur_user_id'";

    foreach ($carInsertInfoCols as &$value) {
        $valStr = mysql_escape_string($_POST[$value]);
        if (empty($valStr)) {
            $valStr = 'NULL';
        }
        $sqlStr .= "," . $valStr;
    }
    $sqlStr .= ")";

    mysql_query($sqlStr);

    if (mysql_errno() != 0) {
        echo mysql_errno() . ": " . mysql_error(); //show other error
    } else {
        echo "success";
    }
}
?>