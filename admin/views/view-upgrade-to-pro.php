<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<style>
/* ========================================================================
   Upgrade to Pro Page Styles
   ======================================================================== */
.sc-pro-features-overview .sc-card-body {
    padding: 0;
}
.sc-pro-main-pitch {
    text-align: center;
    padding: 60px 40px;
    background: #fcfcfc;
}
.sc-pro-main-pitch .sc-pro-icon {
    font-size: 50px;
    margin-bottom: 16px;
    line-height: 1;
}
.sc-pro-main-pitch h2 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 12px;
    color: #1d2327;
}
.sc-pro-main-pitch p {
    font-size: 15px;
    color: #50575e;
    max-width: 600px;
    margin: 0 auto 30px;
    line-height: 1.7;
}
.sc-button-pro {
    background: #00a32a;
    color: #fff !important;
    padding: 0 24px;
    height: 44px;
    font-size: 15px;
    text-decoration: none;
    border: none;
}
.sc-button-pro:hover {
    background: #007018;
    color: #fff !important;
}

.sc-features-heading {
    text-align: center;
    font-size: 20px;
    font-weight: 600;
    margin: 50px 0 30px;
    color: #1d2327;
}
.sc-features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    padding: 0 40px 40px;
}
.sc-feature-item {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    padding: 24px;
    text-align: center;
    transition: all 0.2s ease-in-out;
}
.sc-feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.07);
}
.sc-feature-item .feature-icon {
    font-size: 36px;
    margin-bottom: 16px;
    display: block;
}
.sc-feature-item h3 {
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 8px 0;
    color: #1d2327;
}
.sc-feature-item p {
    font-size: 13px;
    color: #50575e;
    line-height: 1.6;
    margin: 0;
}
.sc-pro-final-cta {
    text-align: center;
    padding-bottom: 60px;
}
.sc-pro-comparison {
    padding: 0 40px 40px;
}
.sc-comparison-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.sc-comparison-table th {
    background: #fafafa;
    padding: 14px 16px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #1d2327;
    border-bottom: 2px solid #e0e0e0;
}
.sc-comparison-table td {
    padding: 14px 16px;
    font-size: 13px;
    color: #2c3338;
    border-bottom: 1px solid #f0f0f1;
}
.sc-comparison-table .check {
    color: #00a32a;
    font-weight: bold;
}
.sc-comparison-table .cross {
    color: #d63638;
}
.sc-pro-banner {
    background: #f0f6fc;
    border-left: 4px solid #2271b1;
    padding: 20px 24px;
    margin: 0 40px 30px;
    border-radius: 4px;
}
.sc-pro-banner h3 {
    margin: 0 0 8px 0;
    font-size: 16px;
    color: #1d2327;
}
.sc-pro-banner p {
    margin: 0;
    font-size: 13px;
    color: #50575e;
}
</style>
<div class="wrap sc-admin-wrapper">

    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1><?php echo esc_html__('Supercharge Your Certificates with CertifyPress Pro', 'certifypress'); ?></h1>
            <p class="sc-page-description"><?php echo esc_html__('Unlock the full potential of your certificate management system with professional-grade features.', 'certifypress'); ?></p>
        </div>
    </div>

    <!-- Pro Features Overview -->
    <div class="sc-card sc-pro-features-overview">
        <div class="sc-card-body">

            <!-- Main Pitch -->
            <div class="sc-pro-main-pitch">
                <div class="sc-pro-icon">🚀</div>
                <h2><?php echo esc_html__('Go Beyond Basic Certificates', 'certifypress'); ?></h2>
                <p><?php echo esc_html__('You are currently using the free version of CertifyPress. Upgrade to Pro to unlock advanced tools that transform how you create, deliver, and verify certificates. From QR code verification to PDF generation, your students deserve the best.', 'certifypress'); ?></p>
                <a href="https://lmwebdesigners.com/plugin/certifypress-students-certificates-results/" target="_blank" class="sc-button sc-button-pro"><?php echo esc_html__('Get CertifyPress Pro Now', 'certifypress'); ?></a>
            </div>

            <!-- Why Upgrade Banner -->
            <div class="sc-pro-banner">
                <h3>🔒 <?php echo esc_html__('Trust & Verification at Scale', 'certifypress'); ?></h3>
                <p><?php echo esc_html__('In 2026, fake certificates are everywhere. Give your students verifiable, professional credentials that employers and institutions can trust instantly.', 'certifypress'); ?></p>
            </div>

            <h2 class="sc-features-heading"><?php echo esc_html__('Here is What You Get with Pro:', 'certifypress'); ?></h2>

            <!-- Features Grid -->
            <div class="sc-features-grid">
                <!-- Feature: Elementor Templates -->
                <div class="sc-feature-item">
                    <div class="feature-icon">🎨</div>
                    <h3><?php echo esc_html__('Elementor Template Designer', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Stop using the basic table layout. Design stunning, pixel-perfect certificates with the familiar Elementor drag-and-drop builder. Your brand, your design, professional output.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: QR Code -->
                <div class="sc-feature-item">
                    <div class="feature-icon">📱</div>
                    <h3><?php echo esc_html__('QR Code Verification', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Every certificate gets a unique QR code. Anyone can scan and verify authenticity instantly. No login required. Perfect for job interviews and university admissions.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: PDF Generation -->
                <div class="sc-feature-item">
                    <div class="feature-icon">📄</div>
                    <h3><?php echo esc_html__('PDF Certificate Download', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Generate print-ready PDF certificates with watermarks, signature areas, and QR codes. Students can download and print professional certificates instantly.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Serial Numbers -->
                <div class="sc-feature-item">
                    <div class="feature-icon">🔢</div>
                    <h3><?php echo esc_html__('Auto Serial Numbers', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Automatically generate unique serial numbers like CERT-2026-000001 for every certificate. Fully trackable and searchable. Customizable prefix format.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Certificate Expiration -->
                <div class="sc-feature-item">
                    <div class="feature-icon">⏳</div>
                    <h3><?php echo esc_html__('Certificate Expiration Dates', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Set an expiry date for each certificate. Perfect for time-sensitive certifications, ensuring all credentials are up-to-date and valid. Auto-hide expired certs from search.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Email -->
                <div class="sc-feature-item">
                    <div class="feature-icon">📧</div>
                    <h3><?php echo esc_html__('Email Certificates to Students', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Automatically email certificate details with verification links to students upon publishing. Custom email templates with dynamic variables. No manual work.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Bulk CSV Import -->
                <div class="sc-feature-item">
                    <div class="feature-icon">📊</div>
                    <h3><?php echo esc_html__('Bulk CSV Import', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Have hundreds of certificates to create? Save hours of manual data entry by uploading all your student data at once with a simple CSV file. Auto-assign categories and tags.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Advanced Widgets -->
                <div class="sc-feature-item">
                    <div class="feature-icon">✍️</div>
                    <h3><?php echo esc_html__('Advanced Elementor Widgets', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Get granular control over your certificate design with dedicated Pro widgets: Heading, Image, Text Editor, Expiry Note, Search Form, and Dynamic Tags.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Verification Page -->
                <div class="sc-feature-item">
                    <div class="feature-icon">🔍</div>
                    <h3><?php echo esc_html__('Standalone Verification Page', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Create a public certificate verification page with [certificate_verify] shortcode. Anyone can verify by serial number. Clean, mobile-friendly verification interface.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Category Templates -->
                <div class="sc-feature-item">
                    <div class="feature-icon">🏷️</div>
                    <h3><?php echo esc_html__('Category-Specific Templates', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Assign different Elementor templates to different certificate categories. Diplomas look different from completion certificates — all automated.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Print Toggle -->
                <div class="sc-feature-item">
                    <div class="feature-icon">🖨️</div>
                    <h3><?php echo esc_html__('Print Button Control', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Choose whether to show or hide the Print button on frontend search forms. Full control over the user experience. Default is ON, disable anytime from settings.', 'certifypress'); ?></p>
                </div>

                <!-- Feature: Duplicate Prevention -->
                <div class="sc-feature-item">
                    <div class="feature-icon">🛡️</div>
                    <h3><?php echo esc_html__('Duplicate Prevention', 'certifypress'); ?></h3>
                    <p><?php echo esc_html__('Prevent duplicate certificates by enforcing unique values on searchable fields. No more accidental double-issuing the same certificate number or student ID.', 'certifypress'); ?></p>
                </div>
            </div>

            <!-- Comparison Table -->
            <h2 class="sc-features-heading"><?php echo esc_html__('Free vs Pro Comparison', 'certifypress'); ?></h2>
            <div class="sc-pro-comparison">
                <table class="sc-comparison-table">
                    <thead>
                        <tr>
                            <th style="width: 40%;"><?php echo esc_html__('Feature', 'certifypress'); ?></th>
                            <th style="width: 30%; text-align:center;"><?php echo esc_html__('Free', 'certifypress'); ?></th>
                            <th style="width: 30%; text-align:center;"><?php echo esc_html__('Pro', 'certifypress'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><?php echo esc_html__('Certificate Management', 'certifypress'); ?></td><td style="text-align:center;"><span class="check">✓</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Custom Fields', 'certifypress'); ?></td><td style="text-align:center;"><span class="check">✓</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Categories & Tags', 'certifypress'); ?></td><td style="text-align:center;"><span class="check">✓</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Frontend Search', 'certifypress'); ?></td><td style="text-align:center;"><span class="check">✓</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Elementor Templates', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('QR Code Verification', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('PDF Generation', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Auto Serial Numbers', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Email to Students', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Certificate Expiration', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Bulk CSV Import', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Verification Page', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Duplicate Prevention', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Category Templates', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                        <tr><td><?php echo esc_html__('Advanced Elementor Widgets', 'certifypress'); ?></td><td style="text-align:center;"><span class="cross">✗</span></td><td style="text-align:center;"><span class="check">✓</span></td></tr>
                    </tbody>
                </table>
            </div>

             <div class="sc-pro-final-cta">
                 <a href="https://lmwebdesigners.com/plugin/certifypress-students-certificates-results/" target="_blank" class="sc-button sc-button-pro"><?php echo esc_html__('Upgrade to Pro and Unlock All Features', 'certifypress'); ?></a>
             </div>
        </div>
    </div>
</div>
