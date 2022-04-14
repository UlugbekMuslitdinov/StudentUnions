Feature: Carousel item content type administration
  As a Site Builder
  I want to modify carousel item settings and still be able to update uaqs_featured_content
  Because different sites require different workflows.

  Background: Cas is disabled
    Given I run drush dis "-y cas"

  @regression @carousel-item @api
  Scenario: I can set carousel item node settings on a site by site basis and still be able to update uaqs_featured_content module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-carousel-item"
    Then the "Published" checkbox should be checked
    # And the "Create new revision" checkbox should be checked

  @regression @carousel-item @api
  Scenario: I can set news node settings on a site by site basis and still be able to update uaqs_featured_content module
    Given I am logged in as a user with the administrator role
    When I visit "/admin/structure/types/manage/uaqs-carousel-item?destination=admin/structure/features/uaqs_featured_content"
    And I uncheck "Published"
    Then the "Published" checkbox should not be checked
    And I press "Save content type"
    Then I should be on "/admin/structure/features/uaqs_featured_content"

  @regression @carousel-item @api
    Scenario: Non default node settings should not override feature.
    When I run drush fl "--fields=state,feature | grep uaqs_featured_content"
    Then drush output should not contain "Overridden"

