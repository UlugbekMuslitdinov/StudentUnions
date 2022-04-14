Feature: News
  In order to keep visitors up to date on the latest happenings
  As a UA Unit
  I need to have a news area.

  @regression @news
  Scenario: A news block is displayed on the primus page.
    Given I am an anonymous user
    When I visit "/pages/primus"
    Then I should see "News" in the "#block-views-uaqs-news-three-col-news-block" element

  @regression @news
  Scenario: Paragraphs items migrated correctly into the news content type and is visible to anonymous visitors to the site.
    Given I am an anonymous user
    When I am on the "news" page from "today" called "runners-brains-may-have-more-connectivity-ua-research-shows"
    Then I should see the text "UA's Evelyn F. McKnight Brain Institute"
