Feature: Event Date Fields
  In order to give my content temporal context
  As a UA Unit
  I need to be able to add date values to content.

  @regression @fields @api
  Scenario: There is a date field on the add event form.
    Given I am logged in as a user with the administrator role
    When I am at "node/add/uaqs-event"
    Then I should see "All Day" in the ".form-item-field-uaqs-date-und-0-all-day" element
    And I should see "Show End Date" in the ".form-item-field-uaqs-date-und-0-show-todate" element
    And I should see "-Month" in the "#edit-field-uaqs-date-und-0-value-month" element
    And I should see "-Day" in the "#edit-field-uaqs-date-und-0-value-day" element
    And I should see "-Year" in the "#edit-field-uaqs-date-und-0-value-year" element
    And I should see "Repeat" in the ".form-item-field-uaqs-date-und-0-show-repeat-settings" element

  @regression @fields @api
  Scenario: There is a date field on the add publication form.
    Given I run drush en "-y uaqs_publication"
    Given I am logged in as a user with the administrator role
    When I am at "node/add/uaqs-pub"
    Then I should see "2017" in the "#edit-field-uaqs-year-und-0-value-year" element

  @regression @fields @api
  Scenario: There are publication and expiration date fields on the add news form.
    Given I am logged in as a user with the administrator role
    When I am at "node/add/uaqs-news"
    Then I should see "-Month" in the "#edit-field-uaqs-published-und-0-value-month" element
    And I should see "-Day" in the "#edit-field-uaqs-published-und-0-value-day" element
    And I should see "-Year" in the "#edit-field-uaqs-published-und-0-value-year" element
    And I should see "-Month" in the "#edit-field-uaqs-expiration-date-und-0-value-month" element
    And I should see "-Day" in the "#edit-field-uaqs-expiration-date-und-0-value-day" element
    And I should see "-Year" in the "#edit-field-uaqs-expiration-date-und-0-value-year" element
    And I should see "-Hour" in the "#edit-field-uaqs-expiration-date-und-0-value-hour" element
    And I should see "-Minute" in the "#edit-field-uaqs-expiration-date-und-0-value-minute" element
    And I should see "-&nbsp;" in the "#edit-field-uaqs-expiration-date-und-0-value-ampm" element