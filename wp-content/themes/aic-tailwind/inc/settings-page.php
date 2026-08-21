<?php
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function () {
    // Top-level AIC menu
    add_menu_page(
        'AIC',
        'AIC',
        'manage_options',
        'aic',
        'aic_dashboard_page',
        'dashicons-welcome-learn-more',
        3
    );
    // Settings sub-page
    add_submenu_page(
        'aic',
        'AIC Settings',
        'Settings',
        'manage_options',
        'aic-settings',
        'aic_settings_page'
    );
});

function aic_dashboard_page() {
    if (!current_user_can('manage_options')) wp_die('Access denied');
    ?>
    <div class="wrap">
        <h1>AIC Management</h1>
        <p class="description">Manage all content for the Annual International Conference (AIC).</p>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;margin-top:24px;">
            <?php
            $cards = [
                ['Settings', 'Configure hero, dates, fees, templates, schedule, and more.', 'admin.php?page=aic-settings', 'dashicons-admin-settings'],
                ['Speakers', 'Manage keynote and invited speakers.', 'edit.php?post_type=speaker', 'dashicons-microphone'],
                ['Committees', 'Manage committee members.', 'edit.php?post_type=committee', 'dashicons-groups'],
            ];
            foreach ($cards as $c):
            ?>
            <a href="<?php echo esc_url(admin_url($c[2])); ?>" style="display:block;background:#fff;border:1px solid #c3c4c7;border-radius:6px;padding:20px;text-decoration:none;color:#1d2327;">
                <span class="dashicons <?php echo esc_attr($c[3]); ?>" style="font-size:32px;width:32px;height:32px;color:#0D5F3A;margin-bottom:8px;"></span>
                <h3 style="margin:0 0 4px;font-size:14px;"><?php echo esc_html($c[0]); ?></h3>
                <p style="margin:0;color:#646970;font-size:12px;"><?php echo esc_html($c[1]); ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'aic_page_aic-settings' && $hook !== 'toplevel_page_aic') return;
    wp_enqueue_media();
    wp_enqueue_editor();
});

