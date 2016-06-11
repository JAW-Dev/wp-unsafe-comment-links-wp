=== WP Unsafe Comment Links ===
Contributors: jawittdesigns
Donate link: http://jawittdesigns.com/donations/
Tags: comments, spam, links
Requires at least: 4.5.2
Tested up to: 4.5.2
Stable tag: 1.0.4
License: GPL-2.0 or Later
License URI: http://opensource.org/licenses/gpl-2.0.php GNU Public License

Check the links in your WordPress comments for unsafe links using Google Safe Browsing API

== Description ==
Spam comments are a part of life when you run a website. There are great plugins out there that will limit the amount of spam you get, but even with the tightest restrictions some spam comments will still get through.

As a website owner, the last thing you want is to have a spam comment include a link that will take your users to a website that could infect them with malware or any other computer virus.

This plugin will check the links added to your WordPress site comments against the Google Safe Browsing API. If a link is flagged as unsafe then the link will be replaced by the text "Warning! This is an unsafe link!".

## Google Safe Browsing API

This plugin requires you to have a Google Safe Browsing API key to use. You can get your API key at the [Google's Developer Console](https://code.google.com/apis/console/).



== Installation ==
1. Use WordPress **Add New Plugin feature**, searching **Plugin Name**, or download the archive.
2. Unzip the archive on your computer
3. Upload **Plugin Folder** directory to the /wp-content/plugins/ directory
4. Activate the plugin through the **Plugins** menu in WordPress

== Frequently Asked Questions ==
= Every time a page with comments loads the WP Unsafe Comment Links plugin checks the Google Safe Browsing API. Does the plugin need to check this every time it loads the page? =

Yes, the WP Unsafe Comment Links plugin needs to repeatedly check the Google Safe Browsing list because, unsafe websites are being added and removed all the time. If the plugin cached the API results then your comment links would never be updated increasing the risk of your users being exposed to unsafe website links.

= One of my users added a link to their website, and their website was unknowingly infected with malware. How can I exclude their site's URL? =

Right now there is no way to exclude a URL. What your user needs to do is, remove the malware that is effecting their site and then contact Google to get their site removed from the unsafe website list. After the user does this their site's URL will now appear in your comments.

= I don't like the default warning. Is there a way for me to change it? =

Unless you're comfortable with coding and are familiar with the WordPress filter system, then no there is no way to change the warning message at this time. There are plans to make a Pro version of the WP Unsafe Comment Links plugin, so stay tuned for news about that.


== Screenshots ==
1. Before the unsafe link look up
2. After the unsafe link look up

== Changelog ==
= v1.0.4 2016-06-11 =
* Fixed Typo

= v1.0.3 2016-05-31 =
* New Deploy

= v1.0.2 2016-05-24 =
* Fixed action link for settings

= v1.0.` 2016-05-23 =
* Removed Multisite

= v1.0.0 2016-05-16 =

== Upgrade Notice ==
= None =