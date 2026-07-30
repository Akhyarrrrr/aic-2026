<?php
/**
 * Seed data generator for AIC speakers + committees + options.
 *
 * HOW TO USE:
 * 1. Add this line to functions.php temporarily:
 *    require_once __DIR__ . '/inc/seed-data.php';
 *    aic_run_seed();
 * 2. Visit any front-end page once.
 * 3. Remove the line from functions.php.
 * 4. Check the results.
 */

if (!defined('ABSPATH')) exit;

function aic_run_seed() {
    if (get_option('aic_seed_has_run')) {
        error_log('AIC seed: already run. Delete aic_seed_has_run option to re-run.');
        return;
    }

    $speaker_count = 0;
    $committee_count = 0;

    // ========================================
    // OPTIONS (settings page values)
    // ========================================

    // Chairperson
    update_option('aic_chair_name', 'Prof. Dr. Ir. Melinda, ST., M.Sc, IPU, ASEAN. Eng, APEC. Eng');
    update_option('aic_chair_title', 'AIC 2026 Chairperson | Universitas Syiah Kuala');
    update_option('aic_countdown_end_date', '2026-11-06');

    // Important Dates
    update_option('aic_important_dates', [
        ['date_label' => 'Abstract Submission Deadline',       'date_value' => 'September 19, 2026',            'date_desc' => ''],
        ['date_label' => 'Abstract Acceptance Notification',   'date_value' => '2-3 Days After Submission',    'date_desc' => 'Rolling review process'],
        ['date_label' => 'Full Paper Submission',              'date_value' => 'October 31, 2026',             'date_desc' => ''],
        ['date_label' => 'Conference Days',                    'date_value' => 'November 4-5, 2026',           'date_desc' => 'On-site & Online'],
    ]);

    // Registration Fees
    update_option('aic_fee_presenter_domestic', 'IDR 500,000');
    update_option('aic_fee_presenter_intl', 'USD 50');
    update_option('aic_fee_nonpresenter_domestic', 'IDR 350,000');
    update_option('aic_fee_nonpresenter_intl', 'USD 35');
    update_option('aic_fee_notes', "Fee does not include publication cost.\n\nAdditional IDR 2,300,000 for Scopus-indexed proceeding publication after peer review.\n\nPapers selected for journals pay APC per journal.\n\nFee is same for online and on-site participation.");

    // ========================================
    // SPEAKERS (placeholder — doc says TBA)
    // ========================================

    $speakers = [
        // Keynotes
        [
            'title'       => 'Professor of Artificial Intelligence & Robotics',
            'name'        => 'Prof. Dr. Hiroshi Tanaka',
            'affiliation' => 'Tokyo Institute of Technology, Japan',
            'track'       => 'se',
            'is_keynote'  => true,
            'order'       => 1,
            'bio'         => '<p>Prof. Tanaka is a leading researcher in artificial intelligence and robotics. His work on autonomous systems has been published in over 200 peer-reviewed journals. He serves on the editorial board of IEEE Transactions on Robotics.</p>',
        ],
        [
            'title'       => 'Professor of Marine Biology',
            'name'        => 'Dr. Sarah Mitchell',
            'affiliation' => 'University of Queensland, Australia',
            'track'       => 'els',
            'is_keynote'  => true,
            'order'       => 2,
            'bio'         => '<p>Dr. Mitchell is an esteemed marine biologist specializing in coral reef ecosystems and climate change adaptation, with over 25 years of field research across the Indo-Pacific.</p>',
        ],
        [
            'title'       => 'Professor of Development Economics',
            'name'        => 'Prof. Dr. Amartya Senjaya',
            'affiliation' => 'University of Oxford, United Kingdom',
            'track'       => 'ss',
            'is_keynote'  => true,
            'order'       => 3,
            'bio'         => '<p>Prof. Senjaya is a distinguished development economist whose research focuses on poverty alleviation and sustainable development in Southeast Asia.</p>',
        ],
        // Invited — SE
        [
            'title'       => 'Associate Professor of Civil Engineering',
            'name'        => 'Dr. Rina Wijaya',
            'affiliation' => 'Institut Teknologi Bandung, Indonesia',
            'track'       => 'se',
            'is_keynote'  => false,
            'order'       => 10,
            'bio'         => '<p>Dr. Wijaya specializes in earthquake-resistant infrastructure and post-disaster reconstruction.</p>',
        ],
        [
            'title'       => 'Senior Lecturer in Computer Science',
            'name'        => 'Dr. Michael Chen',
            'affiliation' => 'National University of Singapore',
            'track'       => 'se',
            'is_keynote'  => false,
            'order'       => 11,
            'bio'         => '<p>Dr. Chen works on quantum computing algorithms and optimization problems.</p>',
        ],
        // Invited — ELS
        [
            'title'       => 'Research Scientist in Biotechnology',
            'name'        => 'Dr. Fatima Al-Rashid',
            'affiliation' => 'King Abdullah University of Science and Technology, Saudi Arabia',
            'track'       => 'els',
            'is_keynote'  => false,
            'order'       => 12,
            'bio'         => '<p>Dr. Al-Rashid leads research on algae-based biofuels and sustainable bioproducts.</p>',
        ],
        [
            'title'       => 'Professor of Environmental Science',
            'name'        => 'Dr. Bambang Susanto',
            'affiliation' => 'Universitas Gadjah Mada, Indonesia',
            'track'       => 'els',
            'is_keynote'  => false,
            'order'       => 13,
            'bio'         => '<p>Dr. Susanto researches tropical forest conservation and REDD+ implementation in Southeast Asia.</p>',
        ],
        // Invited — SS
        [
            'title'       => 'Associate Professor of Linguistics',
            'name'        => 'Dr. Maria Santos',
            'affiliation' => 'University of the Philippines',
            'track'       => 'ss',
            'is_keynote'  => false,
            'order'       => 14,
            'bio'         => '<p>Dr. Santos studies language preservation and revitalization of indigenous languages in the Asia-Pacific region.</p>',
        ],
        [
            'title'       => 'Senior Lecturer in Public Policy',
            'name'        => 'Dr. Ahmad Fauzi',
            'affiliation' => 'Universitas Syiah Kuala, Indonesia',
            'track'       => 'ss',
            'is_keynote'  => false,
            'order'       => 15,
            'bio'         => '<p>Dr. Fauzi researches post-conflict reconciliation and peacebuilding in Aceh.</p>',
        ],
    ];

    foreach ($speakers as $s) {
        $existing = get_posts([
            'post_type'   => 'speaker',
            'title'       => $s['name'],
            'post_status' => 'any',
        ]);
        if (!empty($existing)) continue;

        $id = wp_insert_post([
            'post_title'   => $s['name'],
            'post_content' => $s['bio'],
            'post_type'    => 'speaker',
            'post_status'  => 'publish',
            'menu_order'   => $s['order'],
        ]);
        if (is_wp_error($id) || !$id) continue;
        $speaker_count++;

        update_field('speaker_title',       $s['title'], $id);
        update_field('speaker_affiliation',  $s['affiliation'], $id);
        update_field('speaker_track',        $s['track'], $id);
        update_field('speaker_is_keynote',   $s['is_keynote'], $id);
        update_field('speaker_order',        $s['order'], $id);
    }

    // ========================================
    // COMMITTEES (real data from Google Doc)
    // ========================================

    $committees = [
        // ======= SE TRACK =======
        // Chairperson
        ['name' => 'Prof. Dr. Ir. Melinda, ST., M.Sc, IPU, ASEAN. Eng, APEC. Eng',  'role' => 'Chairperson',       'affiliation' => 'Universitas Syiah Kuala',                     'track' => 'se'],
        ['name' => 'Dr. Syawaliah, S.T.',                                            'role' => 'Co-Chair',           'affiliation' => 'Universitas Syiah Kuala',                     'track' => 'se'],
        ['name' => 'Dr. Yunida, S.T.',                                               'role' => 'Secretary & Finance','affiliation' => 'Universitas Syiah Kuala',                     'track' => 'se'],
        // Scientific Committee — SE
        ['name' => 'Prof. Dr. Ir. Nasrul Arahman, S.T., M.T.',                       'role' => 'Scientific Committee','affiliation' => 'Universitas Syiah Kuala, Indonesia',           'track' => 'se'],
        ['name' => 'Prof. Dr. Ir. Muhammad Faisal, S.T., M.Eng',                     'role' => 'Scientific Committee','affiliation' => 'Universitas Syiah Kuala, Indonesia',           'track' => 'se'],
        ['name' => 'Assoc. Prof. Dr. Muhammad Roil Bilad',                           'role' => 'Scientific Committee','affiliation' => 'Universiti Brunei Darussalam, Brunei',         'track' => 'se'],
        ['name' => 'Prof. Dr. Mathias Ulbricht',                                     'role' => 'Scientific Committee','affiliation' => 'University of Duisburg-Essen, Germany',        'track' => 'se'],
        ['name' => 'Prof. Ryosuke Takagi',                                           'role' => 'Scientific Committee','affiliation' => 'Kobe University, Japan',                      'track' => 'se'],
        ['name' => 'Prof. Zuchra Helwani, ST., MT., PhD',                            'role' => 'Scientific Committee','affiliation' => 'Universitas Riau, Indonesia',                 'track' => 'se'],
        ['name' => 'Dr. Cristian Toșa',                                              'role' => 'Scientific Committee','affiliation' => 'University of Stavanger, Norway',             'track' => 'se'],
        ['name' => 'Dr. Chu Tien Dung',                                              'role' => 'Scientific Committee','affiliation' => 'University of Transport and Communications, Vietnam', 'track' => 'se'],
        ['name' => 'Dr. Ir. Benazir, S.T., M.Eng',                                   'role' => 'Scientific Committee','affiliation' => 'Universitas Gadjah Mada, Indonesia',          'track' => 'se'],
        ['name' => 'Dr. Joewono Prasetijo',                                          'role' => 'Scientific Committee','affiliation' => 'Universiti Tun Hussein Onn Malaysia',        'track' => 'se'],
        ['name' => 'Dr. Bambang Setiawan, S.T, M.Eng.Sc',                            'role' => 'Scientific Committee','affiliation' => 'Universitas Syiah Kuala, Indonesia',          'track' => 'se'],
        ['name' => 'Dr. Ir. Ikramullah, S.T',                                        'role' => 'Scientific Committee','affiliation' => 'Universitas Syiah Kuala, Indonesia',          'track' => 'se'],
        ['name' => 'Prof. Dr. Ir. Fitri Arnia, S.T., M.Eng.Sc, IPU',                 'role' => 'Scientific Committee','affiliation' => 'Universitas Syiah Kuala, Indonesia',          'track' => 'se'],
        ['name' => 'Mai Kai Suan Tial',                                              'role' => 'Scientific Committee','affiliation' => 'Yangon Technological University, Myanmar',   'track' => 'se'],
        ['name' => 'Dr. Herlina, S.T',                                               'role' => 'Scientific Committee','affiliation' => 'Sriwijaya University, Indonesia',            'track' => 'se'],
        ['name' => 'Assoc. Prof. Dr. Nurlida Binti Basir',                           'role' => 'Scientific Committee','affiliation' => 'Universiti Sains Islam Malaysia',            'track' => 'se'],
        // Steering Committee
        ['name' => 'Prof. Mirza Tabrani, S.E., M.B.A., D.B.A.',                      'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'se'],
        ['name' => 'Prof. Dr. Heru Fahlevi, S.E., M.Sc., Ak., CA',                   'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'se'],
        ['name' => 'Prof. Dr. Taufiq C. Dawood, S.E., M.Ec.Dev',                     'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'se'],
        ['name' => 'Prof. Dr. Yunisrina Qismullah Yusuf, S.Pd, M.Ling.',             'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'se'],
        ['name' => 'Prof. Dr.drh. Basri, M.Si',                                      'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'se'],
        // Editorial Board — SE
        ['name' => 'Dr. Aulia Chintia Ambarita, S.T., M.T',                          'role' => 'Editorial Board',    'affiliation' => 'Editor In Chief',                             'track' => 'se'],
        ['name' => 'Vera Halfani, S.Si., S.Mat',                                     'role' => 'Editorial Board',    'affiliation' => 'Managing Editor',                             'track' => 'se'],
        ['name' => 'Dr. Prima Denny Sentia, ST., M.IT., IPM',                        'role' => 'Editorial Board',    'affiliation' => 'Associate Editor',                            'track' => 'se'],
        ['name' => 'Zaitun Humaira, S.T., M.Sc.',                                    'role' => 'Editorial Board',    'affiliation' => 'Associate Editor',                            'track' => 'se'],
        ['name' => 'Siti Zahrina Fakhrana, S. Ars., M.Sc.',                          'role' => 'Editorial Board',    'affiliation' => 'Article Publication',                         'track' => 'se'],
        ['name' => 'Al Bahri, S.ST., M.T.',                                          'role' => 'Editorial Board',    'affiliation' => 'Article Publication',                         'track' => 'se'],
        ['name' => 'Taufiq, S.Si., M.Si',                                            'role' => 'Editorial Board',    'affiliation' => 'OCS Personnel',                               'track' => 'se'],

        // ======= ELS TRACK =======
        ['name' => 'Prof. Dr. Ir. Melinda, ST., M.Sc, IPU, ASEAN. Eng, APEC. Eng',  'role' => 'Chairperson',       'affiliation' => 'Universitas Syiah Kuala',                     'track' => 'els'],
        ['name' => 'Dr. Syawaliah, S.T.',                                            'role' => 'Co-Chair',           'affiliation' => 'Universitas Syiah Kuala',                     'track' => 'els'],
        ['name' => 'Dr. Yunida, S.T.',                                               'role' => 'Secretary & Finance','affiliation' => 'Universitas Syiah Kuala',                     'track' => 'els'],
        // International Scientific Committee — ELS
        ['name' => 'Prof. Siti Azizah Mohd Nor',                                     'role' => 'Scientific Committee','affiliation' => 'Universiti Malaysia Terengganu, Malaysia',    'track' => 'els'],
        ['name' => 'Dr. Larry M. Page',                                              'role' => 'Scientific Committee','affiliation' => 'Florida Museum of Natural History, USA',      'track' => 'els'],
        ['name' => 'Dr. Martin Wilkes',                                              'role' => 'Scientific Committee','affiliation' => 'University of Essex, United Kingdom',        'track' => 'els'],
        ['name' => 'Dr. Zeehan Jaafar',                                              'role' => 'Scientific Committee','affiliation' => 'National University of Singapore',           'track' => 'els'],
        ['name' => 'Dr. Sharil Anuar Bahari',                                        'role' => 'Scientific Committee','affiliation' => 'University Technology Mara, Malaysia',        'track' => 'els'],
        // Steering Committee — ELS
        ['name' => 'Prof. Mirza Tabrani, S.E., M.B.A., D.B.A.',                      'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'els'],
        ['name' => 'Prof. Dr. Heru Fahlevi, S.E., M.Sc., Ak., CA',                   'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'els'],
        ['name' => 'Prof. Dr. Taufiq C. Dawood, S.E., M.Ec.Dev',                     'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'els'],
        ['name' => 'Prof. Dr. Yunisrina Qismullah Yusuf, S.Pd, M.Ling.',             'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'els'],
        ['name' => 'Prof. Dr.drh. Basri, M.Si',                                      'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'els'],
        // Editorial Board — ELS
        ['name' => 'Yulia Annisa, M.Si., M.AppIn&E',                                 'role' => 'Editorial Board',    'affiliation' => 'Editor In Chief',                             'track' => 'els'],
        ['name' => 'Prof. Dr. Murna Muzaifa, S.TP., MP',                             'role' => 'Editorial Board',    'affiliation' => 'Managing Editor',                             'track' => 'els'],
        ['name' => 'Cut Nilda, S.TP., M.Sc.',                                        'role' => 'Editorial Board',    'affiliation' => 'Managing Editor',                             'track' => 'els'],
        ['name' => 'Virda Zikria, S.P., M.Sc.',                                      'role' => 'Editorial Board',    'affiliation' => 'Associate Editor',                            'track' => 'els'],
        ['name' => 'Nasrullah, S.P., M.Si',                                          'role' => 'Editorial Board',    'affiliation' => 'Associate Editor',                            'track' => 'els'],
        ['name' => 'Dr. Ing. Agus Arip Munawar, S.TP., M.Sc.',                       'role' => 'Editorial Board',    'affiliation' => 'Article Publication',                         'track' => 'els'],
        ['name' => 'Junianto S. Batubara, S.Agr., M.Si',                             'role' => 'Editorial Board',    'affiliation' => 'Article Publication',                         'track' => 'els'],
        ['name' => 'apt. Yunda Fachrunniza, S.Farm., M.Sc',                          'role' => 'Editorial Board',    'affiliation' => 'Article Publication',                         'track' => 'els'],

        // ======= SS TRACK =======
        ['name' => 'Prof. Dr. Ir. Melinda, ST., M.Sc, IPU, ASEAN. Eng, APEC. Eng',  'role' => 'Chairperson',       'affiliation' => 'Universitas Syiah Kuala',                     'track' => 'ss'],
        ['name' => 'Dr. Syawaliah, S.T.',                                            'role' => 'Co-Chair',           'affiliation' => 'Universitas Syiah Kuala',                     'track' => 'ss'],
        ['name' => 'Dr. Yunida, S.T.',                                               'role' => 'Secretary & Finance','affiliation' => 'Universitas Syiah Kuala',                     'track' => 'ss'],
        // Steering Committee — SS
        ['name' => 'Prof. Mirza Tabrani, S.E., M.B.A., D.B.A.',                      'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'ss'],
        ['name' => 'Prof. Dr. Heru Fahlevi, S.E., M.Sc., Ak., CA',                   'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'ss'],
        ['name' => 'Prof. Dr. Taufiq C. Dawood, S.E., M.Ec.Dev',                     'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'ss'],
        ['name' => 'Prof. Dr. Yunisrina Qismullah Yusuf, S.Pd, M.Ling.',             'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'ss'],
        ['name' => 'Prof. Dr.drh. Basri, M.Si',                                      'role' => 'Steering Committee',  'affiliation' => '',                                            'track' => 'ss'],
        // Editorial Board — SS
        ['name' => 'Dr. Febri Nurrahmi, S.Sos., M.MP.',                              'role' => 'Editorial Board',    'affiliation' => 'Editor In Chief',                             'track' => 'ss'],
        ['name' => 'Amelia Zahara, S.Pd., M',                                        'role' => 'Editorial Board',    'affiliation' => 'Managing Editor',                             'track' => 'ss'],
        ['name' => 'Anita Faiziah, S.P., M.Env.Res.Ec',                              'role' => 'Editorial Board',    'affiliation' => 'Associate Editor',                            'track' => 'ss'],
        ['name' => 'Yuliana Angreini Syafruddin, S.Pd., M.AppLing',                 'role' => 'Editorial Board',    'affiliation' => 'Article Publication',                         'track' => 'ss'],
    ];

    foreach ($committees as $c) {
        $existing = get_posts([
            'post_type'   => 'committee',
            'title'       => $c['name'],
            'post_status' => 'any',
            'meta_query'  => [
                ['key' => 'committee_track', 'value' => $c['track']],
            ],
        ]);
        if (!empty($existing)) continue;

        $id = wp_insert_post([
            'post_title'  => $c['name'],
            'post_type'   => 'committee',
            'post_status' => 'publish',
        ]);
        if (is_wp_error($id) || !$id) continue;
        $committee_count++;

        update_field('committee_role',       $c['role'], $id);
        update_field('committee_affiliation', $c['affiliation'], $id);
        update_field('committee_track',       $c['track'], $id);
    }

    update_option('aic_seed_has_run', true);
    error_log("AIC seed complete: {$speaker_count} speakers, {$committee_count} committees.");
}
