# 🏆 CertifyPress Pro (v1.3.0 Stable)

> **The enterprise-grade digital certificate publishing, secure verification, vector PDF generation, and automated licensing system for WordPress.**

[![WordPress](https://img.shields.io/badge/WordPress-v5.8%2B-21759b.svg?logo=wordpress&logoColor=white)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-7.4%20--%208.2-8892bf.svg?logo=php&logoColor=white)](https://php.net)
[![Elementor Compatible](https://img.shields.io/badge/Elementor-2.0%2B%20Compatible-red.svg?logo=elementor&logoColor=white)](https://elementor.com)
[![Status](https://img.shields.io/badge/Release-v1.3.0%20Stable%20(LTS)-10b981.svg)]()
[![License](https://img.shields.io/badge/License-Commercial%20Proprietary-orange.svg)]()

---

## 📋 Table of Contents

- [🌟 Overview](#-overview)
- [⚡ What's New & Better in v1.3.0 (vs v1.2)](#-whats-new--better-in-v130-vs-v12)
- [🚀 Core Platform Features](#-core-platform-features)
- [🎨 Drag-and-Drop Elementor Builder](#-drag-and-drop-elementor-builder)
- [🧩 Custom Fields Studio](#-custom-fields-studio)
- [🔍 Real-Time Verification & Search Engine](#-real-time-verification--search-engine)
- [📄 Vector Landscape PDF Generation](#-vector-landscape-pdf-generation)
- [📱 Dynamic QR Verification Engine](#-dynamic-qr-verification-engine)
- [🔢 Automated Serial Numbering](#-automated-serial-numbering)
- [⏳ Expiry & Revocation Management](#-expiry--revocation-management)
- [🛡️ Anti-Theft & Security Hardening](#-anti-theft--security-hardening)
- [🏷️ Complete Shortcode Reference](#-complete-shortcode-reference)
- [📂 Plugin Directory Architecture](#-plugin-directory-architecture)
- [📥 Installation & Quick Start](#-installation--quick-start)
- [🗺️ Future Architectural Plans](#-future-architectural-plans)

---

## 🌟 Overview

**CertifyPress Pro v1.3.0** is an industrial-strength credentialing infrastructure built for WordPress. Engineered specifically for online academies, universities, training bootcamps, corporations, and compliance institutes, it streamlines the complete lifecycle of designing, issuing, managing, verifying, and publishing tamper-proof digital credentials.

Every credential published is tamper-evident, verifiable via public QR codes or unique alphanumeric serial identifiers, and downloadable as pixel-perfect vector landscape PDF documents.

---

## ⚡ What's New & Better in v1.3.0 (vs v1.2)

Version 1.3.0 brings major architectural enhancements, refined visual controls, performance optimizations, and hardened data isolation compared to the v1.2 branch:

| Feature / Area | Version 1.2 | Version 1.3.0 (Major Upgrades) |
| :--- | :--- | :--- |
| **Data Portability Hub** | Basic single-record handling | **Full XML & CSV Data Import/Export Hub:** Easily migrate hundreds of records, custom field mappings, grades, and categories in bulk. |
| **Search Form Widget Controls** | Fixed search behavior | **Granular Per-Widget Controls:** Choose Search Result Action (In-Page AJAX, Open in New Tab, or Redirect) and Layout Mode (Theme Layout vs Standalone Portal). |
| **Public Verification Routing** | Simple query strings (`?lmcp_cert=ID`) | **Clean `/verify/{code}/` Permalinks:** Beautiful URL structure with 8-character masked alphanumeric tokens (e.g. `S7W4WJT3`) that hide internal database IDs. |
| **Vector Icon Rendering** | Dependent on Dashicons / Font icons | **100% Native Inline SVG Engine:** Completely eliminated font icon files. Zero font-loading flicker (FOIT), zero CSS bloat, and instant sharp rendering. |
| **Theme CSS Containment** | Theme margins caused slight misalignment | **Isolated Margin & Padding Reset Layer:** Neutralizes 25px bottom margins from themes like Astra/Hello for razor-sharp landscape alignment. |
| **Landscape PDF Buffer** | Occasional border cut-off on high-DPI screens | **Engineered +40px Safety Buffer:** Client-side vector calculation with zero clipping on decorative borders, signatures, and stamps. |
| **Anti-Theft Protection** | Basic frontend display | **Full Content Copy & Selection Shield:** Right-click context menus, image dragging, and text selection are blocked on certificate templates. |
| **Template Caching Engine** | Full re-render on every lookup | **Signature-Based Token Caching:** Dynamic token rendering with cache signatures for instant sub-second lookup response times under heavy traffic. |
| **Student Profiles Integration** | Single certificate view only | **Frontend Student Profiles Portal:** Supports student vault dashboards via `[certifypress_student_profile]`. |

---

## 🚀 Core Platform Features

* **Unlimited Document Publishing:** Issue academic certificates, diplomas, exam marksheets, event badges, and corporate training credentials.
* **Elementor Pro Customizer Integration:** 6 customized drag-and-drop Elementor widgets with real-time preview and dynamic data binding.
* **Instant Verification Engine:** Responsive, multi-column search portals accessible from any desktop or mobile device.
* **Tamper-Evident QR Codes:** High-contrast vector QR codes generated natively without third-party API dependencies.
* **Automated Email Dispatch:** Instantly mail personalized certificate credentials and direct PDF links to recipients upon publication.
* **Multi-Tier Whitelabeling:** Customize dashboard logos, rename menu items, and personalize client hand-offs.

---

## 🎨 Drag-and-Drop Elementor Builder

Design templates visually without touching code. CertifyPress Pro adds **6 purpose-built widgets** inside Elementor:

| Widget | Purpose | Key Controls |
| :--- | :--- | :--- |
| **🏆 Certificate Heading** | Titles, award headlines, or institute branding | Typography, gradient color fills, letter spacing, alignment resets |
| **📝 Certificate Text Editor** | Student details and award narrative | **Dynamic Field Inserter Button** (click to embed any custom field token) |
| **📲 Dynamic QR Code** | Auto-generated scannable verification badge | Size (px), error correction levels, border radius, deep-link routing |
| **📅 Expire Note Widget** | Dynamic validity and expiration warnings | Conditional visibility, custom alert banners, typography |
| **🔗 Validity Status Badge** | Real-time status pill (Verified, Revoked, Expired) | Color palettes, badge styling, status icons |
| **🔑 Key Verification Badge** | Cryptographic hash and serial number stamp | Alphanumeric formatting, letter spacing, font styling |

---

## 🧩 Custom Fields Studio

Tailor certificate records to any academic or professional discipline without writing PHP:
* **Supported Field Types:** Single-line Text, Multi-line Textarea, Number, Date Picker, Dropdown Select, Image URL, File Attachment, Dynamic Data Tables, and Auto-Generated Security Keys (12-16 alphanumeric digits).
* **Instant Dynamic Binding:** Registered fields immediately appear in post editors, Elementor dynamic shortcode menus, and CSV bulk importer column mappers.

---

## 🔍 Real-Time Verification & Search Engine

Provide a seamless, branded verification experience on your public website:
* **Embed Anywhere:** Drop `[lmcp_search]` onto any WordPress page, sidebar, or Elementor container.
* **Multi-Criteria Search:** Allow employers and students to verify by **Serial Number**, **Student Name**, **Roll Number**, **National ID**, or **Issue Date**.
* **Protected by Google reCAPTCHA v3:** Safeguard search queries against automated scraping and DDoS attacks.
* **Standalone Verification Landing Pages:** Unique permalink URL (`/verify/{unique-code}`) loaded with schema metadata and social graph cards.

---

## 📄 Vector Landscape PDF Generation

* **Standard A4 Landscape Orientation:** Pre-configured `297mm × 210mm` aspect ratio.
* **Client-Side Rendering:** Generates PDFs entirely in the recipient's browser using HTML5 Canvas vectorization with `html2pdf.js`, bypassing server memory bottlenecks.
* **Zero Clipping Height Buffer:** Integrated safety cushion ensures signatures and decorative borders are never truncated at page boundaries.
* **Embedded Font Fidelity:** Ensures custom Google Fonts and typography styles render identical to the on-screen preview.

---

## 📱 Dynamic QR Verification Engine

* **High-Speed Native PHP Rendering:** Generates QR codes directly on the server without external third-party API dependencies.
* **Instant Smartphone Verification:** Scanning routes directly to the official certificate verification page with an active status badge.
* **Masked Security Routing:** Uses 8-character unique alphanumeric tokens (`S7W4WJT3`) instead of sequential database IDs to prevent record guessing.

---

## 🔢 Automated Serial Numbering

* **Configurable Prefix Patterns:** Set custom prefixes (e.g. `CERT-2026-`, `DEG-`, `TRAIN-`).
* **Auto-Increment Counters:** Concurrency-safe counter tracking prevents duplicate serial assignments.
* **Searchable Identity:** Search forms instantly resolve serial numbers to published student records.

---

## ⏳ Expiry & Revocation Management

* **Expiration Lifecycles:** Assign fixed expiry dates; past-date credentials automatically flag as Expired.
* **One-Click Revocation:** Mark compromised, retracted, or invalidated credentials as **Revoked** with optional public explanations.
* **Download Lock on Invalidation:** Restrict PDF downloads for expired or revoked credentials automatically.

---

## 🛡️ Anti-Theft & Security Hardening

* **Copy & Selection Protection:** Disables right-click context menus, image dragging, and text selection highlights on certificate views.
* **Google reCAPTCHA v3 Support:** Blocks automated scraping bots and brute-force inquiries.
* **SHA-256 HMAC Signatures:** Security hashing verifies database values to protect against unauthorized tampering.
* **Strict Nonce Checks:** All administrative actions and search queries are protected by WordPress security tokens.

---

## 🏷️ Complete Shortcode Reference

```
[lmcp_search]                        # Embed the Public Verification Portal
[lmcp_field slug="post_title"]       # Certificate Title / Program Name
[lmcp_field slug="student_name"]     # Full Legal Name of Recipient
[lmcp_field slug="roll_number"]      # Student Roll / Registration Number
[lmcp_field slug="student_rank"]     # Grade, Percentile, or GPA
[lmcp_field slug="issue_date"]       # Official Issue Date
[lmcp_field slug="expiry_date"]      # Expiration Date
[lmcp_field slug="serial_number"]    # Unique Serial Number (e.g. CERT-2026-0001)
[lmcp_field slug="category"]         # Academic Program / Track Taxonomy
[lmcp_field slug="CUSTOM_SLUG"]      # Any user-defined custom field slug
```

---

## 📂 Plugin Directory Architecture

```
lm-certificate-publisher-pro/
├── admin/
│   ├── css/                         # Admin styles & design system
│   ├── js/                          # Admin JavaScript & modals
│   └── views/
│       ├── view-all-certificates.php        # Certificate data table
│       ├── view-add-edit-certificate.php    # Publication screen
│       ├── view-custom-fields.php           # Field definition studio
│       ├── view-search-field-selection.php  # Search portal configuration
│       ├── view-advanced-settings.php       # Core plugin settings & tabs
│       ├── view-export-import.php           # CSV & XML batch data hub
│       └── view-license.php                 # License key management
├── assets/
│   ├── css/                         # Frontend styles & PDF canvas resets
│   ├── js/                          # html2pdf.js & verification scripts
│   └── images/                      # Native SVG vector assets
├── includes/
│   ├── class-lmcp-certificate.php   # Core post type & taxonomy registrar
│   ├── class-lmcp-elementor.php     # Elementor widget loader
│   ├── class-lmcp-license.php       # Activation & central registry client
│   └── widgets/                     # 6 Elementor visual widgets
├── HOW_TO_USE.md                    # Detailed User Manual & Settings Guide
├── README.md                        # Official Plugin Documentation
└── certifypress.php                 # Main WordPress Plugin Entry Point
```

---

## 📥 Installation & Quick Start

1. Download the `CertifyPress-Pro-v1.3.0-Stable.zip` archive.
2. In your WordPress administration dashboard, navigate to **Plugins > Add New > Upload Plugin**.
3. Select the `.zip` archive and click **Install Now**.
4. Click **Activate Plugin**.
5. Navigate to **🏆 Certificates > License** and enter your license key to activate updates and verified features.
6. Design your layout in Elementor, publish your first certificate, and embed `[lmcp_search]` on your verification page!

---

## 🗺️ Future Architectural Plans

* **Multi-Entity Post Type Architecture:** Future development plans include multi-entity scoping, allowing isolated sub-systems for Exam Results, Student Marksheets, and Membership Cards with dedicated independent submenus.
* **REST API Public Webhooks:** Extended outbound webhook notifications for enterprise LMS systems upon credential issuance.

---

*CertifyPress Pro v1.3.0 Stable — Engineered for uncompromising reliability, security, and performance.*
