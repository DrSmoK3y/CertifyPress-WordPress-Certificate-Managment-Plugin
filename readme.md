# LM Certificate Publisher (CertifyPress Free) 🎓📜

[![WordPress Version](https://img.shields.io/badge/WordPress-5.8%2B-blue.svg?logo=wordpress&logoColor=white)](https://wordpress.org)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%20to%208.3%2B-777BB4.svg?logo=php&logoColor=white)](https://php.net)
[![License: GPL-2.0-or-later](https://img.shields.io/badge/License-GPLv2%2B-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![Version](https://img.shields.io/badge/Version-1.1.1-teal.svg)](#changelog)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](#contributing)

> **The lightweight, powerful, and free credential publishing & online verification system for WordPress.**  
> Create, manage, and verify student certificates, diplomas, academic transcripts, and training achievements with zero coding required.

---

## 📑 Table of Contents

- [Overview](#-overview)
- [Why LM Certificate Publisher?](#-why-lm-certificate-publisher)
- [Core Features (Free Version)](#-core-features-free-version)
- [🔥 Comprehensive FREE vs PRO Comparison](#-comprehensive-free-vs-pro-comparison)
- [Shortcode Documentation](#-shortcode-documentation)
- [Installation & Quick Start](#-installation--quick-start)
- [Configuration Guide](#-configuration-guide)
- [Developer Hooks & Customization](#-developer-hooks--customization)
- [Upgrade to Pro Guarantee](#-upgrade-to-pro-guarantee)
- [License & Support](#-license--support)

---

## 🌟 Overview

**LM Certificate Publisher** is an open-source WordPress plugin purpose-built for schools, colleges, academies, online course creators, NGOs, and professional training institutes. It provides an intuitive, turnkey environment to publish and verify credentials directly from your WordPress dashboard.

Students and employers can instantly verify credential authenticity through front-end AJAX search forms without needing an account or login.

```
┌────────────────────────────────────────────────────────┐
│  🎓 Student Enters Roll No / Certificate ID            │
└──────────────────────────┬─────────────────────────────┘
                           │ Instant AJAX Lookup
                           ▼
┌────────────────────────────────────────────────────────┐
│  ✅ Verified Credential Card Displayed                 │
│  • Modern Vertical Stacked Layout / Classic Table      │
│  • Custom Meta Fields (Grades, Photos, Issue Date)     │
│  • Built-in Print Friendly Mode                        │
│  • 1-Click Social Sharing (LinkedIn, Twitter, FB)      │
└────────────────────────────────────────────────────────┘
```

---

## 🚀 Why LM Certificate Publisher?

- ⚡ **Ultra-Fast & Lightweight:** Pure vanilla JS and optimized WordPress queries. Zero bloat, zero heavy third-party CSS frameworks.
- 🎨 **2 Beautiful Built-in Layouts:** Switch between the **Modern Vertical Stacked Card** and the **Classic Horizontal Rows Table** with 1 click.
- 🛡️ **Production-Grade Security:** Hardened against CSRF, SQL Injection, XSS, and IDOR vulnerabilities.
- 📱 **100% Mobile Responsive:** Verification search and certificate layouts look crisp on iPhones, Android devices, tablets, and desktops.
- 🌐 **Fully Translatable:** Customize every single label (Search button, placeholder, error messages, and verified badges) right from the dashboard.

---

## ✨ Core Features (Free Version)

### 1. Dedicated Certificate Post Type (`lmc_certificate`)
- Keeps your academic records cleanly isolated from standard WordPress posts and pages.
- Standard WordPress draft, private, and published status controls (prepare certificates confidentially and publish when exams are finalized).

### 2. Dynamic Custom Fields Builder
- Add an unlimited number of metadata fields to match your organization's exact needs:
  - 📝 **Text:** Student Name, Father Name, Course Title
  - 🔢 **Number:** Marks, Percentage, Credits, Roll Number
  - 📅 **Date:** Date of Issue, Passing Date, Graduation Date
  - 🔗 **URL:** Portfolio Link, Institutional Verification Link
  - 🖼️ **Image:** Student Photo, Institute Crest / Seal, Official Signature
  - 📎 **File Attachment:** Downloadable Syllabus, Supporting Transcript PDF
  - 📊 **Table:** Subject-wise Marks & Semester Grade Breakdown

### 3. Front-End AJAX Search (No Reloads)
- Real-time search experience with instant result feedback.
- Configure which fields are searchable (e.g., allow searching by Roll Number, CNIC/ID, or Student Name).
- Category and Tag dropdown filters to narrow searches by batch, department, or academic year.

### 4. Modern Templates & Custom Branding Hub
- **Modern Vertical / Stacked Card (Default):** Prominent header badge, bold certificate title, and clean vertically stacked credential fields.
- **Classic Horizontal Rows:** Two-column structured data table.
- Complete color palette customization: Primary brand color, button background/hover, card border color, background fill, and corner radius (`border-radius`).

### 5. Print & Social Sharing Integration
- **One-Click Clean Print:** Automatically strips search headers and prints an isolated, media-print optimized certificate.
- **Viral Social Sharing:** Verified students can share their achievements directly to LinkedIn, Facebook, Twitter, WhatsApp, or copy the direct verification link.

---

## 🔥 Comprehensive FREE vs PRO Comparison

Whether you need a simple certificate search directory or an enterprise credential infrastructure, compare the capabilities below:

| Feature / Capability | 🆓 Free Version (LM Certificate Publisher) | 🚀 Pro Version (CertifyPress Pro) |
| :--- | :---: | :---: |
| **Price & Licensing** | **100% Free & Open Source (GPLv2)** | **Premium Commercial License** |
| **Unlimited Certificates & Categories** | ✅ Included | ✅ Included |
| **Dynamic Custom Fields Builder** | ✅ Included (Text, Number, Date, URL, Image, File, Table) | ✅ Included + Advanced Validation & Calculated Meta |
| **Front-End Search Shortcodes** | ✅ Included (3 Shortcodes with Category/Tag filters) | ✅ Included + Gutenberg Blocks & Elementor Widgets |
| **Certificate Display Engines** | Built-in Vertical Card & Classic Horizontal Table | **3 Complete Engines:**<br>1. Modern Vertical & Horizontal Table<br>2. **Visual Elementor Page Builder Canvas**<br>3. **Zero-Dependency Pure HTML5 & CSS3** |
| **Dynamic QR Code Verification** | ❌ None (or manual external image) | ✅ **Built-in Auto-Generated SVG/PNG QR Codes** with customizable scan destinations & corners |
| **Dedicated Verification URL & Slugs** | ❌ (In-page AJAX result only) | ✅ **Clean Dedicated Verification URLs** (e.g., `yoursite.com/verify/ABC12345/`) |
| **Certificate Expiration & Validity Logic** | ❌ None | ✅ **Auto-Expiry Dates**, Days Remaining Alerts, and Visual Expired/Suspended/Revoked Badges |
| **PDF Generation & Vector Export** | ⚠️ Browser Print to PDF only | ✅ **Automated 1-Click Server-Side Vector PDF Export** (Dompdf engine with embedded Google Fonts) |
| **Unique Credential ID / Hash** | ❌ Manual custom field | ✅ **Automated Cryptographic Unique Codes** (8–16 character alphanumeric tokens) |
| **Bulk CSV & Excel Operations** | ❌ Manual 1-by-1 entry | ✅ **High-Speed CSV / Excel Import & Export** (Batch-publish hundreds of certificates in seconds) |
| **Automated Issue via Forms** | ❌ None | ✅ **Forminator, Gravity Forms, Contact Form 7** integration extensions |
| **WooCommerce Monetization** | ❌ None | ✅ **CertifyPress WooCommerce Addon** (Auto-generate and email certificate upon product purchase) |
| **Google reCAPTCHA v3 Protection** | ❌ Basic nonce check | ✅ **Invisible Google reCAPTCHA v3** to prevent scrapers and automated credential brute-forcing |
| **Search Preloader Animations** | ❌ Basic CSS spinner | ✅ **Custom Branded Preloaders**, Animated Pulse Bars, and Custom Lottie / GIF Animations |
| **White-Label Branding** | ❌ Standard admin headers | ✅ **Complete White-Labeling:** Custom admin logo, custom menu title, hidden Pro upgrade notices |
| **Privacy & Search Engine Indexing** | ⚠️ Public search query | ✅ **Granular SEO Privacy:** `noindex` headers, exclude certificates from XML sitemaps, password locks |
| **Student / Public Verification Portal** | ❌ In-page shortcode | ✅ **Full-Screen Standalone Verification Portal** (Theme Canvas vs Isolated Clean Canvas) |
| **Automatic Email Dispatch** | ❌ None | ✅ **Automated Email Notifications** with certificate download link & unique verification token |
| **Support & Update Channel** | Community WordPress.org Forums | **Priority 24/7 Developer Support & Automatic 1-Click Dashboard Updates** |

---

## 💻 Shortcode Documentation & Widgets

Embed the verification portal anywhere using these flexible WordPress shortcodes:

### 1. Basic Certificate Search Form
```text
[lmc_certificate_search]
```
*Renders a clean search bar matching your configured searchable custom fields.*

### 2. Search with Category Filter Dropdown
```text
[lmc_certificate_search_categories]
```
*Adds a dropdown selector allowing visitors to filter by academic program, diploma type, or department.*

### 3. Search with Both Categories & Tags Dropdown
```text
[lmc_certificate_search_tags_categories]
```
*Adds two distinct dropdowns: one for Categories (e.g., "Web Development") and one for Tags (e.g., "Batch 2024", "Fall Semester").*

### 4. WordPress Default Editor and Elementor Search Form Widget
*easy to customizeable widgets with all features and style options*
---

## 📥 Installation & Quick Start

### Option A: From WordPress Admin
1. Go to **Plugins > Add New Plugin** in your WordPress dashboard.
2. Search for `LM Certificate Publisher`.
3. Click **Install Now** and then **Activate**.

### Option B: Manual ZIP Upload
1. Download the latest `lm-certificate-publisher.zip` from the [Releases](https://github.com/DrSmoK3y/CertifyPress-Lite/releases) tab.
2. Navigate to **Plugins > Add New > Upload Plugin**.
3. Select the `.zip` file and click **Install Now**.
4. Activate the plugin.

### Option C: Via Git
```bash
cd wp-content/plugins/
git clone https://github.com/DrSmoK3y/CertifyPress-Lite/tree/version-1.1.1.git
```

---

## ⚙️ Configuration Guide (5-Minute Setup)

1. **Define Your Credential Fields:**  
   Go to **Certificates > Custom Fields** and click **Add New Field**.  
   *Example:* Name: `Student Roll Number`, Slug: `roll_number`, Type: `Text`.
2. **Choose Your Searchable Keys:**  
   Navigate to **Certificates > Search Settings**. Copy your desired field slug (e.g. `roll_number`) and paste it into the **Searchable Field Slugs** box.
3. **Customize Display Layout & Colors:**  
   Head to **Certificates > Settings > Templates & Styling**.  
   - Choose between **Modern Vertical / Stacked Card** or **Classic Horizontal Table**.  
   - Set your institute's primary color (`#14bda9`), button styles, and card borders.
4. **Publish Certificates:**  
   Go to **Certificates > Add Certificate**. Enter the recipient's name as the Title, fill in your custom metadata fields, select a category, and click **Publish**.
5. **Add Search to Your Website:**  
   Create a new page (e.g., `yoursite.com/verify-certificate/`) and paste `[lmc_certificate_search]`.

---

## 🛠️ Developer Hooks & Customization

LM Certificate Publisher is built with WordPress developer best practices:

### Filters
```php
// Filter certificate query arguments before execution
add_filter( 'lmcp_search_query_args', function( $args, $search_term ) {
    // Modify query parameters (e.g. limit to 10 results)
    $args['posts_per_page'] = 10;
    return $args;
}, 10, 2 );

// Customize social sharing channels
add_filter( 'lmcp_social_share_links', function( $links, $cert_id ) {
    // Add custom Telegram or Discord share link
    return $links;
}, 10, 2 );
```

---

## 🔄 Upgrade to Pro Guarantee

Need automated QR codes, Elementor visual drag-and-drop templates, bulk CSV imports, or server-side vector PDF exports?

Upgrading to **CertifyPress Pro** is completely seamless:
- **100% Zero Data Loss:** Pro shares the exact same database architecture, post types (`lmc_certificate`), taxonomies, and custom field meta keys.
- **Instant Activation:** Deactivate the Free version, activate Pro, and your existing certificates instantly gain QR code verification, vector PDF downloads, and Elementor template rendering.

🔗 [Explore CertifyPress Pro Features & Pricing](http://certifypress.site/)

---


## 📄 License & Credits

- **Author:** [LM Designers](https://lmwebdesigners.com)
- **License:** Distributed under the **GNU General Public License v2 or later (GPL-2.0-or-later)**. See `LICENSE` for details.
- **Documentation & Tutorials:** [How to Create an Online Certificate Website on WordPress](http://certifypress.site/how-to-create-online-certificate-website-on-wordpress/)
- **Support Email:** `support@lmwebdesigners.com`