function aic_settings_page() {
    if (!current_user_can('manage_options')) wp_die('Access denied');

    if (isset($_POST['aic_save']) && check_admin_referer('aic_settings')) {
        $tab = sanitize_key($_POST['aic_tab'] ?? 'hero');
        $data = $_POST['aic'] ?? [];

        if ($tab === 'hero') {
            update_option('aic_edition_number',     sanitize_text_field($data['edition_number'] ?? '16th'));
            update_option('aic_conference_date',    sanitize_text_field($data['conference_date'] ?? 'November 4-5, 2026'));
            update_option('aic_conference_location', sanitize_text_field($data['conference_location'] ?? 'Banda Aceh, Indonesia'));
            update_option('aic_hero_tagline',       sanitize_textarea_field($data['hero_tagline'] ?? ''));
            update_option('aic_countdown_date',     sanitize_text_field($data['countdown_date'] ?? '2026-11-04'));
            update_option('aic_countdown_end_date', sanitize_text_field($data['countdown_end_date'] ?? '2026-11-06'));
            update_option('aic_stat_countries',     sanitize_text_field($data['stat_countries'] ?? '30+'));
            update_option('aic_stat_papers',        sanitize_text_field($data['stat_papers'] ?? '150+'));
            update_option('aic_stat_tracks',        sanitize_text_field($data['stat_tracks'] ?? '3'));
        }
        if ($tab === 'chair') {
            update_option('aic_chair_name',    sanitize_text_field($data['chair_name'] ?? ''));
            update_option('aic_chair_title',   sanitize_text_field($data['chair_title'] ?? ''));
            update_option('aic_chair_message', wp_kses_post($data['chair_message'] ?? ''));
            update_option('aic_chair_photo',   absint($data['chair_photo'] ?? 0));
        }
        if ($tab === 'dates') {
            $dates = [];
            if (!empty($data['dates']['label'])) {
                foreach ($data['dates']['label'] as $i => $label) {
                    $dates[] = [
                        'date_label' => sanitize_text_field($label),
                        'date_value' => sanitize_text_field($data['dates']['value'][$i] ?? ''),
                        'date_desc'  => sanitize_text_field($data['dates']['desc'][$i] ?? ''),
                    ];
                }
            }
            update_option('aic_important_dates', $dates);
        }
        if ($tab === 'cos') {
            $cos = [];
            if (!empty($data['cos']['name'])) {
                foreach ($data['cos']['name'] as $i => $name) {
                    $cos[] = [
                        'co_name'  => sanitize_text_field($name),
                        'co_desc'  => sanitize_text_field($data['cos']['desc'][$i] ?? ''),
                        'co_url'   => esc_url_raw($data['cos']['url'][$i] ?? ''),
                        'co_logo'  => absint($data['cos']['logo'][$i] ?? 0),
                    ];
                }
            }
            update_option('aic_co_organizers', $cos);
        }
        if ($tab === 'gallery') {
            $ids = array_map('absint', explode(',', $data['gallery_ids'] ?? ''));
            update_option('aic_gallery_images', $ids);
        }
        if ($tab === 'templates') {
            $tmpls = ['tmpl_abstract_se', 'tmpl_abstract_els', 'tmpl_abstract_ss',
                      'tmpl_program_se', 'tmpl_program_els', 'tmpl_program_ss'];
            foreach ($tmpls as $f) {
                $val = absint($data[$f] ?? 0);
                update_option('aic_' . $f, $val);
            }
        }
        if ($tab === 'registration') {
            update_option('aic_fee_presenter_domestic',    sanitize_text_field($data['fee_presenter_domestic'] ?? ''));
            update_option('aic_fee_presenter_intl',        sanitize_text_field($data['fee_presenter_intl'] ?? ''));
            update_option('aic_fee_nonpresenter_domestic', sanitize_text_field($data['fee_nonpresenter_domestic'] ?? ''));
            update_option('aic_fee_nonpresenter_intl',     sanitize_text_field($data['fee_nonpresenter_intl'] ?? ''));
            update_option('aic_fee_notes',                 sanitize_textarea_field($data['fee_notes'] ?? ''));
            update_option('aic_reg_form_url',              esc_url_raw($data['reg_form_url'] ?? ''));
            update_option('aic_submit_url_se',             esc_url_raw($data['submit_url_se'] ?? ''));
            update_option('aic_submit_url_els',            esc_url_raw($data['submit_url_els'] ?? ''));
            update_option('aic_submit_url_ss',             esc_url_raw($data['submit_url_ss'] ?? ''));
            // Per-track fee notes & publication info
            foreach (['se', 'els', 'ss'] as $trk) {
                update_option('aic_fee_notes_' . $trk, sanitize_textarea_field($data['fee_notes_' . $trk] ?? ''));
                update_option('aic_pub_info_' . $trk,  wp_kses_post($data['pub_info_' . $trk] ?? ''));
            }
        }
        if ($tab === 'schedule') {
            foreach (['day1', 'day2'] as $day) {
                $sched = [];
                if (!empty($data['sched'][$day]['time'])) {
                    foreach ($data['sched'][$day]['time'] as $i => $time) {
                        $sched[] = [
                            'sched_time'     => sanitize_text_field($time),
                            'sched_activity' => sanitize_text_field($data['sched'][$day]['activity'][$i] ?? ''),
                            'sched_room'     => sanitize_text_field($data['sched'][$day]['room'][$i] ?? ''),
                            'sched_type'     => sanitize_text_field($data['sched'][$day]['type'][$i] ?? 'parallel'),
                        ];
                    }
                }
                update_option('aic_schedule_' . $day, $sched);
            }
        }

        echo '<div class="notice notice-success is-dismissible"><p>Settings saved.</p></div>';
    }

    $tab = sanitize_key($_GET['tab'] ?? 'hero');
    ?>
    <div class="wrap">
        <h1>AIC Settings</h1>
        <h2 class="nav-tab-wrapper">
            <?php $tabs = [
                'hero'         => 'Hero & Stats',
                'chair'        => 'Chairperson',
                'dates'        => 'Important Dates',
                'cos'          => 'Co-Organizers',
                'gallery'      => 'Gallery',
                'templates'    => 'Templates',
                'registration' => 'Registration',
                'schedule'     => 'Schedule',
            ];
            foreach ($tabs as $key => $label): ?>
                <a href="?page=aic-settings&tab=<?php echo $key; ?>" class="nav-tab <?php echo $tab === $key ? 'nav-tab-active' : ''; ?>"><?php echo $label; ?></a>
            <?php endforeach; ?>
        </h2>

        <form method="post" action="">
            <?php wp_nonce_field('aic_settings'); ?>
            <input type="hidden" name="aic_tab" value="<?php echo esc_attr($tab); ?>">
            <input type="hidden" name="aic_save" value="1">

            <?php aic_settings_tab_content($tab); ?>

            <p class="submit"><button type="submit" class="button button-primary">Save Changes</button></p>
        </form>
    </div>
    <?php
}

