=== Astro Booking Engine ===
Contributors: alian
Tags: booking engine, hotel booking, hotel widget, hotel booking engine, booking widget
Requires at least: 6.0.1
Tested up to: 7.1
Stable tag: 2.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Hotel booking form via Gutenberg block or shortcode, independent from the provider: switch booking engine anytime, your form stays the same.

== Description ==
Astro Booking Engine adds a simple, intuitive and responsive <strong>hotel booking form</strong> to your WordPress site and connects it to the booking engine you already use. Visitors pick their dates and party size on your website and land on your booking engine with everything already filled in.

The form is <strong>independent from the provider</strong>. If you change booking engine, your website does not change: select the new provider, enter the settings it gives you, and the form on your pages keeps the same design, the same position and the same options. No redesign, no page edits.

<strong>Why use Astro Booking Engine</strong>
<ul>
    <li><strong>Ready in minutes, no custom development.</strong> Install, choose your provider, enter its data, add the form to a page. Done.</li>
    <li><strong>Free to change provider.</strong> Your layout and your pages stay as they are; only the provider settings change.</li>
    <li><strong>Yours to customize.</strong> Colors, fonts, borders, calendar theme and custom CSS from the Layout settings, plus per-block options in the editor.</li>
    <li><strong>Built for every guest.</strong> Responsive, follows the language of your site, with fields labelled for screen readers following the WCAG guidelines.</li>
</ul>

<strong>How it works</strong>

1. Select your booking engine provider in the plugin settings.
1. Enter the data your provider gives you (hotel ID, language, currency and so on).
1. Add the form to your site with the Gutenberg block, the shortcode or the widget.

<strong>Display the form wherever you prefer</strong>
<ul>
    <li>with the <strong>Astro Booking Engine Gutenberg block</strong>, with live preview in the editor and per-block customization: submit button label, form colors (with transparency), border radius, plus the standard alignment, spacing and background options;</li>
    <li>with the shortcode <strong>[astro-booking-engine]</strong>, anywhere in your content;</li>
    <li>with the classic <strong>widget</strong>, in any widget area.</li>
</ul>

Astro Booking Engine is not a booking engine: it needs an active contract with one of the providers listed below.

<strong>Supported hotel booking engine providers</strong>, in alphabetical order:
<ul>
    <li><a href="https://www.hotelcinquestelle.cloud/en/">5Stelle</a></li>
    <li><a href="https://www.blastness.com/">Blastness</a></li>
    <li><a href="https://www.datasistemi.eu/">Data Sistemi</a></li>
    <li><a href="https://www.ericsoft.com/">Ericsoft</a></li>
    <li><a href="https://www.iperbooking.com/">Iperbooking</a></li>
    <li><a href="https://www.mycomp.it/">MyGuestCare</a></li>
    <li><a href="https://www.passepartout.net/">Passepartout</a></li>
    <li><a href="https://www.simplebooking.travel/">Simple booking</a></li>
    <li><a href="https://www.verticalbooking.com/en/home/">Vertical booking</a></li>
    <li><a href="https://wubook.net/">WuBook</a></li>
</ul>

<strong>New booking engine providers are welcome!</strong>
If your booking engine provider is not on the list, you can request its inclusion by sending an email to <a href="mailto:alian@alian.it">alian@alian.it</a> with any documentation you may have.

This plugin is compatible with translation plugins such as WPML and Loco Translate.

<strong>About the author</strong>
Astro Booking Engine is developed and maintained by Alian Schiavoncini (<a href="https://www.alian.it">www.alian.it</a>), a WordPress developer since 2005 and founder of <a href="https://www.aboutmyhotel.com">AboutMyHotel</a>, a hotel reputation and market intelligence platform. AboutMyHotel is a separate, commercial service by the same author and is not required to use this plugin.

== Installation ==
1. Upload the entire `astro-booking-engine` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the **Plugins** screen (**Plugins > Installed Plugins**).

== Frequently Asked Questions ==
= How can I report a bug or suggest an improvement? =
You can use the <a href="https://wordpress.org/support/plugin/astro-booking-engine/">support forum</a> on WordPress.org or write to <a href="mailto:alian@alian.it">alian@alian.it</a>. Feature requests and bug reports are welcome.

