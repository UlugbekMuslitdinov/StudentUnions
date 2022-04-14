Feature: UA Quickstart Navigation Global Footer
  In order to link to common UA resources
  As a site owner
  I need to be able to display UA global menus in the footer

  Background: UAQS Navigation Global Footer is enabled
    Given I run drush en "-y uaqs_navigation_global_footer"

  # See https://jira.arizona.edu/browse/UAMS-547
  #
  # Ensures uaqs_navigation_global_footer.module implementation of
  # hook_preprocess_link() is working correctly (only called once) so icons are
  # not duplicated.
  @regression
  Scenario: Only one icon is added to each link in the resources menu
    Given I am an anonymous user
    When I visit "/"
    Then I should see 2 "#block-bean-uaqs-footer-links-bean-resourc i.ua-brand-directory" elements
    And I should see 1 "#block-bean-uaqs-footer-links-bean-resourc i.ua-brand-calendar" element
    And I should see 1 "#block-bean-uaqs-footer-links-bean-resourc i.ua-brand-campus-map" element
    And I should see 1 "#block-bean-uaqs-footer-links-bean-resourc i.ua-brand-news" element
    And I should see 1 "#block-bean-uaqs-footer-links-bean-resourc i.ua-brand-weather" element
