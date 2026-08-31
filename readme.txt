=== Astro Booking Engine ===
Contributors: alian
Tags: booking engine, hotel booking, hotel widget, hotel booking engine, booking widget
Requires at least: 6.0.1
Tested up to: 7.1
Stable tag: 1.4.2
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use shortcode [astro-booking-engine] to display the booking form. Configure with 5Stelle, Iperbooking, Passepartout, Simple booking, or Vertical booking.

== Description ==
Display the <strong>booking engine form</strong> through the use of the shortcode <strong>[astro-booking-engine]</strong>.
Includes the most popular booking engine providers.
You need to have a contract with one of the booking engine providers listed below and configure the plugin settings.

<strong>List of configurable booking engine providers in alphabetical order</strong>:
<ul>
    <li><a href="https://www.hotelcinquestelle.cloud/en/">5Stelle</a></li>
    <li><a href="https://www.iperbooking.com/">Iperbooking</a></li>
    <li><a href="https://www.passepartout.net/">Passepartout</a></li>
    <li><a href="https://www.simplebooking.travel/">Simple booking</a></li>
    <li><a href="https://www.verticalbooking.com/en/home/">Vertical booking</a></li>
</ul>

<strong>New booking engine providers are welcome!</strong>
If your booking engine provider is not on the list, you can request its inclusion by sending an email to <a href="mailto:alian@alian.it">alian@alian.it</a> with the provider documentation if you have.

This plugin is compatible with translation plugins such as WPML and Loco Translate.

== Installation ==
1. Upload the entire `astro-booking-engine` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the **Plugins** screen (**Plugins > Installed Plugins**).

== Screenshots ==
1. Frontend: booking engine form with calendar
2. Frontend: booking engine form with child age dropdown
3. Backend: settings - providers list
4. Backend: settings - provider config
5. Backend: layout customization

== Wordefence vendor verification key ==
gsphudo7by90lzwdlihyerqxbzj6jiln

== Changelog ==

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

= 1.4.2 =
Maintenance release: compatibility with WordPress 7.1. If you are updating from 1.4.0 or earlier it also includes the security fix for CVE-2025-10308, released in 1.4.1.

= 1.4.1 =
Security release. Fixes a CSRF issue (CVE-2025-10308) that allowed an administrator to be tricked into deleting all plugin settings through a forged link. Updating is recommended.
