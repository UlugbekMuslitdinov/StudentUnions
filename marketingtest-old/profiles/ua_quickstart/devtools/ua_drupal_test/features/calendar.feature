Feature: UA Quickstart Calendar
  In order to show visitors upcoming events
  As a site owner
  I need to be able to show them a calendar of events

  @regression
  Scenario: Calendar page has the correct title.
    Given I am an anonymous user
    When I visit "/calendar"
    And I should not see "Sunday" in the ".view-uaqs-events .view-content .h3" element
    And I should not see "Monday" in the ".view-uaqs-events .view-content .h3" element
    And I should not see "Tuesday" in the ".view-uaqs-events .view-content .h3" element
    And I should not see "Wednesday" in the ".view-uaqs-events .view-content .h3" element
    And I should not see "Thursday" in the ".view-uaqs-events .view-content .h3" element
    And I should not see "Friday" in the ".view-uaqs-events .view-content .h3" element
    And I should not see "Saturday" in the ".view-uaqs-events .view-content .h3" element
