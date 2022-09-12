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

    // key fields
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

    echo '<pre>';
    print_r($accepted_pending_xcel_entries);
    echo '</pre>';
    die;

    $payload = '';
    $payload .= '<div class="tjg-recruiting-overview">'; // wrapper
    $payload .= '<div class="tjg-recruiting-overview__header">Recruiting Overview - styled and updated later</div>';   // header
    $payload .= '<div class="tjg-recruiting-overview__body">'; // body
    // begin table
    $payload .= '<table class="tjg-recruiting-overview__table">';
    $payload .= '<thead> <tr> <th>Enrolled</th> <th>Active</th> <th>Completed</th> </tr> </thead>';
    $payload .= '<tbody> <tr> <td>0</td> <td>0</td> <td>0</td> </tr> </tbody>';
    $payload .= '</table>';
    // end table
    $payload .= '</div>'; // end body
    $payload .= '</div>'; // end wrapper

    return $payload;

}