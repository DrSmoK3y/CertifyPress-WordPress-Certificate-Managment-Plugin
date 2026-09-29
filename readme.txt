=== LM Certificate Publisher ===
Contributors: lmdesigners
Tags: certificate, results verify, school, college
Requires at least: 5.8
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.1.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

An all-in-one certification setup for schools, colleges, training centres, and institutes. Easily create certificates, diplomas, and online results with fast Ajax search, customizable labels, social sharing, and print functionality.

== Description ==

LM Certificate Publisher is a modern, reliable WordPress plugin designed for schools, colleges, training centers, and educational institutes to create, manage, and verify student certificates online.

Whether you need to issue course completion certificates, diplomas, achievement awards, or result verifications, LM Certificate Publisher gives you a complete credential management system inside your WordPress dashboard.

**What You Can Do:**
– Create unlimited certificates with custom fields
– Organize certificates with categories and tags
– Let students or visitors search and verify certificates from the frontend
– Save certificates as drafts before publishing
– Manage everything from one clean admin interface

**Key Features:**
– **Custom Certificate Post Type** — Dedicated area for all your certificates, separate from posts and pages.
– **Categories & Tags** — Group certificates by course type, year, department, or any system you prefer.
– **Custom Fields** — Add any data you need: Student ID, Roll Number, Course Name, Grade, Issue Date, Image, File, URL, and more.
– **Frontend Search** — Students can search their certificates using shortcodes. No login required.
– **Draft & Publish** — Prepare certificates privately and publish only when ready.
– **Bulk Management** — View, filter, edit, and delete certificates quickly from the admin list.
– **Print Results** — Users can print their certificate search results directly from the frontend.

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/lm-certificate-publisher/`, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to the **Certificates** menu in your admin sidebar.
4. Create custom fields first at **Certificates > Custom Fields**.
5. Add your first certificate at **Certificates > Add Certificate**.
6. Use shortcodes on any page to display the search form.

== Frequently Asked Questions ==

= How do I add a certificate? =

Go to **Certificates > Add Certificate** in your WordPress admin. Fill in the certificate title, enter values for your custom fields, select categories/tags if needed, and click **Publish Certificate**.

= How do I create custom fields? =

Navigate to **Certificates > Custom Fields**. Click **Add New Field**, give it a name (e.g., "Student ID"), a unique slug (e.g., `student_id`), and select a field type (Text, Number, URL, Date, Image, or File). These fields will then appear on every certificate form.

= How do I search certificates on the frontend? =

Use one of these shortcodes on any page or post:

* `[lmc_certificate_search]` — Simple search form.
* `[lmc_certificate_search_categories]` — Search with a category dropdown.
* `[lmc_certificate_search_tags_categories]` — Search with both category and tag dropdowns.

= What field slug should I use for searching? =

Go to **Certificates > Custom Fields** and click on any field slug (shown in red) to copy it. Then paste that slug into **Certificates > Search Settings** under "Searchable Field Slugs". You can add multiple slugs separated by commas.

= Can I save a certificate without publishing it? =

Yes. When adding or editing a certificate, click **Save as Draft** instead of **Publish Certificate**. Draft certificates will not appear in frontend search results.

= How do I organize certificates? =

Use **Categories** for broad groups (e.g., "Diploma", "Completion Certificate") and **Tags** for specific details (e.g., "2024", "Online Course", "Batch A"). You can manage them at **Certificates > Tags & Categories**.

= Can users print their certificate results? =

Yes. Every frontend search form includes a **Print Results** button that opens a clean, print-friendly page with all found certificates.

= Is my certificate data safe if I upgrade to Pro later? =

Yes. The Pro version uses the same database structure, post types, and field keys. All your certificates, custom fields, and settings will remain intact when you upgrade. if you are interested in PAID version you can visit https://lmwebdesigners.com/plugin/lm-certificates-publisher/


= Where can I get help or report a bug? =

You can reach out through the plugin support forum or contact us directly via our website for any technical issues, feature requests, or feedback. You can also write to us at support@lmwebdesigners.com.
if you dont know how to use it, read this article, https://lmwebdesigners.com/how-to-create-online-certificate-website-on-wordpress/ 

== Screenshots ==

1. All Certificates list with filters and bulk actions.
2. Add/Edit Certificate form with custom fields.
3. Custom Fields manager with drag-and-drop ordering.
4. Frontend search form with results.
5. Search Settings and shortcode reference.

== Changelog ==

= 1.1.0 =
* Added Modern Vertical / Stacked Certificate Display Template as the new default layout (Title on top, field headings above, values below).
* Enhanced Templates & Styling Configuration Hub with button labels customizer (Search, Print, Download, Clear, Verified Link).
* Comprehensive button styling controls (Background color, hover color, text color, corner radius).
* Search form and results card container styling (Border colors, background, corner radius).
* Major UI/UX overhaul aligning admin dashboard with modern card-based interface matching CertifyPress Pro standards.
* Grid and List view toggle added for All Certificates screen with fixed bulk action nonces.
* Interactive custom field management with dynamic type-specific options (Tables, Key tokens, File uploads).
* Security hardening against CSRF, broken authentication, IDOR, and FastCGI input drops across all operations.

= 1.0.0 =
* Initial release.
* Custom Certificate Post Type.
* Categories and Tags support.
* Custom Fields with 6 field types.
* Frontend search via shortcodes.
* Draft and Publish status support.
* Admin list table with sorting and filtering.