function aic_settings_tab_content($tab) {
    ?>
    <table class="form-table" role="presentation">
    <?php
    switch ($tab) {
        case 'hero':
            aic_field_text('Edition Number', 'aic_edition_number', 'aic[edition_number]', 'e.g. 16th');
            aic_field_text('Conference Date', 'aic_conference_date', 'aic[conference_date]', 'e.g. November 4-5, 2026');
            aic_field_text('Conference Location', 'aic_conference_location', 'aic[conference_location]', 'e.g. Banda Aceh, Indonesia');
            aic_field_text('Countdown Date (Start)', 'aic_countdown_date', 'aic[countdown_date]', 'YYYY-MM-DD format');
            aic_field_text('Countdown Date (End)', 'aic_countdown_end_date', 'aic[countdown_end_date]', 'Conference end date');
            aic_field_textarea('Hero Tagline', 'aic_hero_tagline', 'aic[hero_tagline]');
            aic_field_text('Stat: Countries', 'aic_stat_countries', 'aic[stat_countries]');
            aic_field_text('Stat: Papers', 'aic_stat_papers', 'aic[stat_papers]');
            aic_field_text('Stat: Parallel Tracks', 'aic_stat_tracks', 'aic[stat_tracks]');
            break;

        case 'chair':
            aic_field_text('Name', 'aic_chair_name', 'aic[chair_name]');
            aic_field_text('Title', 'aic_chair_title', 'aic[chair_title]');
            aic_field_media('Photo', 'aic_chair_photo', 'aic[chair_photo]');
            aic_field_editor('Message', 'aic_chair_message', 'aic[chair_message]');
            break;

        case 'dates':
            aic_field_repeater_dates();
            break;

        case 'cos':
            aic_field_repeater_cos();
            break;

        case 'gallery':
            aic_field_gallery();
            break;

        case 'templates':
            aic_field_text('Abstract Template — SE', 'aic_tmpl_abstract_se', 'aic[tmpl_abstract_se]', '', 'file');
            aic_field_text('Abstract Template — ELS', 'aic_tmpl_abstract_els', 'aic[tmpl_abstract_els]', '', 'file');
            aic_field_text('Abstract Template — SS', 'aic_tmpl_abstract_ss', 'aic[tmpl_abstract_ss]', '', 'file');
            echo '<tr><td colspan="2"><hr></td></tr>';
            aic_field_text('Program Book — SE', 'aic_tmpl_program_se', 'aic[tmpl_program_se]', '', 'file');
            aic_field_text('Program Book — ELS', 'aic_tmpl_program_els', 'aic[tmpl_program_els]', '', 'file');
            aic_field_text('Program Book — SS', 'aic_tmpl_program_ss', 'aic[tmpl_program_ss]', '', 'file');
            break;

        case 'registration':
            aic_field_text('Presenter Fee — Domestic', 'aic_fee_presenter_domestic', 'aic[fee_presenter_domestic]');
            aic_field_text('Presenter Fee — International', 'aic_fee_presenter_intl', 'aic[fee_presenter_intl]');
            aic_field_text('Non-Presenter Fee — Domestic', 'aic_fee_nonpresenter_domestic', 'aic[fee_nonpresenter_domestic]');
            aic_field_text('Non-Presenter Fee — International', 'aic_fee_nonpresenter_intl', 'aic[fee_nonpresenter_intl]');
            aic_field_textarea('Fee Notes', 'aic_fee_notes', 'aic[fee_notes]');
            aic_field_text('Registration Form URL', 'aic_reg_form_url', 'aic[reg_form_url]', 'https://...');
            echo '<tr><td colspan="2"><hr><p class="description">Submission System URLs</p></td></tr>';
            aic_field_text('Submission URL — SE', 'aic_submit_url_se', 'aic[submit_url_se]', 'https://...');
            aic_field_text('Submission URL — ELS', 'aic_submit_url_els', 'aic[submit_url_els]', 'https://...');
            aic_field_text('Submission URL — SS', 'aic_submit_url_ss', 'aic[submit_url_ss]', 'https://...');
            echo '<tr><td colspan="2"><hr><p class="description">Per-Track Fee Notes &amp; Publication Info</p></td></tr>';
            aic_field_textarea('Fee Notes — AIC-SE', 'aic_fee_notes_se', 'aic[fee_notes_se]');
            aic_field_textarea('Fee Notes — AIC-ELS', 'aic_fee_notes_els', 'aic[fee_notes_els]');
            aic_field_textarea('Fee Notes — AIC-SS', 'aic_fee_notes_ss', 'aic[fee_notes_ss]');
            echo '<tr><td colspan="2"><hr><p class="description">Publication info supports HTML for rich formatting.</p></td></tr>';
            aic_field_textarea('Publication Info — AIC-SE', 'aic_pub_info_se', 'aic[pub_info_se]');
            aic_field_textarea('Publication Info — AIC-ELS', 'aic_pub_info_els', 'aic[pub_info_els]');
            aic_field_textarea('Publication Info — AIC-SS', 'aic_pub_info_ss', 'aic[pub_info_ss]');
            break;

        case 'schedule':
            aic_field_repeater_schedule('Day 1 Schedule', 'aic_schedule_day1', 'aic[sched][day1]');
            aic_field_repeater_schedule('Day 2 Schedule', 'aic_schedule_day2', 'aic[sched][day2]');
            break;
    }
    ?>
    </table>
    <?php
}

