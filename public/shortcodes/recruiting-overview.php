<?php

/**
 * Shortcode functionality to display the recruiting overview statistics.
 */

function recruiting_overview($form_id, $field_id) {

    // instantiate the desired stats variables
    $enrolled_last_30_days = 0;
    $enrolled_last_7_days = 0;
    $active_last_10_days = 0;
    $active_pipeline = 0;
    $percent_completed = 0;

    // key form fields
    $date_enrolled = 38;
    $last_log_in = 39;
    $ple_completion_count = 41;
    $prepared_count = 46;


    // GFAPI query: all candidates with status "Accepted - Pending XCEL"
    $accepted_pending_xcel_query = array(
        'status' => 'active',
        'field_filters' => array(
            'mode' => 'any',
            array(
                'key' => $field_id,
                'value' => 'Accepted - Pending XCEL',
            )
        )
    );

    // collect all candidate entries from the form id
    $accepted_pending_xcel_entries = GFAPI::get_entries($form_id, $accepted_pending_xcel_query);

    // echo '<pre>';
    // print_r($accepted_pending_xcel_entries);
    // echo '</pre>';

    // loop through each entry and collect the desired stats
    foreach ($accepted_pending_xcel_entries as $entry) {

        // get the date enrolled
        $date_enrolled_value = $entry[$date_enrolled];

        // get the last log in
        $last_log_in_value = $entry[$last_log_in];

        // get the ple completion count
        $ple_completion_count_value = $entry[$ple_completion_count];

        // get the prepared count
        $prepared_count_value = $entry[$prepared_count];

        // get the current date
        $current_date = date('Y-m-d');

        // get the date 30 days ago
        $date_30_days_ago = date('Y-m-d', strtotime('-30 days'));

        // get the date 7 days ago
        $date_7_days_ago = date('Y-m-d', strtotime('-7 days'));

        // get the date 10 days ago
        $date_10_days_ago = date('Y-m-d', strtotime('-10 days'));

        // check if the date enrolled is within the last 30 days
        if ($date_enrolled_value >= $date_30_days_ago) {
            $enrolled_last_30_days++;
        }

        // check if the date enrolled is within the last 7 days
        if ($date_enrolled_value >= $date_7_days_ago) {
            $enrolled_last_7_days++;
        }

        // check if the last log in is within the last 10 days
        if ($last_log_in_value >= $date_10_days_ago) {
            $active_last_10_days++;
        }

        // check if the ple completion count is greater than 0
        if ($ple_completion_count_value > 0) {
            $active_pipeline++;
        }

        // check if the prepared count is greater than 0
        if ($prepared_count_value > 0) {
            $active_pipeline++;
        }

    }

    $payload = '';
    $payload .= '<div class="tjg-recruiting-overview">'; // wrapper
    $payload .= '<div class="tjg-recruiting-overview__header">Recruiting Overview - styled and updated later</div>';   // header
    $payload .= '<div class="tjg-recruiting-overview__body">'; // body
    // begin table: Enrolled Last 30 Days, Enrolled Last 7 Days, Active Last 10 Days, Active Pipeline, Percent Completed
    $payload .= '<table class="tjg-recruiting-overview__table">';
    $payload .= '<tr>';
    $payload .= '<td>Enrolled Last 30 Days</td>';
    $payload .= '<td>Enrolled Last 7 Days</td>';
    $payload .= '<td>Active Last 10 Days</td>';
    $payload .= '<td>Active Pipeline</td>';
    $payload .= '<td>Percent Completed</td>';
    $payload .= '</tr>';
    $payload .= '<tr>';
    $payload .= '<td>' . $enrolled_last_30_days . '</td>';
    $payload .= '<td>' . $enrolled_last_7_days . '</td>';
    $payload .= '<td>' . $active_last_10_days . '</td>';
    $payload .= '<td>' . $active_pipeline . '</td>';
    $payload .= '<td>' . $percent_completed . '</td>';
    $payload .= '</tr>';
    $payload .= '</table>';
    // end table
    $payload .= '</div>'; // end body
    $payload .= '</div>'; // end wrapper

    return $payload;

}