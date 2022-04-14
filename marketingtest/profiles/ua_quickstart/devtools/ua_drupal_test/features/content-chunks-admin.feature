Feature: Content manager creates flexible page.
  As a Content Manager
  I want to use the flexible page content type.
  So that all of my content doesn't look the same.

  Background: Cas is disabled
    Given I run drush dis "-y cas"

  @regression @flexible-page @api
  Scenario: Basic paragraphs item types are available for use by administrators editing a flexible page.
    Given I am logged in as a user with the administrator role
    And I am viewing my "Flexible Page" with the title "Renaming the Pride of Arizona marching band"
    When I click Edit
    Then I should see the text "Add Image with caption"
    And I should see the text "Add UAQS Plain Text"
    And I should see the text "Add Text Area"
    And I should see the text "Add Extra info"
    And I should see the text "Add File attachment"
    And I should see the text "Add Marquee"
    And I should see the text "Add Card deck"
    And I should see the text "Add Full width background wrapper"

  @regression @flexible-page @api @content-manager
  Scenario: As an administrator there are some paragraphs item types I do not want to see when editing a flexible page because they are not enabled.
    Given I am logged in as a user with the administrator role
    And I am viewing my "Flexible Page" with the title "Renaming the Pride of Arizona marching band"
    When I click Edit
    Then I should not see the text "Add HTML Field"

  @regression @flexible-page @api
  Scenario: Paragraphs item type "HTML Field" is usable by administrators after enabling the feature.
    Given I run drush en "-y uaqs_content_chunks_html"
    And I am logged in as a user with the administrator role
    And I am viewing my "Flexible Page" with the title "Renaming the Pride of Arizona marching band"
    When I click Edit
    Then I should see the text "Add HTML Field"