// --- Field helpers ---

function aic_field_text($label, $option_name, $input_name, $placeholder = '', $type = 'text') {
    $val = get_option($option_name, '');
    ?>
    <tr>
        <th scope="row"><label for="<?php echo esc_attr($input_name); ?>"><?php echo esc_html($label); ?></label></th>
        <td>
            <?php if ($type === 'file'): ?>
            <div class="aic-file-wrap">
                <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($val); ?>">
                <span class="aic-file-preview"><?php echo $val ? wp_get_attachment_link($val, 'thumbnail', false, true) : ''; ?></span>
                <button type="button" class="button aic-file-upload">Choose File</button>
                <button type="button" class="button aic-file-remove" <?php echo $val ? '' : 'style="display:none"'; ?>>Remove</button>
            </div>
            <?php else: ?>
            <input type="<?php echo esc_attr($type === 'url' ? 'url' : 'text'); ?>" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($val); ?>" class="regular-text" placeholder="<?php echo esc_attr($placeholder); ?>">
            <?php endif; ?>
        </td>
    </tr>
    <?php
}

function aic_field_textarea($label, $option_name, $input_name) {
    $val = get_option($option_name, '');
    ?>
    <tr>
        <th scope="row"><label for="<?php echo esc_attr($input_name); ?>"><?php echo esc_html($label); ?></label></th>
        <td><textarea name="<?php echo esc_attr($input_name); ?>" class="large-text" rows="4"><?php echo esc_textarea($val); ?></textarea></td>
    </tr>
    <?php
}

