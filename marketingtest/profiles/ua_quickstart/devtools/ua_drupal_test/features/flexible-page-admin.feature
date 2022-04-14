Feature: flexible-page content type administration
  As a Site Builder
  I want to modify flexible-page node settings and still be able to update uaqs_content_chunks
  Because different sites require different workflows.

  Background: Cas is disabled
    Given I run drush dis "-y cas"

  @regression @flexible-page @api
  Scenario: I can set flexible-page node settings on a site by site basis and still be able to update uaqs_content_chunks module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-flexible-page"
    Then the "Published" checkbox should be checked
    And the "Create new revision" checkbox should be checked

  @regression @flexible-page @api
  Scenario: I can set flexible-page node settings on a site by site basis and still be able to update uaqs_content_chunks module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-flexible-page?destination=admin/structure/features/uaqs_content_chunks"
    And I uncheck "Published"
    Then the "Published" checkbox should not be checked
    And I press "Save content type"
    Then I should be on "/admin/structure/features/uaqs_content_chunks"

  @regression @flexible-page @api
    Scenario: Non default node settings should not override feature.
    When I run drush fl "--fields=state,feature | grep uaqs_content_chunks"
    Then drush output should not contain "Overridden"

