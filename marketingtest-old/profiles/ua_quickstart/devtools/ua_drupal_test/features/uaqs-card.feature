Feature: UA Quickstart Card Block
  In order to display advertisement style cards.
  As a site owner
  I need to be able to use bootstrap classes to style my cards.

  @regression
  Scenario: The card block is using the correct classes.
    Given I am an anonymous user
    When I visit "/pages/uaqs-block-types"
    Then I should see "Myxine" in the ".card-header" element
    And I should see "Read More" in the "#block-bean-anti-social-media-app .btn-arrow" element