function aic_field_media($label, $option_name, $input_name) {
    $val = absint(get_option($option_name, 0));
    $preview = $val ? wp_get_attachment_image($val, 'medium') : '';
    ?>
    <tr>
        <th scope="row"><label><?php echo esc_html($label); ?></label></th>
        <td>
            <div class="aic-media-wrap">
                <input type="hidden" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($val); ?>">
                <div class="aic-media-preview"><?php echo $preview; ?></div>
                <p>
                    <button type="button" class="button aic-media-upload"><?php echo $val ? 'Change' : 'Choose Image'; ?></button>
                    <button type="button" class="button aic-media-remove" <?php echo $val ? '' : 'style="display:none"'; ?>>Remove</button>
                </p>
            </div>
        </td>
    </tr>
    <?php
}

function aic_field_editor($label, $option_name, $input_name) {
    $val = get_option($option_name, '');
    ?>
    <tr>
        <th scope="row"><?php echo esc_html($label); ?></th>
        <td>
            <?php
            wp_editor($val, 'aic_editor_' . sanitize_key($input_name), [
                'textarea_name' => $input_name,
                'media_buttons' => false,
                'teeny'         => true,
                'textarea_rows' => 12,
            ]);
            ?>
        </td>
    </tr>
    <?php
}

function aic_field_gallery() {
    $ids = get_option('aic_gallery_images', []);
    if (!is_array($ids)) $ids = [];
    $previews = '';
    foreach ($ids as $id) {
        $src = wp_get_attachment_image_src($id, 'thumbnail');
        if ($src) {
            $previews .= '<div class="aic-gallery-item" data-id="' . esc_attr($id) . '"><img src="' . esc_url($src[0]) . '"><span class="aic-gallery-remove">&times;</span></div>';
        }
    }
    ?>
    <tr>
        <th scope="row">Gallery Images</th>
        <td>
            <input type="hidden" name="aic[gallery_ids]" id="aic-gallery-ids" value="<?php echo esc_attr(implode(',', $ids)); ?>">
            <div id="aic-gallery-previews" class="aic-gallery-grid"><?php echo $previews; ?></div>
            <p><button type="button" class="button" id="aic-gallery-add">Add Images</button></p>
            <p class="description">Drag to reorder. Click &times; to remove.</p>
        </td>
    </tr>
    <?php
}

function aic_field_repeater_dates() {
    $dates = get_option('aic_important_dates', []);
    if (!is_array($dates)) $dates = [];
    ?>
    <tr>
        <th scope="row">Important Dates</th>
        <td>
            <table class="wp-list-table widefat striped" id="aic-dates-table">
                <thead><tr><th>Event</th><th>Date</th><th>Description</th><th></th></tr></thead>
                <tbody>
                    <?php foreach ($dates as $i => $d): ?>
                    <tr>
                        <td><input type="text" name="aic[dates][label][]" value="<?php echo esc_attr($d['date_label'] ?? ''); ?>" class="regular-text"></td>
                        <td><input type="text" name="aic[dates][value][]" value="<?php echo esc_attr($d['date_value'] ?? ''); ?>" class="regular-text"></td>
                        <td><input type="text" name="aic[dates][desc][]" value="<?php echo esc_attr($d['date_desc'] ?? ''); ?>" style="width:100%"></td>
                        <td><button type="button" class="button aic-row-remove">&times;</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><button type="button" class="button" id="aic-dates-add">Add Row</button></p>
        </td>
    </tr>
    <?php
}

