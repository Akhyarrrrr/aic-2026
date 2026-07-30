# AIC Website — Agent Guide

## What this is

WordPress site for the 16th Annual International Conference (AIC 2026) at Universitas Syiah Kuala (`aic.usk.ac.id`).
Theme: `aic-tailwind` (custom Tailwind CSS). Local: Laragon Windows (`aic.test`).

Theme: "Advancing Research and Innovation for a Resilient, Green, and Inclusive Future"
Conference date: November 4-5, 2026, Banda Aceh, Indonesia.

## Access

| System | URL | Notes |
|--------|-----|-------|
| Production | `https://aic.usk.ac.id` | |
| WP Admin | `https://aic.usk.ac.id/wp-admin` | Login via Plesk |
| Plesk | `https://maleo.usk.ac.id:8443/smb/web/view` | File Manager + DB access |
| Local | `http://aic.test` | Laragon, `C:\laragon\www\aic\` |

## Production vs Local

| Item | Production | Local |
|------|-----------|-------|
| DB Name | `aic_2025_db` | `aic_2025_db` |
| DB User | `aic_2025_user` | `root` |
| DB Password | `COcBaswovyj296!$` | (empty) |
| DB Host | `127.0.0.1` | `127.0.0.1` |
| Table prefix | `cms_` | `cms_` |
| WP_DEBUG | `false` | `true` |
| SSH | ❌ Forbidden | N/A |
| PHP | 8.3.32 | N/A |
| WP | 7.0.2 | N/A |

## Build commands

From `wp-content/themes/aic-tailwind/`:

```bash
npm run dev    # Tailwind watch → assets/css/main.css
npm run build  # Tailwind minified build
```

## Key files

| File | Purpose |
|------|---------|
| `functions.php` | Theme setup, asset loading, `aic_clean_colibri()`, track helpers, fallback footer |
| `inc/cpt-acf.php` | Speaker + Committee CPTs + ACF field groups (PHP-based, not UI) |
| `inc/nav-walker.php` | Custom `Walker_Nav_Menu` for Tailwind navigation |
| `inc/settings-page.php` | AIC Settings admin page (8 tabs, ~30 options via WordPress Options API) |
| `inc/seed-data.php` | Local dev seed script — **commented out in functions.php, DELETE from production** |
| `front-page.php` | Homepage: hero, countdown, about, tracks, speakers carousel, dates, gallery, CTA |
| `header.php` | Nav + track detection + transparent→solid scroll |
| `footer.php` | Footer with back-to-top, fallback links |
| `page-conference.php` | `/conference/` — child page cards (uses shared hero-inner) |
| `page-track.php` | Track home (SE/ELS/SS) — WP content + quick links + sidebar |
| `page-track-committees.php` | Track committee page — grouped by role |
| `page-track-speakers.php` | Track speakers page |
| `page-track-bop.php` | Track Book of Program |
| `template-parts/hero-inner.php` | Shared inner page hero (all pages except front-page) |
| `template-parts/track-sidebar.php` | Track sidebar: important dates, submit button, template download |
| `assets/css/main.css` | Compiled Tailwind CSS (~52KB) |
| `assets/js/main.js` | Loader, countdown, mobile menu, scroll reveal, carousel |

## Design system

- **Colors:** `primary` (#0D5F3A green), `accent` (#C7982C gold), `surface` (warm off-white), `ink` (#1A1D1C)
- **Track colors:** SE #F79007 (orange), ELS #137622 (green), SS #AA39AF (purple)
- **Font:** Poppins (Google Fonts), system-ui fallback
- **Container:** `.container-custom` → `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8`
- **Section:** `.section` → `py-20 md:py-28`, `.section-sm` → `py-12 md:py-16`
- **Buttons:** `.btn-primary`, `.btn-accent`, `.btn-outline`, `.btn-ghost`
- **Cards:** `.card`, `.card-interactive`
- **Typography:** `.text-display-lg`, `.text-display`, `.text-heading-lg`, `.text-heading`, `.text-body-lg`, `.text-body`, `.text-body-sm`, `.text-caption`
- **Animations:** `.reveal` (scroll-triggered), `.reveal-stagger` (children staggered)

## Custom Post Types (in `inc/cpt-acf.php`)

### Speaker
- CPT slug: `speaker`, rewrite: `speakers`
- ACF fields: `speaker_title` (text), `speaker_affiliation` (text), `speaker_track` (select: se/els/ss/all), `speaker_is_keynote` (true/false), `speaker_order` (number)
- Supports: title, editor, thumbnail, page-attributes

### Committee
- CPT slug: `committee`, rewrite: `committee`
- ACF fields: `committee_role` (text), `committee_affiliation` (text), `committee_track` (select: se/els/ss/all)
- Supports: title, page-attributes (no editor, no thumbnail)
- **Track field options:** `se` (SE), `els` (ELS), `ss` (SS), `all` (All Tracks / General)
- **`all` = appears on every track's committee page.** Use for Steering, Organizing, Editorial, Event committees.
- **Track-specific (se/els/ss) = only appears on that track.** Use for Scientific Committees.

## Committee Role Order (hierarchy, top to bottom)

The committee page groups members by role and displays in this order:

1. Steering Committee (highest — Rektor, Wakil Rektor)
2. Conference Chair
3. Conference Vice Chair
4. Secretary & Finance
5. Scientific Committee
6. International Scientific Committee
7. Organizing Committee
8. Event Committee
9. Editorial Board
10. International Editorial Board
11. Editor In Chief
12. Managing Editor
13. Associate Editor
14. Article Publication
15. OCS Personnel
16. Website Administration

Any role not in this list still appears, rendered after the ordered list.

---

# DEPLOYMENT STATUS — 2026-07-22

## ✅ DONE (completed this session)

### Infrastructure
- [x] WPvivid full backup created (221 MB, downloaded)
- [x] ACF plugin installed & activated (v6.8.6)
- [x] Theme `aic-tailwind` uploaded to `httpdocs/wp-content/themes/aic-tailwind/`
- [x] Theme activated
- [x] Colibri Page Builder — DEACTIVATED
- [x] Colibri Page Builder PRO — DEACTIVATED
- [x] Uploaded media files: conference-hero.jpg, LOGO-*.png, blank-profile-picture-*.webp to `uploads/2026/07/`

### Slugs renamed (9 pages)
- SE: speaker → speaker-se, committees → committees-se, book-of-program → book-of-program-se
- ELS: speaker → speaker-els, committees → committees-els, book-of-program → book-of-program-els
- SS: speaker → speaker-ss, committees → committees-ss, book-of-program → book-of-program-ss

### Page templates assigned (16 pages)
All pages assigned correct template: Track Page (SE/ELS/SS), Track Speakers, Track Committees, Track Book of Program, Tracks Landing, Call for Paper, Conference Hub, All Speakers, Previous AICs, Registration Fee, Paper Submission, Template Downloads, Paper Template, Submission

### Track content cleaned
- `/se/`, `/els/`, `/ss/` — stripped Colibri HTML, replaced with clean HTML. Only intro paragraphs + Call for Paper topics remain.
- `/conference/` — hero unified to use shared `hero-inner.php`

### AIC Settings filled
- **Hero & Stats:** 16th, Nov 4-5 2026, Banda Aceh, tagline, 20+, 150+, 3 tracks
- **Important Dates:** 4 entries (Abstract Submission Sep 19, Acceptance 2-3 days, Conference Nov 4-5, Full Paper Oct 31)
- **Registration:** Presenter IDR 500K/USD 50, Non-presenter IDR 350K/USD 35, fee notes

### Code fixes applied (local → uploaded to production)
1. **cpt-acf.php** — Added `all` option to `speaker_track` and `committee_track` ACF fields
2. **page-track-committees.php** — Meta query includes 'all' track; role_order extended to 16 roles with fallback; Steering Committee at top
3. **page-track-speakers.php** — Meta query includes 'all' track speakers
4. **page-conference.php** — Now uses shared `hero-inner.php` (removed custom hero)

### Committee data input (partial)
- 5 Steering Committee + Conference Chair + Conference Vice Chair + Secretary & Finance = 8 members

## 🔄 IN PROGRESS

### Committee input remaining (~40+ people)
- **Event Committee** (7): Dr. Yunidar, Aula Chairunnisak, Essy Harnelly, Yeni Marlina, Muharratul Mina Rizky, Yuliana Sy, Rizka Ramadhana
- **Editorial** (10): Aulia Chintia (Editor In Chief), Vera Halfani (Managing Editor), Prima Denny + Zaitun (Associate Editor), Siti Zahrina + Al Bahri (Article Publication), Taufiq (OCS), Akhyar + Rahmatul Idami (Website Admin)
- **SE Scientific Committee** (16): Nasrul Arahman, Muhammad Faisal, Muhammad Roil Bilad, Mathias Ulbricht, Ryosuke Takagi, Zuchra Helwani, Cristian Toșa, Chu Tien Dung, Benazir, Joewono Prasetijo, Bambang Setiawan, Ikramullah, Fitri Arnia, Mai Kai Suan Tial, Herlina, Nurlida Binti Basir
- **ELS International Scientific Committee** (4): Siti Azizah Mohd Nor, Larry M. Page, Martin Wilkes, Zeehan Jaafar
- **ELS International Editorial Board** (1): Sharil Anuar Bahari
- **ELS Editorial** (7): Yulia Annisa, Murna Muzaifa, Cut Nilda, Virda Zikria, Nasrullah, Agus Arip Munawar, Junianto S. Batubara, Yunda Fachrunniza
- **SS Editorial** (4): Febri Nurrahmi, Amelia Zahara, Anita Faiziah, Yuliana Angreini Syafruddin

**Committee input rules:**
- Title = full name with academic titles
- Role = EXACT match from role order list above
- Affiliation = university/institution (optional)
- Track = "All Tracks / General" for general committees; "SE"/"ELS"/"SS" for track-specific
- No featured image needed for committees

## ⬜ TODO (not yet done)

1. **Committee** — input all remaining committee members
2. **Speaker** — input keynote + invited speakers (names TBA in the data doc, marked "TBA")
3. **AIC Settings tabs:**
   - Chairperson — name, title, photo, welcome message (Prof. Melinda)
   - Co-Organizers — logos, names, URLs
   - Gallery — upload previous AIC photos
   - Templates — upload DOCX abstract templates per track
   - Schedule — Day 1 & Day 2 agenda
4. **Logo & Favicon** — WP Admin → Customize → Site Identity → upload logo + site icon
5. **Page content:** Paper Submission, Registration Fee, Template, Previous AICs pages still may have Colibri content — clean if needed
6. **Permalinks** — verify / save Post name
7. **Delete `inc/seed-data.php` from production** — Plesk File Manager
8. **Submission URLs** — need OCS links from committee
9. **Registration Form URL** — need from committee
10. **Test all pages + mobile + PageSpeed**

## Gotchas

- **Colibri cleanup:** `aic_clean_colibri()` strips Colibri wrapper HTML. If Colibri content looks wrong, switch to Code Editor and paste clean HTML.
- **No `node_modules` on production** — don't upload, only needed for local Tailwind build
- **`content_url()` for images** — never hardcode `aic.test` or domain URLs
- **seed-data.php** — commented out in `functions.php`, safe to delete from production
- **Track detection** in `header.php` — based on page slug matching `se`, `els`, `ss`
- **Template files appear as dropdown options** because of `/* Template Name: ... */` comment headers
- **ACF fields registered via PHP** — no ACF UI field groups, changes to `cpt-acf.php` take effect immediately
- **Role names must EXACTLY match** what's in the `$role_order` array in `page-track-committees.php` to appear in proper position
- **Conference chair badge** shows "Chair" for any role containing "Chair"
