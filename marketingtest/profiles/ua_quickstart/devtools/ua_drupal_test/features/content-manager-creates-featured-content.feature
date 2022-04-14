@story @api @content-manager @featured-content
Feature: Content manager creates featured content.
  As a Content Manager
  I want to create Featured Content
  So that I can engage site visitors.

  Background: Cas is disabled
    Given I run drush "dis" "cas -y"

  Scenario: Content type specifies image size requirements
    Given I am logged in as a user with the administrator role
    And I am viewing my "Carousel Item" with the title "Here is the first headline."
    When I click Edit
    Then I should see the text "Images must be at least 800x500 pixels."
