<?php
/**
 * Schedule seed — populates aic_schedule_day1 / aic_schedule_day2
 * from the official rundown (Draft Rundown AIC2026.docx).
 *
 * HOW TO USE:
 * 1. Add these lines to functions.php temporarily:
 *    require_once __DIR__ . '/inc/seed-schedule.php';
 *    aic_seed_schedule();
 * 2. Visit any front-end page once.
 * 3. Remove the two lines from functions.php.
 */

if (!defined('ABSPATH')) exit;

function aic_seed_schedule() {
    if (get_option('aic_schedule_seed_done')) {
        error_log('AIC schedule seed: already run. Delete aic_schedule_seed_done option to re-run.');
        return;
    }

    // sched_track: 'all' = common to every track, otherwise 'se' / 'els' / 'ss'
    $day1 = [
        // ---- Morning: common program ----
        ['sched_time' => '08.00 – 08.30', 'sched_activity' => 'Registration', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'break', 'sched_track' => 'all'],
        ['sched_time' => '08.30 – 08.35', 'sched_activity' => 'Opening Ceremony', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '08.35 – 08.45', 'sched_activity' => 'Screening of the safety induction video for the AAC Dayan Dawood Hall', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '08.45 – 08.55', 'sched_activity' => 'Reciting of Holy Quran', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '08.55 – 09.00', 'sched_activity' => "Du'a", 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '09.00 – 09.05', 'sched_activity' => 'Singing the National Anthem of Indonesia (Indonesia Raya)', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '09.05 – 09.10', 'sched_activity' => 'Singing the Aceh Hymns', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '09.10 – 09.15', 'sched_activity' => 'Report by the Chairman of the 16th AIC — Prof. Dr. Ir. Melinda, S.T., M.Sc., IPU., ASEAN. Eng., APEC Eng', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '09.15 – 09.20', 'sched_activity' => 'Welcoming Remark and Opening of the 16th AIC by the Rector of Universitas Syiah Kuala — Prof. Mirza Tabrani, S.E., M.B.A., D.B.A.', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '09.20 – 09.25', 'sched_activity' => 'Awarding tokens of appreciation to all Keynote and Invited Speakers attending on-site', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '09.25 – 09.30', 'sched_activity' => 'Group photo session (both online and on-site)', 'sched_room' => 'AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '09.30 – 09.45', 'sched_activity' => 'Break', 'sched_room' => '', 'sched_type' => 'break', 'sched_track' => 'all'],

        // ---- Keynote session ----
        ['sched_time' => '09.45 – 12.30', 'sched_activity' => 'Keynote Speakers Session', 'sched_room' => 'AAC Dayan Dawood Main Hall', 'sched_type' => 'keynote', 'sched_track' => 'all'],
        ['sched_time' => '09.45 – 10.15', 'sched_activity' => 'Prof. Heather Linville — Educational Studies, University of Wisconsin, La Crosse, USA (Keynote Session Moderator)', 'sched_room' => 'AAC Dayan Dawood Main Hall', 'sched_type' => 'keynote', 'sched_track' => 'all'],
        ['sched_time' => '10.15 – 10.45', 'sched_activity' => 'Prof. Franck Lavigne — Physical Geography, Natural Hazards, Volcanology, Université Paris 1 Panthéon-Sorbonne, Paris, France', 'sched_room' => 'AAC Dayan Dawood Main Hall', 'sched_type' => 'keynote', 'sched_track' => 'all'],
        ['sched_time' => '10.45 – 11.15', 'sched_activity' => 'Ts. Tan Pei Chin — Director of Fly Technology Agriculture Sdn. Bhd., Malaysia', 'sched_room' => 'AAC Dayan Dawood Main Hall', 'sched_type' => 'keynote', 'sched_track' => 'all'],
        ['sched_time' => '11.15 – 11.45', 'sched_activity' => 'Prof. Kornkanok Ingkaninan — Center of Excellence in Cannabis Research (NU-CAN) and Bioscreening Unit, Naresuan University, Thailand', 'sched_room' => 'AAC Dayan Dawood Main Hall', 'sched_type' => 'keynote', 'sched_track' => 'all'],
        ['sched_time' => '11.45 – 12.30', 'sched_activity' => 'Discussion', 'sched_room' => 'AAC Dayan Dawood Main Hall', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '12.30 – 14.00', 'sched_activity' => 'Dhuhr Prayer Break', 'sched_room' => '', 'sched_type' => 'break', 'sched_track' => 'all'],

        // ---- Invited speaker sessions (parallel, per track) ----
        ['sched_time' => '14.00 – 14.30', 'sched_activity' => 'Invited Speaker Session — Moderator: Ir. T. Mukhriza, S.T., M.Sc', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'se'],
        ['sched_time' => '14.00 – 14.20', 'sched_activity' => 'W.K. Wong — Electrical and Computer Engineering, Curtin University Malaysia, Malaysia', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'se'],
        ['sched_time' => '14.20 – 14.30', 'sched_activity' => 'Discussion for SE Track', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'se'],

        ['sched_time' => '14.00 – 14.30', 'sched_activity' => 'Invited Speaker Session — Moderator: Dr. Cut Erika, S.TP., M.Sc.', 'sched_room' => 'VIP Room, AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'els'],
        ['sched_time' => '14.00 – 14.20', 'sched_activity' => 'Prof. Dr. Ir. Rina Sriwati, M.Si. — Plant Pathology, Faculty of Agriculture', 'sched_room' => 'VIP Room, AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'els'],
        ['sched_time' => '14.20 – 14.30', 'sched_activity' => 'Discussion for ELS Track', 'sched_room' => 'VIP Room, AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'els'],

        ['sched_time' => '14.00 – 14.30', 'sched_activity' => 'Invited Speaker Session — Moderator: Dr. Febri Nurrahmi, S.Sos., M.MP.', 'sched_room' => 'Multipurpose Room 2nd Floor ICT Building', 'sched_type' => 'plenary', 'sched_track' => 'ss'],
        ['sched_time' => '14.00 – 14.20', 'sched_activity' => 'Prof. Dr. M. Shabri, S.E., M.Ec. — Islamic Economics, Faculty of Economics and Business, Universitas Syiah Kuala', 'sched_room' => 'Multipurpose Room 2nd Floor ICT Building', 'sched_type' => 'plenary', 'sched_track' => 'ss'],
        ['sched_time' => '14.20 – 14.40', 'sched_activity' => 'Prof. Dr. Mailizar, S.Pd., M.Ed. — Mathematics Education Study Program, Faculty of Teacher Training and Education', 'sched_room' => 'Multipurpose Room 2nd Floor ICT Building', 'sched_type' => 'plenary', 'sched_track' => 'ss'],

        ['sched_time' => '14.30 – 14.40', 'sched_activity' => 'Break', 'sched_room' => '', 'sched_type' => 'break', 'sched_track' => 'all'],

        // ---- Parallel Session 1 (per track) ----
        ['sched_time' => '14.40 – 16.00', 'sched_activity' => 'Parallel Session 1 — SE Track (11 presenters/room)', 'sched_room' => 'AAC Dayan Dawood & Seminar Room 2nd Floor LPPM', 'sched_type' => 'oral', 'sched_track' => 'se'],
        ['sched_time' => '14.40 – 16.00', 'sched_activity' => 'Parallel Session 1 — ELS Track (11 presenters/room)', 'sched_room' => 'Multipurpose Room ICT Building', 'sched_type' => 'oral', 'sched_track' => 'els'],
        ['sched_time' => '14.40 – 16.00', 'sched_activity' => 'Parallel Session 1 — SS Track (11 presenters/room)', 'sched_room' => 'Multipurpose Room 2nd Floor ICT Building', 'sched_type' => 'oral', 'sched_track' => 'ss'],

        ['sched_time' => '16.00', 'sched_activity' => 'Closing for Day 1', 'sched_room' => '', 'sched_type' => 'closing', 'sched_track' => 'all'],
    ];

    // Gala Dinner — November 5, 2026 (Day 2)
    $day2 = [
        ['sched_time' => '19.30 – 20.00', 'sched_activity' => 'Registration', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'break', 'sched_track' => 'all'],
        ['sched_time' => '20.00 – 20.05', 'sched_activity' => 'Opening', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '20.05 – 20.20', 'sched_activity' => 'Dinner', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'break', 'sched_track' => 'all'],
        ['sched_time' => '20.30 – 20.50', 'sched_activity' => 'Traditional Dance Performance by Cek Mhs Sendratasik', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '20.50 – 21.00', 'sched_activity' => 'Closing remark by the Director of Institute for Research and Community Service (LPPM USK) — Prof. Dr. Taufiq C. Daod, S.E., M.Ec.Dev', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '21.00 – 21.10', 'sched_activity' => 'Remark/impression by one of the speakers attending on-site — Prof. Franck Lavigne', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '21.10 – 21.20', 'sched_activity' => 'Announcement of the Best Presenter', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '21.20 – 21.30', 'sched_activity' => 'Group Photo Session', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'plenary', 'sched_track' => 'all'],
        ['sched_time' => '21.30', 'sched_activity' => 'Closing remark', 'sched_room' => 'Main Hall AAC Dayan Dawood', 'sched_type' => 'closing', 'sched_track' => 'all'],
    ];

    update_option('aic_schedule_day1', $day1);
    update_option('aic_schedule_day2', $day2);
    update_option('aic_schedule_seed_done', 1);

    error_log('AIC schedule seed: day1=' . count($day1) . ' rows, day2=' . count($day2) . ' rows.');
}
