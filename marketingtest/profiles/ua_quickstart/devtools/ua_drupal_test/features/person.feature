Feature: News
  In order to show visitors contact information for people
  As a UA Unit
  I need to have a personnel directory.

  Scenario: A directory entry shows the details for a person.
    Given I am an anonymous user
    When I am at "/person/janet-horne"
    Then I should see the text "Janet Horne"
    And I should see the text "Assistant Research Professor"
    And I should see the text "Integrative Medicine 904"
    And I should see the text "041-552-8467"
    And I should see the text "jhorne@email.arizona.edu"
    And I should see the text "Currently investigating the use of herbal supplements as an alternative to nutrition."
    And I should see the text "Departmental Faculty"


