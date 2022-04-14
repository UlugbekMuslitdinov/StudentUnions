Feature: publication content type administration
  As a Site Builder
  I want to modify publication node settings and still be able to update uaqs_publication
  Because different sites require different workflows.

  Background:
    Given I run drush en "-y uaqs_publication"
    Given I run drush dis "-y cas"

  @regression @publication @api
  Scenario: I can set publication node settings on a site by site basis and still be able to update uaqs_publication module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-pub"
    Then the "Published" checkbox should be checked
    And the "Create new revision" checkbox should be checked

  @regression @publication @api
  Scenario: I can set publication node settings on a site by site basis and still be able to update uaqs_publication module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-pub?destination=admin/structure/features/uaqs_publication"
    And I uncheck "Published"
    Then the "Published" checkbox should not be checked
    And I press "Save content type"
    Then I should be on "/admin/structure/features/uaqs_publication"

  @regression @publication @api
    Scenario: Non default node settings should not override feature.
    When I run drush fl "--fields=state,feature | grep uaqs_publication"
    Then drush output should not contain "Overridden"