== Screenshots ==
1. Frontend: booking engine form with calendar
2. Frontend: booking engine form with child age dropdown
3. Backend: settings - providers list
4. Backend: settings - provider config
5. Backend: layout customization

== Wordefence vendor verification key ==
gsphudo7by90lzwdlihyerqxbzj6jiln

== Changelog ==

= 2.0.0 =
* Added: Astro Booking Engine Gutenberg block with live editor preview and per-block layout customization (submit button label, form colors with transparency, border radius), alongside the existing shortcode and widget.
* Added: Blastness provider.
* Added: Data Sistemi provider.
* Added: WuBook provider.
* Added: review request notice on the plugin settings screen, shown only to administrators after 30 days of use, with permanent dismiss and snooze options.
* Added: "About the author" section in the readme and on the plugin Support page, with links to the author's website and to AboutMyHotel, plus a FAQ entry on how to report bugs and suggest improvements.
* Added: "Support" and "Author website" links in the plugin row on the Plugins screen.
* Fixed: booking form accessibility: every field now has a unique id with its label programmatically associated, and the decorative spacer label above the submit button is hidden from assistive technologies (WCAG 1.3.1, 4.1.2).
* Fixed: two Italian translations on the settings screen ("For installation details…" and "support page") were never applied because of malformed entries in the translation file.
* Changed: Italian translation updated with the new strings (plugin description, security check message, 5Stelle "Portal" field label).
* Changed: milestone release, fully backwards compatible: existing settings, shortcode, widget and templates keep working unchanged.
* Compatibility: tested with WordPress 7.1.

= 1.5.0 =
* Added: Ericsoft provider.
* Added: MyGuestCare provider.
* Fixed: on the settings screen some saved values were displayed wrong after saving: the Simple booking currency and the default and maximum numbers of adults and children for Simple booking and Vertical booking.
* Compatibility: tested with WordPress 7.1.

= 1.4.2 =
* Compatibility: tested with WordPress 7.1.

= 1.4.1 =
* Security: fixed a Cross-Site Request Forgery issue in the "Remove all plugin settings" function (CVE-2025-10308). The action was performed on a plain GET request without nonce validation, so an administrator could be tricked into deleting all plugin settings by following a forged link. The request is now validated with a nonce and an explicit capability check. Thanks to Nabil Irawan (Heroes Cyber Security) for the responsible disclosure.
* Fixed: on the Settings screen the shortcode name was showing the literal &lt;strong&gt; tags instead of being displayed in bold.
* Changed: the plugin author is now Alian Schiavoncini (https://www.alian.it) and the support address is alian@alian.it. The previous AstroThemes website and email address are no longer active.
* Changed: the admin menu is now named "Astro Plugins" instead of "AstroThemes".
* Changed: the plugin version is now stored in the ASTRO_BE_VERSION constant instead of being read at runtime with get_plugin_data().
* Changed: the jQuery UI calendar stylesheet is now enqueued with a version number, so browsers pick up changes after an update.
* Compatibility: tested with WordPress 7.0.

= 1.4.0 =
* Added: Wordefence vendor verification key.
* Compatibility: tested with WordPress 6.8.3.

= 1.3.0 =
* Security: added security checks to the code.
* Compatibility: tested with WordPress 6.6.1.

= 1.2.0 =
* Added: Passepartout provider.

= 1.1.1 =
* Changed: the plugin description.

= 1.1.0 =
* Added: 5Stelle provider.

= 1.0.2 =
* Added: Italian translation.

= 1.0.1 =
* Changed: the support link on the admin settings screen.

= 1.0.0 =
* Initial version.

== Upgrade Notice ==

= 2.0.0 =
Major release: new Gutenberg block with per-block customization, three new providers (Blastness, Data Sistemi, WuBook), review notice and accessibility fixes. Fully backwards compatible: shortcode, widget and settings keep working unchanged.

= 1.4.2 =
Maintenance release: compatibility with WordPress 7.1. If you are updating from 1.4.0 or earlier it also includes the security fix for CVE-2025-10308, released in 1.4.1.

= 1.4.1 =
Security release. Fixes a CSRF issue (CVE-2025-10308) that allowed an administrator to be tricked into deleting all plugin settings through a forged link. Updating is recommended.
