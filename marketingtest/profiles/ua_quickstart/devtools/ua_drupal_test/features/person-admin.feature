Feature: person content type administration
  As a Site Builder
  I want to modify person node settings and still be able to update uaqs_person
  Because different sites require different workflows.

  Background: Cas is disabled
    Given I run drush dis "-y cas"

  @regression @person @api
  Scenario: I can set person node settings on a site by site basis and still be able to update uaqs_person module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-person"
    Then the "Published" checkbox should be checked
    And the "Create new revision" checkbox should be checked

  @regression @person @api
  Scenario: I can set person node settings on a site by site basis and still be able to update uaqs_person module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-person?destination=admin/structure/features/uaqs_person"
    And I uncheck "Published"
    Then the "Published" checkbox should not be checked
    And I press "Save content type"
    Then I should be on "/admin/structure/features/uaqs_person"

  @regression @person @api
    Scenario: Non default node settings should not override feature.
    When I run drush fl "--fields=state,feature | grep uaqs_person"
    Then drush output should not contain "Overridden"