function aic_field_repeater_cos() {
    $cos = get_option('aic_co_organizers', []);
    if (!is_array($cos)) $cos = [];
    ?>
    <tr>
        <th scope="row">Co-Organizers</th>
        <td>
            <div id="aic-cos-wrap">
                <?php foreach ($cos as $i => $co): ?>
                <div class="aic-co-row" style="background:#f6f7f7;padding:12px;margin-bottom:8px;border:1px solid #c3c4c7;border-radius:4px;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                        <div>
                            <label style="font-weight:600;font-size:11px;text-transform:uppercase;">Name</label>
                            <input type="text" name="aic[cos][name][]" value="<?php echo esc_attr($co['co_name'] ?? ''); ?>" class="regular-text" style="width:100%">
                        </div>
                        <div>
                            <label style="font-weight:600;font-size:11px;text-transform:uppercase;">Description</label>
                            <input type="text" name="aic[cos][desc][]" value="<?php echo esc_attr($co['co_desc'] ?? ''); ?>" class="regular-text" style="width:100%">
                        </div>
                        <div>
                            <label style="font-weight:600;font-size:11px;text-transform:uppercase;">Website URL</label>
                            <input type="url" name="aic[cos][url][]" value="<?php echo esc_attr($co['co_url'] ?? ''); ?>" class="regular-text" style="width:100%">
                        </div>
                        <div>
                            <label style="font-weight:600;font-size:11px;text-transform:uppercase;">Logo</label>
                            <div class="aic-media-wrap">
                                <input type="hidden" name="aic[cos][logo][]" value="<?php echo esc_attr($co['co_logo'] ?? 0); ?>">
                                <div class="aic-media-preview"><?php echo !empty($co['co_logo']) ? wp_get_attachment_image($co['co_logo'], 'thumbnail') : ''; ?></div>
                                <button type="button" class="button aic-media-upload">Choose</button>
                                <button type="button" class="button aic-media-remove" style="<?php echo empty($co['co_logo']) ? 'display:none' : ''; ?>">Remove</button>
                            </div>
                        </div>
                    </div>
                    <p style="margin:8px 0 0;text-align:right;"><button type="button" class="button aic-row-remove" style="color:#b32d2e;">Remove</button></p>
                </div>
                <?php endforeach; ?>
            </div>
            <p><button type="button" class="button" id="aic-cos-add">Add Co-Organizer</button></p>
        </td>
    </tr>
    <?php
}

function aic_field_repeater_schedule($label, $option_name, $input_prefix) {
    $sched = get_option($option_name, []);
    if (!is_array($sched)) $sched = [];
    $types = ['registration' => 'Registration', 'welcome' => 'Welcome', 'keynote' => 'Keynote Session', 'parallel' => 'Parallel Session', 'panel' => 'Panel Discussion', 'closing' => 'Closing'];
    ?>
    <tr>
        <th scope="row"><?php echo esc_html($label); ?></th>
        <td>
            <table class="wp-list-table widefat striped aic-sched-table">
                <thead><tr><th>Time</th><th>Activity</th><th>Room</th><th>Type</th><th></th></tr></thead>
                <tbody>
                    <?php foreach ($sched as $i => $s): ?>
                    <tr>
                        <td><input type="text" name="<?php echo esc_attr($input_prefix); ?>[time][]" value="<?php echo esc_attr($s['sched_time'] ?? ''); ?>" placeholder="08:00 - 08:30" style="width:120px"></td>
                        <td><input type="text" name="<?php echo esc_attr($input_prefix); ?>[activity][]" value="<?php echo esc_attr($s['sched_activity'] ?? ''); ?>" style="width:100%"></td>
                        <td><input type="text" name="<?php echo esc_attr($input_prefix); ?>[room][]" value="<?php echo esc_attr($s['sched_room'] ?? ''); ?>" style="width:100px"></td>
                        <td>
                            <select name="<?php echo esc_attr($input_prefix); ?>[type][]">
                                <?php foreach ($types as $k => $l): ?>
                                <option value="<?php echo esc_attr($k); ?>" <?php selected($s['sched_type'] ?? '', $k); ?>><?php echo esc_html($l); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><button type="button" class="button aic-row-remove">&times;</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><button type="button" class="button aic-sched-add" data-prefix="<?php echo esc_attr($input_prefix); ?>">Add Row</button></p>
        </td>
    </tr>
    <?php
}

