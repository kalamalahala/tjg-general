<?php

/**
 * Modify the GravityView Inline Edit plugin to change the label
 */

function change_inline_labels( $labels ) {
    $labels = array(
        'toggle'   => __( 'Edit Fields', 'gravityview-inline-edit' ),
        'disabled' => __( 'Edit Fields', 'gravityview-inline-edit' ),
        'enabled'  => __( 'Disable Edit', 'gravityview-inline-edit' ),
        );
    return $labels;
}