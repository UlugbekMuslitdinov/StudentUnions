Feature: page content type administration
  As a Site Builder
  I want to modify page node settings and still be able to update uaqs_page
  Because different sites require different workflows.

  Background:
    Given I run drush en "-y uaqs_page"
    Given I run drush dis "-y cas"

  @regression @page @api
  Scenario: I can set page node settings on a site by site basis and still be able to update uaqs_page module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-page"
    Then the "Published" checkbox should be checked
    And the "Create new revision" checkbox should be checked

  @regression @page @api
  Scenario: I can set page node settings on a site by site basis and still be able to update uaqs_page module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-page?destination=admin/structure/features/uaqs_page"
    And I uncheck "Published"
    Then the "Published" checkbox should not be checked
    And I press "Save content type"
    Then I should be on "/admin/structure/features/uaqs_page"

  @regression @page @api
    Scenario: Non default node settings should not override feature.
    When I run drush fl "--fields=state,feature | grep uaqs_page"
    Then drush output should not contain "Overridden"