// --- JS for repeaters + media ---
add_action('admin_footer', function () {
    $screen = get_current_screen();
    if (!$screen || $screen->id !== 'aic_page_aic-settings') return;
    ?>
    <style>
    .aic-gallery-grid { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:8px; }
    .aic-gallery-item { position:relative; width:80px; height:80px; border:1px solid #ddd; border-radius:4px; overflow:hidden; cursor:grab; }
    .aic-gallery-item img { width:100%; height:100%; object-fit:cover; }
    .aic-gallery-remove { position:absolute; top:-4px; right:-4px; width:20px; height:20px; border-radius:50%; background:#b32d2e; color:#fff; font-size:14px; line-height:20px; text-align:center; cursor:pointer; display:none; }
    .aic-gallery-item:hover .aic-gallery-remove { display:block; }
    .aic-media-preview img { max-width:150px; max-height:80px; height:auto; border:1px solid #ddd; border-radius:4px; padding:2px; }
    .aic-co-row { position:relative; }
    </style>
    <script>
    (function($){
        // Media uploader
        $(document).on('click', '.aic-media-upload', function(e){
            e.preventDefault();
            var btn = $(this);
            var wrap = btn.closest('.aic-media-wrap');
            var frame = wp.media({ title: 'Choose Image', library: { type: 'image' }, multiple: false });
            frame.on('select', function(){
                var att = frame.state().get('selection').first().toJSON();
                wrap.find('input[type="hidden"]').val(att.id);
                wrap.find('.aic-media-preview').html('<img src="' + att.sizes.thumbnail.url + '">');
                wrap.find('.aic-media-remove').show();
                btn.text('Change');
            });
            frame.open();
        });
        $(document).on('click', '.aic-media-remove', function(e){
            e.preventDefault();
            var wrap = $(this).closest('.aic-media-wrap');
            wrap.find('input[type="hidden"]').val('');
            wrap.find('.aic-media-preview').empty();
            wrap.find('.aic-media-remove').hide();
            wrap.find('.aic-media-upload').text('Choose Image');
        });

        // Gallery
        var galleryFrame;
        $('#aic-gallery-add').on('click', function(e){
            e.preventDefault();
            var ids = $('#aic-gallery-ids').val();
            galleryFrame = wp.media({ title: 'Select Gallery Images', library: { type: 'image' }, multiple: true, selected: [] });
            galleryFrame.on('select', function(){
                var sel = galleryFrame.state().get('selection');
                var existing = $('#aic-gallery-ids').val() ? $('#aic-gallery-ids').val().split(',') : [];
                sel.each(function(att){
                    if (existing.indexOf(String(att.id)) === -1) existing.push(att.id);
                });
                $('#aic-gallery-ids').val(existing.join(','));
                renderGallery();
            });
            galleryFrame.open();
        });
        $(document).on('click', '.aic-gallery-remove', function(){
            var id = $(this).parent().data('id');
            var ids = $('#aic-gallery-ids').val().split(',').filter(function(v){ return v != id; });
            $('#aic-gallery-ids').val(ids.join(','));
            renderGallery();
        });
        function renderGallery(){
            var ids = $('#aic-gallery-ids').val();
            if (!ids) { $('#aic-gallery-previews').empty(); return; }
            $.post(ajaxurl, { action: 'aic_render_gallery', ids: ids }, function(r){ $('#aic-gallery-previews').html(r); });
        }

        // Dates repeater
        $('#aic-dates-add').on('click', function(){
            var tpl = '<tr><td><input type="text" name="aic[dates][label][]" class="regular-text"></td><td><input type="text" name="aic[dates][value][]" class="regular-text"></td><td><input type="text" name="aic[dates][desc][]" style="width:100%"></td><td><button type="button" class="button aic-row-remove">&times;</button></td></tr>';
            $('#aic-dates-table tbody').append(tpl);
        });

        // Co-organizers repeater
        $('#aic-cos-add').on('click', function(){
            var tpl = '<div class="aic-co-row" style="background:#f6f7f7;padding:12px;margin-bottom:8px;border:1px solid #c3c4c7;border-radius:4px;">' +
                '<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">' +
                '<div><label style="font-weight:600;font-size:11px;text-transform:uppercase;">Name</label><input type="text" name="aic[cos][name][]" class="regular-text" style="width:100%"></div>' +
                '<div><label style="font-weight:600;font-size:11px;text-transform:uppercase;">Description</label><input type="text" name="aic[cos][desc][]" class="regular-text" style="width:100%"></div>' +
                '<div><label style="font-weight:600;font-size:11px;text-transform:uppercase;">Website URL</label><input type="url" name="aic[cos][url][]" class="regular-text" style="width:100%"></div>' +
                '<div><label style="font-weight:600;font-size:11px;text-transform:uppercase;">Logo</label><div class="aic-media-wrap"><input type="hidden" name="aic[cos][logo][]" value="0"><div class="aic-media-preview"></div><button type="button" class="button aic-media-upload">Choose</button><button type="button" class="button aic-media-remove" style="display:none">Remove</button></div></div>' +
                '</div><p style="margin:8px 0 0;text-align:right;"><button type="button" class="button aic-row-remove" style="color:#b32d2e;">Remove</button></p></div>';
            $('#aic-cos-wrap').append(tpl);
        });

        // Schedule repeater
        $(document).on('click', '.aic-sched-add', function(){
            var p = $(this).data('prefix');
            var tpl = '<tr><td><input type="text" name="' + p + '[time][]" placeholder="08:00 - 08:30" style="width:120px"></td>' +
                '<td><input type="text" name="' + p + '[activity][]" style="width:100%"></td>' +
                '<td><input type="text" name="' + p + '[room][]" style="width:100px"></td>' +
                '<td><select name="' + p + '[type][]">' +
                '<option value="registration">Registration</option><option value="welcome">Welcome</option><option value="keynote">Keynote Session</option><option value="parallel" selected>Parallel Session</option><option value="panel">Panel Discussion</option><option value="closing">Closing</option>' +
                '</select></td><td><button type="button" class="button aic-row-remove">&times;</button></td></tr>';
            $(this).closest('td').find('.aic-sched-table tbody').append(tpl);
        });

        // Remove row
        $(document).on('click', '.aic-row-remove', function(){
            var row = $(this).closest('tr, .aic-co-row');
            if (row.siblings().length > 0) row.remove();
        });

        // File upload
        $(document).on('click', '.aic-file-upload', function(e){
            e.preventDefault();
            var btn = $(this);
            var wrap = btn.closest('.aic-file-wrap');
            var frame = wp.media({ title: 'Choose File', library: { type: 'application' }, multiple: false });
            frame.on('select', function(){
                var att = frame.state().get('selection').first().toJSON();
                wrap.find('input[type="hidden"]').val(att.id);
                wrap.find('.aic-file-preview').html(att.filename || 'File selected');
                wrap.find('.aic-file-remove').show();
            });
            frame.open();
        });
        $(document).on('click', '.aic-file-remove', function(e){
            e.preventDefault();
            var wrap = $(this).closest('.aic-file-wrap');
            wrap.find('input[type="hidden"]').val('');
            wrap.find('.aic-file-preview').empty();
            wrap.find('.aic-file-remove').hide();
        });
    })(jQuery);
    </script>
    <?php
});

// AJAX handler for gallery rendering
add_action('wp_ajax_aic_render_gallery', function () {
    $ids = array_map('absint', explode(',', $_POST['ids'] ?? ''));
    foreach ($ids as $id) {
        $src = wp_get_attachment_image_src($id, 'thumbnail');
        if ($src) {
            echo '<div class="aic-gallery-item" data-id="' . esc_attr($id) . '"><img src="' . esc_url($src[0]) . '"><span class="aic-gallery-remove">&times;</span></div>';
        }
    }
    wp_die();
});
