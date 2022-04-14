Feature: event content type administration
  As a Site Builder
  I want to modify event node settings and still be able to update uaqs_event
  Because different sites require different workflows.

  Background: Cas is disabled
    Given I run drush dis "-y cas"

  @regression @event @api
  Scenario: I can set event node settings on a site by site basis and still be able to update uaqs_event module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-event"
    Then the "Published" checkbox should be checked
    And the "Create new revision" checkbox should be checked

  @regression @event @api
  Scenario: I can set event node settings on a site by site basis and still be able to update uaqs_event module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-event?destination=admin/structure/features/uaqs_event"
    And I uncheck "Published"
    Then the "Published" checkbox should not be checked
    And I press "Save content type"
    Then I should be on "/admin/structure/features/uaqs_event"

  @regression @event @api
    Scenario: Non default node settings should not override feature.
    When I run drush fl "--fields=state,feature | grep uaqs_event"
    Then drush output should not contain "Overridden"

