# UAQS SEO Module

Provides group of modules and configurations related to search engine optimization (SEO) for the site.

* **Redirects** - Ability to add redirects from one page URL to another. Example: yoursite.arizona.edu/page to yoursite.arizona.edu/newpage. Redirecting is also useful in scenarios where a site migration has caused content to have a different path/URL. In those cases, always add redirects so that links from other sites pointing to the old url do not result in Error 404 pages, creating a poor user experience and potentially being removed from the other sites. The Redirects feature also includes global redirect configurations that clean up URLs. An example would be removing trailing slashes in the URL.

* **Metatags** - Ability to modify metatags, including social media post metatags. With this module, you can select the photo and/or description that will be displayed when a user shares a url of your site on social media accounts including Twitter, LinkedIn, and Facebook. Some default content has been configured. **We recommended that you modify the photo and description metatags for the front page of the site (field names are technically uaqs_photo and uaqs_summary_field). You can modify the photo and description in the Summary tab in the content editor, the metatag tab takes the values within the summary tab and sets them.**

* **XML Sitemap** - Ability to generate accurate sitemap for your site. Optionally, this feature also provides a tool to generate and submit sitemaps to Google or Bing. You can include or exclude specific pages, menu items, and content types. By default, main menu items and core content types are included in the sitemap. Views pages are also included if the view link is in either the main menu, footer, or sidebar menu. The sitemap will not include drafts/unpublished pages. The sitemap will be regenerated on cron if there is an updated version. If there is an updated version, and you have selected the box to submit the sitemap to search engines, it will submit it, but not more than once a day. This module does not control whether or not search engines index site, but it may help index the site faster. **Since the default setting is to not submit the sitemaps to search engines, it is recommended that once you have launched the site live, enable the checkbox settings for submitting sitemaps to Google/Bing. You can find these settings in `/admin/config/search/xmlsitemap/engines`.**

* **Additional Recommendations**
    + **Site Verification** - Site verification is not directly related to SEO, but more with analytics and sharing of information between the site and search engines, verifying your site can allow you to access webmaster tools provided by the search engines, such as Google Search Console. These tools currently provide the ability to find crawl errors, security issues, index status, search statistics and data, and more. This module provides a place to enter the metatag string provided by your search engine to verify the site. This feature is in a submodule that is turned off by default. To turn on this feature, enable the submodule. After enabling the submodule, go to `/admin/config/search/metatags` and click edit for 'Global: Front page'. Scroll to the bottom where you see site verification and open that up to enter your metatag string provided by the search engine.

### Common Questions
* Q. Do views pages get added to sitemaps?
    + A. Views pages get added in sitemaps as long as they are linked from a menu that is included in the sitemap.

* Q. Will new content types and menus be included?
    + A. Any new added content types or menus will have to be included manually and you can find what is included/excluded if you go to `/admin/config/search/xmlsitemap/settings` and click on the tabs labeled 'Content' or 'Menu link'. You can then click on the item and go to XML sitemap tab where you can include/exclude.

* Q. Will a page that is unpublished or in draft mode when anonymous reviewer workflow module is turned on be included in the sitemap.
    + A. XML sitemaps does not include any unpublished or draft pages in the sitemaps.

* Q. Does external content get included in the sitemap?
    + A. This module provides custom functionality in `hook_node_presave()` which excludes external content from the sitemap, and adds a metatag `<meta name="robots" content="noindex" />` to prevent search engines from indexing the page. Any content of the following (UAQS) types whose field_uaqs_link value does not include the site’s base URL is considered external: Flexible Page, Event, News, Person, Carousel Item, Major. This custom functionality can optionally be disabled by setting the uaqs_seo_exclude_external_content variable to FALSE in a site's settings.php file (or via Drush). When content is excluded from the sitemap it will also enable the metatag advance setting checkbox called 'Prevents search engines from indexing this page'. This is the setting that adds the noindex metatag, which prevents search engines from indexing the page.

* Q. What happens if I do not submit sitemaps to search engines through the xmlsitemap engines submodule.
    + A. Your site may be indexed either way. Also, you may create a sitemap outside of this module. This module makes it easier by automatically updating the sitemap with new content and submitting it to search engines at regular intervals.

* Q. How does the sitemap get updated and submitted to search engines?
    + A. Sitemap will be regenerated on cron if there is new content, and if the minimum sitemap lifetime has passed. Currently the minimum sitemap lifetime is set to one day so a new site map will be generated once per day as long as there is new or updated, or deleted content during that day. The sitemap will also be submitted to search engines, but not more than 1 time a day.

* Q. What is the purpose of site verification and how is it related to SEO?
    + A. The purpose of site verification as mentioned by Google is that it provides a secure channel for giving/receiving data. While site verification does not affect performance in google search, it provides useful information like analytics, crawl errors, index issues, etc.

## Packaged Dependencies

When this module is used as part of a Drupal distribution (such as [UA Quickstart](https://bitbucket.org/ua_drupal/ua_quickstart)), the following dependencies will be automatically packaged with the distribution.

### Drupal Contrib Modules

#### Common Contrib Module Dependencies
* [Redirect](https://www.drupal.org/project/redirect)
* [Global Redirect](https://www.drupal.org/project/globalredirect)
* [Match Redirect](https://www.drupal.org/project/match_redirect)
* [Metatag](https://www.drupal.org/project/metatag)
    + Metatag: Google+
    + Metatag: OpenGraph
    + Metatag: Twitter Cards
* [XML Sitemap](https://www.drupal.org/project/xmlsitemap)
    + XML sitemap engines
    + XML sitemap menu
    + XML sitemap node

#### Features-related Contrib Modules
* [Default config](https://www.drupal.org/project/defaultconfig)
* [Features](https://www.drupal.org/project/features)
