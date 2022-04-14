Feature: UA Quickstart Contact Summary Block
  In order to display contact information to site visitors.
  As a site owner
  I need to be able to use the contact summary block type and place it in the footer.

  @regression
  Scenario: The contact summary is in the correct region.
    Given I am an anonymous user
    When I visit "/pages/uaqs-block-types"
    Then I should see "The University of Arizona Tucson AZ 85721 department.name@email.arizona.edu 520-621-2211" in the ".region-footer" element
