<?php

/**
 * Modify the GravityView Inline Edit plugin to change the label
 */

function change_inline_labels( $labels ) {
    $labels = array(
        'toggle'   => __( 'Toggle IE', 'gravityview-inline-edit' ),
        'disabled' => __( 'Enable IE', 'gravityview-inline-edit' ),
        'enabled'  => __( 'Disable IE', 'gravityview-inline-edit' ),
        );
    return $labels;
}