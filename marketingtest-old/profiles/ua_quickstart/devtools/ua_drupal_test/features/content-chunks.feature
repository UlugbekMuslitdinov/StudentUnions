Feature: Anonymous user visits a flexible page.
    As a site visitor and potential adopter of UA Quickstart,
    I would like to see the example content so I can have a feel
    for what is available if I were to use UA Quickstart..

  @regression @flexible-page
  Scenario: Paragraphs items migrated correctly into the flexible page content type and is visible to anonymous visitors to the site.
    Given I am an anonymous user
    When I am at '/pages/uaqs-flexible-page'
    Then I should see the text "Inspired by a famous painting"
    And I should see the text "Reviving little-heard instruments"
    And I should see the text "Superbia (detail)"
    And I should see the text "The seven deadly sins and four last things"

    @regression @flexible-page @api @content-manager
    Scenario: Paragraphs item migrated correctly.
      Given I am an anonymous user
      When I am at '/pages/uaqs-flexible-page'
      Then I should see the text "Inspired by a famous painting"
      And I should see the text "Reviving little-heard instruments"
      And I should see the text "Superbia (detail)"
      And I should see the text "The seven deadly sins and four last things"
