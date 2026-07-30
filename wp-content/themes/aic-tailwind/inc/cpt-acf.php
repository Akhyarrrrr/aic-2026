<?php
if (!defined('ABSPATH')) exit;

// ============================================
// Register Custom Post Types
// ============================================
function aic_register_cpts() {
    register_post_type('speaker', [
        'labels' => [
            'name'          => 'Speakers',
            'singular_name' => 'Speaker',
            'add_new'       => 'Add Speaker',
            'add_new_item'  => 'Add New Speaker',
            'edit_item'     => 'Edit Speaker',
            'all_items'     => 'All Speakers',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'show_in_menu' => 'aic',
        'menu_icon'    => 'dashicons-microphone',
        'supports'     => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'rewrite'      => ['slug' => 'speakers'],
    ]);

    register_post_type('committee', [
        'labels' => [
            'name'          => 'Committees',
            'singular_name' => 'Committee',
            'add_new'       => 'Add Member',
            'add_new_item'  => 'Add Committee Member',
            'edit_item'     => 'Edit Member',
            'all_items'     => 'All Members',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'show_in_menu' => 'aic',
        'menu_icon'    => 'dashicons-groups',
        'supports'     => ['title', 'page-attributes'],
        'rewrite'      => ['slug' => 'committee'],
    ]);
}
add_action('init', 'aic_register_cpts');

// ============================================
// Register ACF Field Groups (speaker + committee only)
// ============================================
function aic_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'    => 'group_speaker',
        'title'  => 'Speaker Details',
        'fields' => [
            [
                'key'          => 'field_speaker_title',
                'label'        => 'Title / Position',
                'name'         => 'speaker_title',
                'type'         => 'text',
                'instructions' => 'e.g. Professor of Computer Science',
                'placeholder'  => 'Professor',
            ],
            [
                'key'          => 'field_speaker_affiliation',
                'label'        => 'Affiliation',
                'name'         => 'speaker_affiliation',
                'type'         => 'text',
                'instructions' => 'University or institution name',
            ],
            [
                'key'          => 'field_speaker_track',
                'label'        => 'Track',
                'name'         => 'speaker_track',
                'type'         => 'select',
                'choices'      => [
                    'se'  => 'SE - Sciences & Engineering',
                    'els' => 'ELS - Environmental & Life Sciences',
                    'ss'  => 'SS - Social Sciences',
                    'all' => 'All Tracks / Keynote',
                ],
                'default_value' => 'se',
                'return_format' => 'value',
            ],
            [
                'key'          => 'field_speaker_keynote',
                'label'        => 'Keynote Speaker?',
                'name'         => 'speaker_is_keynote',
                'type'         => 'true_false',
                'ui'           => 1,
                'default_value'=> 0,
            ],
            [
                'key'          => 'field_speaker_order',
                'label'        => 'Display Order',
                'name'         => 'speaker_order',
                'type'         => 'number',
                'default_value'=> 0,
                'min'          => 0,
                'max'          => 999,
                'instructions' => 'Lower = appears first',
            ],
        ],
        'location' => [
            [['param' => 'post_type', 'operator' => '==', 'value' => 'speaker']],
        ],
        'menu_order'        => 0,
        'position'          => 'acf_after_title',
        'label_placement'   => 'top',
        'show_in_rest'      => true,
    ]);

    acf_add_local_field_group([
        'key'    => 'group_committee',
        'title'  => 'Committee Member Details',
        'fields' => [
            [
                'key'          => 'field_committee_role',
                'label'        => 'Role',
                'name'         => 'committee_role',
                'type'         => 'text',
                'instructions' => 'e.g. Chairperson, Co-Chair, Secretary, Member',
            ],
            [
                'key'          => 'field_committee_affiliation',
                'label'        => 'Affiliation',
                'name'         => 'committee_affiliation',
                'type'         => 'text',
                'instructions' => 'University or institution name',
            ],
            [
                'key'          => 'field_committee_track',
                'label'        => 'Track',
                'name'         => 'committee_track',
                'type'         => 'select',
                'choices'      => [
                    'se'  => 'SE - Sciences & Engineering',
                    'els' => 'ELS - Environmental & Life Sciences',
                    'ss'  => 'SS - Social Sciences',
                    'all' => 'All Tracks / General',
                ],
                'default_value' => 'all',
                'return_format' => 'value',
            ],
        ],
        'location' => [
            [['param' => 'post_type', 'operator' => '==', 'value' => 'committee']],
        ],
        'menu_order'        => 0,
        'position'          => 'acf_after_title',
        'label_placement'   => 'top',
        'show_in_rest'      => true,
    ]);
}
add_action('acf/init', 'aic_register_acf_fields');
