Feature: program content type administration
  As a Site Builder
  I want to modify program node settings and still be able to update uaqs_program
  Because different sites require different workflows.

  Background:
    Given I run drush en "-y uaqs_program"
    Given I run drush dis "-y cas"

  @regression @program @api
  Scenario: I can set program node settings on a site by site basis and still be able to update uaqs_program module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-program"
    Then the "Published" checkbox should be checked
    And the "Create new revision" checkbox should be checked

  @regression @program @api
  Scenario: I can set program node settings on a site by site basis and still be able to update uaqs_program module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-program?destination=admin/structure/features/uaqs_program"
    And I uncheck "Published"
    Then the "Published" checkbox should not be checked
    And I press "Save content type"
    Then I should be on "/admin/structure/features/uaqs_program"

  @regression @program @api
    Scenario: Non default node settings should not override feature.
    When I run drush fl "--fields=state,feature | grep uaqs_program"
    Then drush output should not contain "Overridden"

