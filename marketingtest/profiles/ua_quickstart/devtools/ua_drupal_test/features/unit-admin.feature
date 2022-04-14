Feature: Unit content type administration
  As a Site Builder
  I want to modify unit node settings and still be able to update uaqs_unit
  Because different sites require different workflows.

  Background:
    Given I run drush en "-y uaqs_unit"
    Given I run drush dis "-y cas"

  @regression @unit @api
  Scenario: I can set unit node settings on a site by site basis and still be able to update uaqs_unit module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-unit"
    Then the "Published" checkbox should be checked
    And the "Create new revision" checkbox should be checked

  @regression @unit @api
  Scenario: I can set unit node settings on a site by site basis and still be able to update uaqs_unit module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-unit?destination=admin/structure/features/uaqs_unit"
    And I uncheck "Published"
    Then the "Published" checkbox should not be checked
    And I press "Save content type"
    Then I should be on "/admin/structure/features/uaqs_unit"

  @regression @unit @api
    Scenario: Non default node settings should not override feature.
    When I run drush fl "--fields=state,feature | grep uaqs_unit"
    Then drush output should not contain "Overridden"

