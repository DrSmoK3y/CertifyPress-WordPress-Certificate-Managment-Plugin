=== CertifyPress ===
Contributors: lmdesigners
Donate link: https://lmwebdesigners.com/
Tags: certificate, school, college, student, diploma
Requires at least: 5.8
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A powerful yet simple solution for creating, managing, and verifying school/college certificates. Built for educators who need professional credential management.

== Description ==

**CertifyPress** is a comprehensive WordPress certificate management system designed specifically for schools, colleges, training institutes, and educational organizations.

Whether you need to issue completion certificates, diplomas, achievement awards, or professional credentials, CertifyPress gives you complete control over the entire certificate lifecycle from creation to verification.

= Free Features =

**✅ Custom Certificate Post Type**
Create and manage unlimited certificates with a dedicated admin interface. No cluttering your regular posts or pages.

**✅ Categories & Tags**
Organize certificates hierarchically with categories (e.g., "Diploma", "Completion Certificate") and add flexible tags (e.g., "2024", "Online Course", "Advanced Level").

**✅ Custom Fields**
Build your own certificate data structure with unlimited custom fields:
* Text, Number, URL, Date fields
* Image uploads (student photos, signatures, logos)
* File uploads (supporting documents)
* Drag-and-drop field reordering

**✅ Frontend Certificate Search**
Allow students, employers, and institutions to verify certificates publicly using shortcodes:
* `[certificate_search]` — Simple search form
* `[certificate_search_categories]` — Search with category filter
* `[certificate_search_tags_categories]` — Search with both category and tag filters

**✅ Draft & Publish Status**
Save certificates as drafts while preparing them, then publish when ready. Full status control.

**✅ Bulk Management**
Delete multiple certificates at once from the admin list table. Filter by status, category, or tag.

**✅ Print Results**
Frontend users can print verified certificate results directly from the search page with professional formatting.

**✅ Mobile Responsive**
All frontend search forms and certificate displays are fully responsive and work beautifully on all devices.

= Pro Features (Upgrade Available) =

🔓 **[Get CertifyPress Pro](https://lmwebdesigners.com/plugin/certifypress-students-certificates-results/)** to unlock professional-grade features:

* **🎨 Elementor Template Designer** — Design stunning, pixel-perfect certificates with drag-and-drop builder
* **📱 QR Code Verification** — Every certificate gets a unique QR code for instant mobile verification
* **📄 PDF Certificate Download** — Generate print-ready PDFs with watermarks and signatures
* **🔢 Auto Serial Numbers** — Unique trackable serials like CERT-2026-000001
* **⏳ Certificate Expiration** — Set expiry dates for time-sensitive certifications
* **📧 Email to Students** — Auto-email certificates with verification links upon publishing
* **📊 Bulk CSV Import** — Import hundreds of certificates instantly via CSV upload
* **🔍 Standalone Verification Page** — Public verification via `[certificate_verify]` shortcode
* **🛡️ Duplicate Prevention** — Enforce unique values on searchable fields
* **🏷️ Category-Specific Templates** — Different designs for different certificate types

== Installation ==

= From WordPress Admin =
1. Go to **Plugins → Add New**
2. Search for "CertifyPress"
3. Click **Install Now**, then **Activate**

= Manual Upload =
1. Download the plugin ZIP file
2. Go to **Plugins → Add New → Upload Plugin**
3. Choose the ZIP file and click **Install Now**
4. Click **Activate**

= After Activation =
1. Find the **Certificates** menu in your WordPress admin sidebar
2. Go to **Certificates → Custom Fields** to create your first custom fields (e.g., Student Name, Roll Number, Course Name)
3. Go to **Certificates → Add Certificate** to create your first certificate
4. Use **Certificates → Search Settings** to configure which fields are searchable
5. Copy the shortcode and paste it into any page or post for frontend search

== Frequently Asked Questions ==

= How do I add a certificate? =
Go to **Certificates → Add Certificate**. Fill in the certificate title, custom fields, select categories/tags, and click "Publish Certificate" or "Save as Draft".

= How do students search their certificates on the frontend? =
Use the `[certificate_search]` shortcode on any page. Students enter their roll number or certificate ID to find their record instantly.

= Can I add custom fields like Student Photo or Signature? =
Yes! Go to **Certificates → Custom Fields** and create fields with type "Image Upload" or "File Upload". These will appear in the certificate form with a media uploader.

= How do I make certificates searchable by Roll Number? =
1. Create a custom field named "Roll Number" with slug `roll_number`
2. Go to **Certificates → Search Settings**
3. Enter `roll_number` in the "Searchable Field Slugs" box
4. Save settings — now students can search by roll number

= Can I organize certificates by type? =
Absolutely. Use **Categories** for broad types (Diploma, Completion, Achievement) and **Tags** for specific attributes (2024, Online, Advanced).

= Is the plugin translation-ready? =
Yes. CertifyPress is fully internationalized and ready for translation via translate.wordpress.org or custom .po/.mo files.

= What happens when I upgrade to Pro? =
Your free data remains intact. Pro adds advanced features on top without affecting existing certificates. Simply install Pro and continue where you left off.

= Does it work with Elementor? =
The free version provides basic shortcodes. The **Pro version** includes dedicated Elementor widgets and a full template designer.

== Screenshots ==

1. **All Certificates Dashboard** — Clean admin interface to manage all certificate records with filters and bulk actions
2. **Add Certificate Form** — Intuitive form with custom fields, media uploads, category/tag selection
3. **Custom Fields Manager** — Drag-and-drop field ordering with copy-to-clipboard slug feature
4. **Search Settings** — Configure searchable fields and form labels with shortcode reference
5. **Frontend Search Form** — Responsive public search with category/tag filters
6. **Certificate Result Display** — Professional table output with print button
7. **Tags & Categories** — Easy organization with WordPress standard taxonomy interface

== Changelog ==

= 1.0.0 =
* Initial release
* Custom certificate post type with draft/publish support
* Unlimited custom fields (text, number, URL, date, image, file)
* Drag-and-drop field reordering
* Categories and tags for certificate organization
* Frontend search with 3 shortcode variations
* Print results functionality
* Bulk delete with filters
* Responsive admin and frontend design

== Upgrade Notice ==

= 1.0.0 =
Initial release. Enjoy certificate management made simple!


== Privacy Policy ==

CertifyPress does not collect, store, or transmit any personal data to external servers. All certificate data is stored locally in your WordPress database. No cookies are set by this plugin.

== Support ==

* **Documentation:** [https://lmwebdesigners.com/plugin/certifypress-students-certificates-results/](https://lmwebdesigners.com/plugin/certifypress-students-certificates-results/)
* **Pro Support:** Available with CertifyPress Pro license
* **Community Support:** Use the WordPress.org support forums for free version
